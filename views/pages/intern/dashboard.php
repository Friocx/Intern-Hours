<?php
// Ensure this is included through feed.php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Location: ../../feed.php?page=dashboard");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$current_month = (int)($_GET['month'] ?? date('m'));
$current_year = (int)($_GET['year'] ?? date('Y'));

$office_id = $_SESSION['office_id'] ?? null;
$organization_id = $_SESSION['organization_id'] ?? null;

$birthdays = [];
if ($office_id && $organization_id) {
    $stmt = $pdo->prepare("
        SELECT name, nickname, birthdate 
        FROM users 
        WHERE office_id = ? 
          AND organization_id = ? 
          AND role = 'Intern' 
          AND birthdate IS NOT NULL 
          AND birthdate != ''
    ");
    $stmt->execute([$office_id, $organization_id]);
    $birthdays = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$base_url = "../";
?>
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/dashboard.css">
<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/colleagues.css">

<div class="dashboard-container">
        <div class="welcome-card full-width mb-6" style="background: white; padding: 20px; border-radius: 12px; shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <h1 class="text-2xl font-bold text-gray-900">Welcome, <?php echo htmlspecialchars($user_name); ?></h1>
            <p class="text-gray-600"><?php echo htmlspecialchars($_SESSION['office_name'] ?? 'N/A'); ?> | <?php echo htmlspecialchars($_SESSION['organization_name'] ?? 'N/A'); ?></p>
        </div>
        <div class="calendar-section">

            <div class="calendar-header">
                <h2 id="calendar-title">December 2024</h2>
                <div class="calendar-nav">
                    <button onclick="previousMonth()">← Prev</button>
                    <button onclick="nextMonth()">Next →</button>
                    <button class="btn-download-pdf" id="btn-download-pdf" onclick="downloadPDF()">
                        <span>📄</span> Download DTR
                    </button>
                </div>
            </div>

            <div class="calendar-grid" id="calendar-grid"></div>

            <div style="text-align: center; color: #666; font-size: 12px;">
                <p>Click a day to log or edit hours</p>
            </div>
        </div>

        <div class="stats-sidebar">
            <!-- Quick Clock-In/Out Card -->
            <div class="quick-clock-card" id="quick-clock-card">
                <div class="quick-clock-header">
                    <div class="quick-clock-title">🕒 Quick Clock-In</div>
                    <div class="quick-clock-time" id="quick-clock-current-time">00:00</div>
                </div>
                <div class="quick-clock-body">
                    <button class="quick-clock-btn" id="quick-clock-morning-in" onclick="quickClockStamp('morning_in')">
                        <span>🌅 Morning Time In</span>
                        <span class="btn-status" id="status-morning-in">--:--</span>
                    </button>
                    <button class="quick-clock-btn" id="quick-clock-morning-out" onclick="quickClockStamp('morning_out')">
                        <span>🌅 Morning Time Out</span>
                        <span class="btn-status" id="status-morning-out">--:--</span>
                    </button>
                    <button class="quick-clock-btn" id="quick-clock-afternoon-in" onclick="quickClockStamp('afternoon_in')">
                        <span>☀️ Afternoon Time In</span>
                        <span class="btn-status" id="status-afternoon-in">--:--</span>
                    </button>
                    <button class="quick-clock-btn" id="quick-clock-afternoon-out" onclick="quickClockStamp('afternoon_out')">
                        <span>☀️ Afternoon Time Out</span>
                        <span class="btn-status" id="status-afternoon-out">--:--</span>
                    </button>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total Hours</div>
                <div class="stat-value">
                    <span id="total-hours">0</span>
                    <span class="stat-unit">hrs</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Month Total</div>
                <div class="stat-value">
                    <span id="month-total">0</span>
                    <span class="stat-unit">hrs</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Today's Hours</div>
                <div class="stat-value">
                    <span id="today-hours">0</span>
                    <span class="stat-unit">hrs</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Average/Day</div>
                <div class="stat-value">
                    <span id="average-hours">0</span>
                    <span class="stat-unit">hrs</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label" id="filtered-label">Filtered Total</div>
                <div class="stat-value">
                    <span id="filtered-total">0</span>
                    <span class="stat-unit">hrs</span>
                </div>
            </div>

            <div class="filter-section">
                <div class="stat-label">Filter by Date</div>
                <div class="filter-group">
                    <label>From Date</label>
                    <input type="date" id="filter-from-date">
                </div>
                <div class="filter-group">
                    <label>To Date</label>
                    <input type="date" id="filter-to-date">
                </div>
                <div class="filter-buttons">
                    <button class="btn-filter" onclick="applyFilter()">Apply</button>
                    <button class="btn-reset" onclick="resetFilter()">Reset</button>
                </div>
            </div>
        </div>

        <!-- Sections below calendar and sidebar -->
        <div class="colleagues-section full-width mt-6" style="background: white; padding: 20px; border-radius: 12px; shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h3 class="text-xl font-bold text-gray-800">Your Colleagues</h3>
                <a href="feed.php?page=colleagues" style="font-size: 13px; font-weight: 600; color: #2563eb; text-decoration: none;">View All →</a>
            </div>
            <div id="interns-list" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <p class="text-gray-500 italic text-sm">Loading colleagues...</p>
            </div>
        </div>
    </div>

    <!-- Intern Hours Detail Modal (shared with colleagues page) -->
    <div class="intern-hours-modal" id="intern-hours-modal">
        <div class="intern-hours-modal-content">
            <div class="intern-modal-header">
                <div class="intern-info">
                    <div class="modal-avatar" id="intern-modal-avatar"></div>
                    <div>
                        <h3 id="intern-modal-name">Loading...</h3>
                        <div class="modal-subtitle" id="intern-modal-subtitle"></div>
                    </div>
                </div>
                <button class="intern-modal-close" onclick="closeInternModal()">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="intern-modal-stats">
                <div class="intern-modal-stat">
                    <div class="value" id="intern-stat-total">—</div>
                    <div class="label">Total Hours</div>
                </div>
                <div class="intern-modal-stat">
                    <div class="value" id="intern-stat-days">—</div>
                    <div class="label">Days Logged</div>
                </div>
                <div class="intern-modal-stat">
                    <div class="value" id="intern-stat-avg">—</div>
                    <div class="label">Avg/Day</div>
                </div>
            </div>
            <div id="intern-modal-body"></div>
        </div>
    </div>

    <!-- Log Hours / Check-In Modal -->
    <div class="modal" id="log-modal">
        <div class="modal-content" style="max-width: 450px;">
            <div class="modal-header">Time Log & Check-In</div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Date</label>
                <input type="text" id="modal-date" readonly style="background: #f8fafc; border: 1px solid #cbd5e1; padding: 8px 12px; font-weight: 600; color: #475569;">
            </div>
            
            <div class="time-grid">
                <!-- Morning Segment -->
                <div class="time-segment">
                    <div class="time-segment-title">🌅 Morning Segment</div>
                    <div class="time-input-group">
                        <label for="modal-morning-in">Time In</label>
                        <input type="time" id="modal-morning-in" oninput="calculateModalDuration()">
                    </div>
                    <div class="time-input-group">
                        <label for="modal-morning-out">Time Out</label>
                        <input type="time" id="modal-morning-out" oninput="calculateModalDuration()">
                    </div>
                </div>

                <!-- Afternoon Segment -->
                <div class="time-segment">
                    <div class="time-segment-title">☀️ Afternoon Segment</div>
                    <div class="time-input-group">
                        <label for="modal-afternoon-in">Time In</label>
                        <input type="time" id="modal-afternoon-in" oninput="calculateModalDuration()">
                    </div>
                    <div class="time-input-group">
                        <label for="modal-afternoon-out">Time Out</label>
                        <input type="time" id="modal-afternoon-out" oninput="calculateModalDuration()">
                    </div>
                </div>
            </div>

            <!-- Live Calculated Duration Preview -->
            <div class="live-duration-display">
                Calculated Duty: <span id="modal-duration-preview">0.00</span> hrs
            </div>

            <div class="modal-buttons">
                <button class="btn-save" onclick="saveHours()">Save</button>
                <button class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="btn-delete" id="delete-btn" style="display: none;" onclick="deleteHours()">Delete</button>
            </div>
        </div>
    </div>

    <!-- Absence Modal -->
    <div class="modal" id="absence-modal">
        <div class="modal-content">
            <div class="modal-header">Absence Request</div>
            <div id="absence-status-display" style="margin-bottom: 15px; padding: 8px; border-radius: 4px; font-weight: 600; text-align: center; display: none;"></div>
            <div class="form-group">
                <label>Date</label>
                <input type="text" id="absence-modal-date" readonly style="background: #f5f5f5;">
            </div>
            <div class="form-group">
                <label>Reason for Absence</label>
                <textarea id="absence-modal-reason" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-family: inherit; font-size: 14px; box-sizing: border-box;" placeholder="Explain why you will be absent..."></textarea>
            </div>
            <div class="modal-buttons">
                <button class="btn-save" id="absence-submit-btn" onclick="saveAbsence()">Submit Request</button>
                <button class="btn-delete" id="absence-delete-btn" style="display: none;" onclick="deleteAbsence()">Cancel Request</button>
                <button class="btn-cancel" onclick="closeAbsenceModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        let currentMonth = parseInt('<?php echo $current_month; ?>');
        let currentYear = parseInt('<?php echo $current_year; ?>');
        let userId = parseInt('<?php echo $user_id; ?>');
        let selectedDate = null;
        let hoursData = {};
        let absencesData = {};
        let monthHoursData = {};
        let allHoursData = {};
        let filterFromDate = null;
        let filterToDate = null;
        const currentUserId = userId;
        const apiBasePath = '../';
        const birthdaysData = <?php echo json_encode($birthdays); ?>;
    </script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/colleagues.js"></script>
