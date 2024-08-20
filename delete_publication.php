<?php
session_start();

header('Content-Type: application/json');

try {
    if (!isset($_SESSION['username'])) {
        throw new Exception('User not authorized');
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['filename'])) {
        throw new Exception('File name not passed');
    }

    $username = $_SESSION['username'];
    $filename = basename($data['filename']);
    $userDir = __DIR__ . "/users/{$username}/";
    $filePath = $userDir . $filename;

    if (!file_exists($filePath)) {
        throw new Exception('The file does not exist');
    }

    if (!unlink($filePath)) {
        throw new Exception('Failed to delete file');
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit;
}
