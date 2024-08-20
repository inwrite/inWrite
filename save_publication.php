<?php
function transliterate($text) {
    $transliterationTable = array(
        'А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g', 'Д' => 'd', 'Е' => 'e', 'Ё' => 'yo',
        'Ж' => 'zh', 'З' => 'z', 'И' => 'i', 'Й' => 'y', 'К' => 'k', 'Л' => 'l', 'М' => 'm',
        'Н' => 'n', 'О' => 'o', 'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 'У' => 'u',
        'Ф' => 'f', 'Х' => 'kh', 'Ц' => 'ts', 'Ч' => 'ch', 'Ш' => 'sh', 'Щ' => 'shch', 'Ъ' => '',
        'Ы' => 'y', 'Ь' => '', 'Э' => 'e', 'Ю' => 'yu', 'Я' => 'ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
        'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    );
    return strtr($text, $transliterationTable);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $userDir = __DIR__ . "/users/{$username}/";
    } else {
        $username = 'incognito';
        $userDir = __DIR__ . "/incognito-publications/";
    }

    $title = isset($_POST['title']) ? $_POST['title'] : 'Untitled';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $filename = isset($_POST['filename']) ? $_POST['filename'] : '';

    $honeypot = isset($_POST['website']) ? $_POST['website'] : '';
    $startTime = isset($_POST['start_time']) ? $_POST['start_time'] : 0;
    

    // Проверка honeypot
    if (!empty($honeypot)) {
        http_response_code(400);
        echo 'Spam detected!';
        exit;
    }
    
    // Проверка времени заполнения формы
    $currentTime = time() * 1000;
    if (($currentTime - $startTime) < 5000) {
        http_response_code(400);
        echo 'Form filled too quickly. Are you a robot?';
        exit;
    }



    $filenameBase = transliterate($title);
    $filenameBase = preg_replace('/[^a-z0-9_-]/i', '-', strtolower($filenameBase));
    
    if (!$filename) {
        $date = date('Ymd-His');
        $randomString = bin2hex(random_bytes(6));
        $filename = "{$filenameBase}-{$date}-{$randomString}.html";
    }

    if (!is_dir($userDir)) {
        mkdir($userDir, 0755, true);
    }

    $filepath = $userDir . $filename;

    $htmlContent = "<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n";
    $htmlContent .= "<meta charset=\"UTF-8\">\n<title>{$title}</title>\n";
    $htmlContent .= "<link rel=\"stylesheet\" href=\"/style.css\">\n"; 
    $htmlContent .= "</head>\n<body>\n<main id=\"editor\">\n";
    $htmlContent .= $content;
    $htmlContent .= "\n</main>\n</html>";

    function extractTitle($filePath) {
        $contents = file_get_contents($filePath);
        if (preg_match('/<title>(.*?)<\/title>/', $contents, $matches)) {
            return $matches[1];
        }
        return 'Untitled';
    }

    if (file_put_contents($filepath, $htmlContent)) {
        $title = extractTitle($filepath);
        $formattedDate = date('F j, Y H:i:s', filemtime($filepath));
        
        echo json_encode([
            'filename' => $filename,
            'html' => '<li><a href="/users/' . $username . '/' . htmlspecialchars($filename) . '" ><span class="list-user-files-title">' . htmlspecialchars($title) . '</span> <span class="list-user-files-date">' . $formattedDate . '</span></a></li>'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save the file.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method.']);
}
