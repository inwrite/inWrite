<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    return;
}

$username = $_SESSION['username'];
$userDir = __DIR__ . "/users/{$username}/";

if (!is_dir($userDir)) {
    echo json_encode(["error" => "User directory does not exist."]);
    return;
}

$htmlFiles = glob($userDir . '*.html');

$response = [];

foreach ($htmlFiles as $file) {
    $title = 'Untitled';

    $content = file_get_contents($file);
    if (preg_match('/<title>(.*?)<\/title>/', $content, $matches)) {
        $title = $matches[1];
    }

    $response[] = [
        'filename' => basename($file),
        'title' => $title
    ];
}

echo json_encode($response);

?>
