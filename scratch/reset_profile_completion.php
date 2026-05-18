<?php
require_once __DIR__ . '/../config.php';

// We can pass an email as an argument, or use a default one
$email = $argv[1] ?? '';

if (empty($email)) {
    // List some users so they can choose
    $stmt = $pdo->query("SELECT email, nickname, contact FROM users LIMIT 10");
    $users = $stmt->fetchAll();
    
    echo "Usage: php scratch/reset_profile_completion.php [user_email]\n\n";
    echo "Available users in your database:\n";
    foreach ($users as $u) {
        echo " - " . $u['email'] . " (Nickname: " . ($u['nickname'] ?: 'None') . ", Contact: " . ($u['contact'] ?: 'None') . ")\n";
    }
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE users SET 
        contact = NULL, 
        birthdate = NULL, 
        province = NULL, 
        city = NULL, 
        address = NULL, 
        postal_code = NULL, 
        nickname = '' 
        WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() > 0) {
        echo "Successfully cleared profile fields for: $email\n";
        echo "Log in as this user to test the 'Complete Your Profile' modal!\n";
    } else {
        echo "No changes made. Verify that the email exists and the profile was not already cleared.\n";
    }
} catch (Exception $e) {
    echo "Error resetting profile: " . $e->getMessage() . "\n";
    echo "Note: Make sure you have run the ALTER TABLE queries to add these columns to your database!\n";
}
?>
