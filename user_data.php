<?php
define('DATA_FILE', 'users.dat');
define('SECRET_KEY', 'your-secret-key'); // Замените на свой секретный ключ

function encryptData($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptData($data, $key) {
    $data = base64_decode($data);
    $iv = substr($data, 0, openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = substr($data, openssl_cipher_iv_length('aes-256-cbc'));
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}


function saveUser($username, $password, $secret_question, $secret_answer) {
    $users = loadUsers();
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $secret_answer_hash = password_hash($secret_answer, PASSWORD_DEFAULT);
    $users[] = [
        'username' => $username,
        'password_hash' => $password_hash,
        'secret_question' => $secret_question,
        'secret_answer_hash' => $secret_answer_hash
    ];
    $encrypted_data = encryptData(json_encode($users), SECRET_KEY);
    file_put_contents(DATA_FILE, $encrypted_data);

    $user_dir = 'users/' . $username;
    if (!is_dir($user_dir)) {
        mkdir($user_dir, 0777, true);
    }
}

function loadUsers() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $encrypted_data = file_get_contents(DATA_FILE);
    $data = decryptData($encrypted_data, SECRET_KEY);
    return json_decode($data, true);
}
?>
