<?php
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )), 1, $length);
}

function generateFieldNames() {
    return [
        'username' => generateRandomString(),
        'password' => generateRandomString(),
        'secret_question' => generateRandomString(),
        'secret_answer' => generateRandomString(),
        'honeypot' => generateRandomString(),
        'timestamp' => generateRandomString()
    ];
}
?>
