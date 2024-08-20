<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = isset($_POST['filename']) ? $_POST['filename'] : '';

    if (!$filename) {
        echo json_encode(['error' => 'No filename provided.']);
        exit;
    }

    $filepath = __DIR__ . "/users/{$_SESSION['username']}/" . basename($filename);

    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
        if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $content, $matches)) {
            echo json_encode(['success' => true, 'content' => $matches[1]]);
        } else {
            echo json_encode(['error' => 'Could not extract content from file.']);
        }
    } else {
        echo json_encode(['error' => 'File not found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}


