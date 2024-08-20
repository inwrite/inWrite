<?php
include 'user_data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $users = loadUsers();
    $exists = false;

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $exists = true;
            break;
        }
    }

    echo json_encode(['exists' => $exists]);
}
?>
