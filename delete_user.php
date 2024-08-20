<?php
session_start();
include 'user_data.php';

if (!isset($_SESSION['username'])) {
    header("Location: /");
    exit();
}

$username = $_SESSION['username'];

$users = loadUsers();
$updated_users = [];

foreach ($users as $user) {
    if ($user['username'] !== $username) {
        $updated_users[] = $user;
    }
}

$encrypted_data = encryptData(json_encode($updated_users), SECRET_KEY);
file_put_contents(DATA_FILE, $encrypted_data);

session_unset();
session_destroy();

$user_dir = 'users/' . $username;
if (is_dir($user_dir)) {
    array_map('unlink', glob("$user_dir/*.*"));
    rmdir($user_dir);
}

header("Location: /");
exit();
?>
