<?php
include 'user_data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $users = loadUsers();
    $question = null;

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            $question = $user['secret_question'];
            break;
        }
    }

    echo json_encode(['question' => $question]);
}
?>
