<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$bodyClass = isset($_SESSION['username']) ? 'authuser' : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <?php $version = time(); ?>
    <link rel="stylesheet" href="style.css?v=<?php echo $version; ?>" />
</head>

    <body>
    <main id="editor">
        <p><strong class="about"><span>I</span>nWrite</strong> is an anonymous service for those who want to write and share their thoughts while maintaining complete confidentiality. InWrite allows you to publish articles, stories, and any other texts without revealing your identity. The service's code is open-source and available for free download, enabling you to host it on any PHP-supported hosting platform. This gives you full independence and control over your data, ensuring the security and privacy of your publications. You can learn more about the code by following the <a href="https://github.com/netwebdev/inWrite/" target="_blank">github.com/inWrite</a>
        </p>
    </main>

    </body>
</html>