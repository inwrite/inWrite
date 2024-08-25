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
    <link rel="icon" type="image/svg+xml" href="/icon.svg">
    <?php $version = time(); ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.bubble.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="bubble.css?v=<?php echo $version; ?>" />
    <link rel="stylesheet" href="style.css?v=<?php echo $version; ?>" />



