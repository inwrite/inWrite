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
    <title>InWrite</title>
    <?php $version = time(); ?>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.bubble.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css?v=<?php echo $version; ?>" />

</head>

<body class="<?php echo $bodyClass; ?>">

















    <header>



    <div class="header-sidebar">
        <p class="login">
            <?php if (isset($_SESSION['username'])): ?>

                <button class="new-post">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" class="icon-xl-heavy">
                        <path d="M15.673 3.913a3.121 3.121 0 1 1 4.414 4.414l-5.937 5.937a5 5 0 0 1-2.828 1.415l-2.18.31a1 1 0 0 1-1.132-1.13l.311-2.18A5 5 0 0 1 9.736 9.85zm3 1.414a1.12 1.12 0 0 0-1.586 0l-5.937 5.937a3 3 0 0 0-.849 1.697l-.123.86.86-.122a3 3 0 0 0 1.698-.849l5.937-5.937a1.12 1.12 0 0 0 0-1.586M11 4A1 1 0 0 1 10 5c-.998 0-1.702.008-2.253.06-.54.052-.862.141-1.109.267a3 3 0 0 0-1.311 1.311c-.134.263-.226.611-.276 1.216C5.001 8.471 5 9.264 5 10.4v3.2c0 1.137 0 1.929.051 2.546.05.605.142.953.276 1.216a3 3 0 0 0 1.311 1.311c.263.134.611.226 1.216.276.617.05 1.41.051 2.546.051h3.2c1.137 0 1.929 0 2.546-.051.605-.05.953-.142 1.216-.276a3 3 0 0 0 1.311-1.311c.126-.247.215-.569.266-1.108.053-.552.06-1.256.06-2.255a1 1 0 1 1 2 .002c0 .978-.006 1.78-.069 2.442-.064.673-.192 1.27-.475 1.827a5 5 0 0 1-2.185 2.185c-.592.302-1.232.428-1.961.487C15.6 21 14.727 21 13.643 21h-3.286c-1.084 0-1.958 0-2.666-.058-.728-.06-1.369-.185-1.96-.487a5 5 0 0 1-2.186-2.185c-.302-.592-.428-1.233-.487-1.961C3 15.6 3 14.727 3 13.643v-3.286c0-1.084 0-1.958.058-2.666.06-.729.185-1.369.487-1.961A5 5 0 0 1 5.73 3.545c.556-.284 1.154-.411 1.827-.475C8.22 3.007 9.021 3 10 3A1 1 0 0 1 11 4"></path>
                    </svg>
                    <span>New Post</span>
                </button>

                <button class="bottom-open-sidebar">
                    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" class="icon-md text-token-text-tertiary">
                            <path fill="currentColor" fill-rule="evenodd" d="M5.293 9.293a1 1 0 0 1 1.414 0L12 14.586l5.293-5.293a1 1 0 1 1 1.414 1.414l-6 6a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </button>


            <?php else: ?>
                <button class="new-post">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" class="icon-xl-heavy">
                        <path d="M15.673 3.913a3.121 3.121 0 1 1 4.414 4.414l-5.937 5.937a5 5 0 0 1-2.828 1.415l-2.18.31a1 1 0 0 1-1.132-1.13l.311-2.18A5 5 0 0 1 9.736 9.85zm3 1.414a1.12 1.12 0 0 0-1.586 0l-5.937 5.937a3 3 0 0 0-.849 1.697l-.123.86.86-.122a3 3 0 0 0 1.698-.849l5.937-5.937a1.12 1.12 0 0 0 0-1.586M11 4A1 1 0 0 1 10 5c-.998 0-1.702.008-2.253.06-.54.052-.862.141-1.109.267a3 3 0 0 0-1.311 1.311c-.134.263-.226.611-.276 1.216C5.001 8.471 5 9.264 5 10.4v3.2c0 1.137 0 1.929.051 2.546.05.605.142.953.276 1.216a3 3 0 0 0 1.311 1.311c.263.134.611.226 1.216.276.617.05 1.41.051 2.546.051h3.2c1.137 0 1.929 0 2.546-.051.605-.05.953-.142 1.216-.276a3 3 0 0 0 1.311-1.311c.126-.247.215-.569.266-1.108.053-.552.06-1.256.06-2.255a1 1 0 1 1 2 .002c0 .978-.006 1.78-.069 2.442-.064.673-.192 1.27-.475 1.827a5 5 0 0 1-2.185 2.185c-.592.302-1.232.428-1.961.487C15.6 21 14.727 21 13.643 21h-3.286c-1.084 0-1.958 0-2.666-.058-.728-.06-1.369-.185-1.96-.487a5 5 0 0 1-2.186-2.185c-.302-.592-.428-1.233-.487-1.961C3 15.6 3 14.727 3 13.643v-3.286c0-1.084 0-1.958.058-2.666.06-.729.185-1.369.487-1.961A5 5 0 0 1 5.73 3.545c.556-.284 1.154-.411 1.827-.475C8.22 3.007 9.021 3 10 3A1 1 0 0 1 11 4"></path>
                    </svg>
                    <span>New Post</span>
                </button>

                <button class="bottom-open-sidebar">
                    <h1><span>I</span>nWrite</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" class="icon-md text-token-text-tertiary">
                        <path fill="currentColor" fill-rule="evenodd" d="M5.293 9.293a1 1 0 0 1 1.414 0L12 14.586l5.293-5.293a1 1 0 1 1 1.414 1.414l-6 6a1 1 0 0 1-1.414 0l-6-6a1 1 0 0 1 0-1.414" clip-rule="evenodd"></path>
                    </svg>
                </button>

            <?php endif; ?>
        </p>





        <div class="authuserBox">
            <div class="authuserBox__list">
                <p>InWrite is a service for those who want to write and share their thoughts freely and anonymously, while maintaining their privacy and ensuring their content remains secure. <br>The project's code is available on <a href="https://github.com/netwebdev/inWrite/" target="_blank">GitHub</a> for review, distribution, and modification.</p>
                <h2>Your posts</h2>
                <p>You haven't created any posts yet</p>
                <div class="ul-list-file"></div>
                <div class="login-authuserBox">
                    <div class="em"></div>
                    <?php if (isset($_SESSION['username'])): ?>

                        <button class="goUserProfile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="h-5 w-5 shrink-0">
                                <path fill="currentColor" fill-rule="evenodd" d="M12 4a3 3 0 1 0 0 6 3 3 0 0 0 0-6M7 7a5 5 0 1 1 10 0A5 5 0 0 1 7 7M10.968 14.002a1 1 0 0 1-.719 1.218C7.467 15.937 5.5 18.29 5.5 21a1 1 0 1 1-2 0c0-3.729 2.69-6.8 6.25-7.717a1 1 0 0 1 1.218.72" clip-rule="evenodd"></path>
                                <path fill="currentColor" d="M17.25 15.625a1.625 1.625 0 1 1-3.25 0 1.625 1.625 0 0 1 3.25 0M21.75 15.625a1.625 1.625 0 1 1-3.25 0 1.625 1.625 0 0 1 3.25 0M21.75 20.125a1.625 1.625 0 1 1-3.25 0 1.625 1.625 0 0 1 3.25 0M17.25 20.125a1.625 1.625 0 1 1-3.25 0 1.625 1.625 0 0 1 3.25 0"></path>
                            </svg>
                            Go to your profile — <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </button>


                    <?php else: ?>
                        <button class="goLoginPage">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18 20C18.2652 20 18.5196 19.8946 18.7071 19.7071C18.8946 19.5196 19 19.2652 19 19L19 5C19 4.73478 18.8946 4.48043 18.7071 4.29289C18.5196 4.10536 18.2652 4 18 4L14 4C13.7348 4 13.4804 3.89464 13.2929 3.70711C13.1054 3.51957 13 3.26522 13 3C13 2.73478 13.1054 2.48043 13.2929 2.29289C13.4804 2.10536 13.7348 2 14 2L18 2C18.7956 2 19.5587 2.31607 20.1213 2.87868C20.6839 3.44129 21 4.20435 21 5L21 19C21 19.7956 20.6839 20.5587 20.1213 21.1213C19.5587 21.6839 18.7956 22 18 22L14 22C13.7348 22 13.4804 21.8946 13.2929 21.7071C13.1054 21.5196 13 21.2652 13 21C13 20.7348 13.1054 20.4804 13.2929 20.2929C13.4804 20.1054 13.7348 20 14 20L18 20Z" fill="currentColor" />
                                <path d="M9.00031 7C8.73515 7 8.48085 7.10532 8.29333 7.29279C8.10586 7.48032 8.00054 7.73462 8.00054 7.99979C8.00054 8.26495 8.10586 8.51926 8.29332 8.70679L10.5863 10.9998L4.00041 10.9998C3.7352 10.9998 3.48085 11.1051 3.29331 11.2927C3.10578 11.4802 3.00043 11.7346 3.00043 11.9998C3.00043 12.265 3.10578 12.5194 3.29331 12.7069C3.48085 12.8944 3.7352 12.9998 4.00041 12.9998L10.5863 12.9998L8.29332 15.2928C8.11117 15.4814 8.01038 15.734 8.01266 15.9962C8.01493 16.2584 8.1201 16.5092 8.30551 16.6946C8.49091 16.88 8.74172 16.9852 9.00391 16.9875C9.2661 16.9897 9.5187 16.8889 9.7073 16.7068L13.7072 12.7068C13.8947 12.5193 14 12.265 14 11.9998C14 11.7346 13.8947 11.4803 13.7072 11.2928L9.7073 7.29279C9.51977 7.10532 9.26547 7 9.00031 7Z" fill="currentColor" />
                            </svg>
                            To view and edit your publications?
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="publishAllbtn">
            <!-- <div class="wordCountDiv"></div> -->
            <button id="publishbtn" class="btn-primary">Publish</button>
        </div>


    </div>


    </header>