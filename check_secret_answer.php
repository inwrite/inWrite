<?php
include 'user_data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $secretAnswer = $_POST['secretAnswer'];
    $users = loadUsers();
    $valid = false;

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($secretAnswer, $user['secret_answer_hash'])) {
            $valid = true;
            break;
        }
    }

    echo json_encode(['valid' => $valid]);
}
?>
