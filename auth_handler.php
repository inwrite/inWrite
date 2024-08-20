<?php
session_start();
include 'user_data.php';

header('Content-Type: application/json');

function validate_username($username) {
    return preg_match('/^[a-z0-9-]{2,}$/', $username);
}

function validate_password($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/', $password);
}

function validate_question($question) {
    return strlen($question) >= 2;
}

$attempt_limit = 5;
$time_window = 300;
$minimum_time = 5;

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
    $_SESSION['first_attempt_time'] = time();
}

if (!isset($_POST['timestamp']) || !isset($_POST['username']) || !isset($_POST['action'])) {
    echo json_encode(['error' => 'Required fields are missing.']);
    exit();
}

if (!empty($_POST['honeypot'])) {
    echo json_encode(['error' => 'Bot detected!']);
    exit();
}

if (time() - $_POST['timestamp'] < $minimum_time) {
    echo json_encode(['error' => 'Form submitted too quickly!']);
    exit();
}

if ($_SESSION['attempts'] >= $attempt_limit) {
    if (time() - $_SESSION['first_attempt_time'] <= $time_window) {
        echo json_encode(['error' => 'Too many attempts. Please try again later.']);
        exit();
    } else {
        $_SESSION['attempts'] = 0;
        $_SESSION['first_attempt_time'] = time();
    }
}

$username = $_POST['username'];
$action = $_POST['action'];
$users = loadUsers();

if ($action === 'register') {
    if (!isset($_POST['password']) || !isset($_POST['secret_question']) || !isset($_POST['secret_answer'])) {
        echo json_encode(['error' => 'Required fields are missing.']);
        exit();
    }

    $password = $_POST['password'];
    $secret_question = $_POST['secret_question'];
    $secret_answer = $_POST['secret_answer'];

    if (!validate_username($username)) {
        echo json_encode(['error' => 'Invalid username!']);
        exit();
    }

    if (!validate_password($password)) {
        echo json_encode(['error' => 'Invalid password!']);
        exit();
    }

    if (!validate_question($secret_question)) {
        echo json_encode(['error' => 'Invalid secret question!']);
        exit();
    }

    saveUser($username, $password, $secret_question, $secret_answer);
    $_SESSION['username'] = $username;
    echo json_encode(['success' => true]);
    exit();
} elseif ($action === 'change_password') {
    if (!isset($_POST['newPassword'])) {
        echo json_encode(['error' => 'New password is missing.']);
        exit();
    }

    $new_password = $_POST['newPassword'];

    if (!validate_password($new_password)) {
        echo json_encode(['error' => 'Invalid new password!']);
        exit();
    }

    $user_found = false;
    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user['password_hash'] = password_hash($new_password, PASSWORD_DEFAULT);
            $user_found = true;
            break;
        }
    }

    if (!$user_found) {
        echo json_encode(['error' => 'User not found!']);
        exit();
    }

    $encrypted_data = encryptData(json_encode($users), SECRET_KEY);
    file_put_contents(DATA_FILE, $encrypted_data);
    $_SESSION['username'] = $username;
    echo json_encode(['success' => 'Password changed successfully!']);
    exit();
} elseif ($action === 'change_question') {
    if (!isset($_POST['secret_question']) || !isset($_POST['secret_answer'])) {
        echo json_encode(['error' => 'Secret question or answer is missing.']);
        exit();
    }

    $secret_question = $_POST['secret_question'];
    $secret_answer = $_POST['secret_answer'];

    if (!validate_question($secret_question)) {
        echo json_encode(['error' => 'Invalid secret question!']);
        exit();
    }

    $user_found = false;
    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user['secret_question'] = $secret_question;
            $user['secret_answer_hash'] = password_hash($secret_answer, PASSWORD_DEFAULT);
            $user_found = true;
            break;
        }
    }

    if (!$user_found) {
        echo json_encode(['error' => 'User not found!']);
        exit();
    }

    $encrypted_data = encryptData(json_encode($users), SECRET_KEY);
    file_put_contents(DATA_FILE, $encrypted_data);
    $_SESSION['username'] = $username;
    echo json_encode(['success' => 'Secret question and answer changed successfully!']);
    exit();
} elseif ($action === 'login') {
    if (!isset($_POST['password'])) {
        echo json_encode(['error' => 'Password is missing.']);
        exit();
    }

    $password = $_POST['password'];
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password_hash'])) {
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true]);
            exit();
        }
    }
    $_SESSION['attempts'] += 1;
    echo json_encode(['error' => 'Invalid username or password.']);
    exit();
} else {
    echo json_encode(['error' => 'Invalid action.']);
    exit();
}
?>
