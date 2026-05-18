<?php
require_once __DIR__ . '/../config.php';

session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized', 'success' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'] ?? 'Intern';

// Allow admins to view/manage other users' check-ins
if ($user_role === 'Admin' && isset($_GET['userId'])) {
    $user_id = $_GET['userId'];
}

function formatTime($datetime) {
    if (!$datetime) return '';
    return date('H:i', strtotime($datetime));
}

// GET REQUESTS: Fetch check-in data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if requesting check-in for a specific date
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            echo json_encode(['error' => 'Invalid date format', 'success' => false]);
            exit;
        }

        $stmt = $pdo->prepare("
            SELECT morning_in, morning_out, afternoon_in, afternoon_out 
            FROM check_in 
            WHERE user_id = ? AND date = ?
        ");
        $stmt->execute([$user_id, $date]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo json_encode([
                'success' => true,
                'check_in' => [
                    'morning_in' => formatTime($row['morning_in']),
                    'morning_out' => formatTime($row['morning_out']),
                    'afternoon_in' => formatTime($row['afternoon_in']),
                    'afternoon_out' => formatTime($row['afternoon_out'])
                ]
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'check_in' => null
            ]);
        }
        exit;
    }

    // Default: Get check-ins for a specific month
    $month = $_GET['month'] ?? date('m');
    $year = $_GET['year'] ?? date('Y');
    
    $startDate = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
    $endDate = date('Y-m-t', strtotime($startDate));

    $stmt = $pdo->prepare("
        SELECT date, morning_in, morning_out, afternoon_in, afternoon_out 
        FROM check_in 
        WHERE user_id = ? AND date BETWEEN ? AND ?
    ");
    $stmt->execute([$user_id, $startDate, $endDate]);

    $check_ins = [];
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $check_ins[$row['date']] = [
            'morning_in' => formatTime($row['morning_in']),
            'morning_out' => formatTime($row['morning_out']),
            'afternoon_in' => formatTime($row['afternoon_in']),
            'afternoon_out' => formatTime($row['afternoon_out'])
        ];
    }

    echo json_encode(['success' => true, 'check_ins' => $check_ins]);
    exit;
}

// POST REQUESTS: Save or delete check-in logs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'] ?? '';
    $morning_in = trim($_POST['morning_in'] ?? '');
    $morning_out = trim($_POST['morning_out'] ?? '');
    $afternoon_in = trim($_POST['afternoon_in'] ?? '');
    $afternoon_out = trim($_POST['afternoon_out'] ?? '');
    $delete = isset($_POST['delete']) && ($_POST['delete'] === 'true' || $_POST['delete'] === '1');

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        echo json_encode(['error' => 'Invalid date format', 'success' => false]);
        exit;
    }

    try {
        if ($delete) {
            // Delete check-in entry
            $stmt = $pdo->prepare("DELETE FROM check_in WHERE user_id = ? AND date = ?");
            $stmt->execute([$user_id, $date]);

            // Delete corresponding hours log entry
            $stmt = $pdo->prepare("DELETE FROM hours_log WHERE user_id = ? AND date = ?");
            $stmt->execute([$user_id, $date]);

            echo json_encode(['success' => true, 'message' => 'Check-in and hours deleted successfully']);
        } else {
            // Validate time format helper
            function validateTime($time) {
                if (empty($time)) return true;
                return preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $time);
            }

            if (!validateTime($morning_in) || !validateTime($morning_out) || !validateTime($afternoon_in) || !validateTime($afternoon_out)) {
                echo json_encode(['error' => 'Invalid time format (must be HH:MM)', 'success' => false]);
                exit;
            }

            // Calculate precise decimal hours
            $morning_hours = 0.0;
            if (!empty($morning_in) && !empty($morning_out)) {
                $m_in = strtotime("$date $morning_in:00");
                $m_out = strtotime("$date $morning_out:00");
                if ($m_out > $m_in) {
                    $morning_hours = ($m_out - $m_in) / 3600.0;
                }
            }

            $afternoon_hours = 0.0;
            if (!empty($afternoon_in) && !empty($afternoon_out)) {
                $a_in = strtotime("$date $afternoon_in:00");
                $a_out = strtotime("$date $afternoon_out:00");
                if ($a_out > $a_in) {
                    $afternoon_hours = ($a_out - $a_in) / 3600.0;
                }
            }

            $total_hours = round($morning_hours + $afternoon_hours, 2);

            // Construct DATETIME stamps or NULL
            $morning_in_dt = !empty($morning_in) ? "$date $morning_in:00" : null;
            $morning_out_dt = !empty($morning_out) ? "$date $morning_out:00" : null;
            $afternoon_in_dt = !empty($afternoon_in) ? "$date $afternoon_in:00" : null;
            $afternoon_out_dt = !empty($afternoon_out) ? "$date $afternoon_out:00" : null;

            // Check if check_in record exists
            $stmt = $pdo->prepare("SELECT check_in_id FROM check_in WHERE user_id = ? AND date = ?");
            $stmt->execute([$user_id, $date]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Update
                $updateStmt = $pdo->prepare("
                    UPDATE check_in 
                    SET morning_in = ?, morning_out = ?, afternoon_in = ?, afternoon_out = ?, updated_at = NOW() 
                    WHERE check_in_id = ?
                ");
                $updateStmt->execute([$morning_in_dt, $morning_out_dt, $afternoon_in_dt, $afternoon_out_dt, $row['check_in_id']]);
            } else {
                // Insert
                $insertStmt = $pdo->prepare("
                    INSERT INTO check_in (user_id, date, morning_in, morning_out, afternoon_in, afternoon_out) 
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $insertStmt->execute([$user_id, $date, $morning_in_dt, $morning_out_dt, $afternoon_in_dt, $afternoon_out_dt]);
            }

            // Sync with hours_log
            if ($total_hours > 0) {
                try {
                    $hoursStmt = $pdo->prepare("
                        INSERT INTO hours_log (user_id, date, hours) 
                        VALUES (?, ?, ?)
                    ");
                    $hoursStmt->execute([$user_id, $date, $total_hours]);
                } catch (PDOException $e) {
                    $hoursStmt = $pdo->prepare("
                        UPDATE hours_log 
                        SET hours = ?, updated_at = NOW() 
                        WHERE user_id = ? AND date = ?
                    ");
                    $hoursStmt->execute([$total_hours, $user_id, $date]);
                }
            } else {
                // If total hours is 0 (all stamps empty), delete hours_log record
                $delHoursStmt = $pdo->prepare("DELETE FROM hours_log WHERE user_id = ? AND date = ?");
                $delHoursStmt->execute([$user_id, $date]);
            }

            echo json_encode([
                'success' => true, 
                'hours' => $total_hours, 
                'message' => 'Check-in saved and hours synchronized successfully'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage(), 'success' => false]);
    }
    exit;
}

echo json_encode(['error' => 'Method not allowed', 'success' => false]);
?>
