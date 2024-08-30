<?php include 'head.php'; ?>
<title>User Profile</title>
</head>

<body class="none-header">
    <?php include 'header.php'; ?>



    <div class="auth-form">

        <div class="hi-img">
            <img src="video/ResistanceDog_AgAD5wADVp29Cg.gif" alt="" class="hi-img1">
        </div>

        <h2>User Profile</h2>
        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>







        <form id="questionForm" onsubmit="return false;">
            <input type="hidden" name="timestamp" value="<?php echo time(); ?>">
            <input type="hidden" id="questionUsername" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="action" value="change_question">

            <div id="secret_questionSection" style="position: relative;">
                <span id="questionMessage">Question must be at least 2 characters long.</span>
                <input type="text" id="secret_question" name="secret_question" onkeyup="validateQuestion()">
                <label for="secret_question">Secret Question:</label>
            </div>

            <div id="secret_answerSection" style="position: relative;">
                <input type="text" id="secret_answer" name="secret_answer">
                <label for="secret_answer">Secret Answer:</label>
            </div>

            <button type="button" onclick="changeSecretQuestion()">Update Secret Question and Answer</button>
        </form>

        <button id="toggleClassBtn">

            <svg fill="currentColor" width="24px" height="24px" viewBox="-5.5 0 19 19" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.987 5.653a4.536 4.536 0 0 1-.149 1.213 4.276 4.276 0 0 1-.389.958 5.186 5.186 0 0 1-.533.773c-.195.233-.386.454-.568.658l-.024.026c-.17.18-.328.353-.468.516a3.596 3.596 0 0 0-.4.567 2.832 2.832 0 0 0-.274.677 3.374 3.374 0 0 0-.099.858v.05a1.03 1.03 0 0 1-2.058 0v-.05a5.427 5.427 0 0 1 .167-1.385 4.92 4.92 0 0 1 .474-1.17 5.714 5.714 0 0 1 .63-.89c.158-.184.335-.38.525-.579.166-.187.34-.39.52-.603a3.108 3.108 0 0 0 .319-.464 2.236 2.236 0 0 0 .196-.495 2.466 2.466 0 0 0 .073-.66 1.891 1.891 0 0 0-.147-.762 1.944 1.944 0 0 0-.416-.633 1.917 1.917 0 0 0-.62-.418 1.758 1.758 0 0 0-.723-.144 1.823 1.823 0 0 0-.746.146 1.961 1.961 0 0 0-1.06 1.062 1.833 1.833 0 0 0-.146.747v.028a1.03 1.03 0 1 1-2.058 0v-.028a3.882 3.882 0 0 1 .314-1.56 4.017 4.017 0 0 1 2.135-2.139 3.866 3.866 0 0 1 1.561-.314 3.792 3.792 0 0 1 1.543.314A3.975 3.975 0 0 1 7.678 4.09a3.933 3.933 0 0 1 .31 1.563zm-2.738 9.81a1.337 1.337 0 0 1 0 1.033 1.338 1.338 0 0 1-.71.71l-.005.003a1.278 1.278 0 0 1-.505.103 1.338 1.338 0 0 1-1.244-.816 1.313 1.313 0 0 1 .284-1.451 1.396 1.396 0 0 1 .434-.283 1.346 1.346 0 0 1 .526-.105 1.284 1.284 0 0 1 .505.103l.005.003a1.404 1.404 0 0 1 .425.281 1.28 1.28 0 0 1 .285.418z" />
            </svg>


            <span>Change security question</span>
            <span>Close</span></button>

        <div class="profile-out">
            <button class="themeToggle">
                <svg class="themeIconNight" width="24px" height="24px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3,11.985A9.811,9.811,0,0,0,12.569,22a9.528,9.528,0,0,0,8.309-5.059,1,1,0,0,0-.947-1.477l-.11.008c-.131.01-.263.02-.4.02a7.811,7.811,0,0,1-7.569-8.015,8.378,8.378,0,0,1,1.016-4A1,1,0,0,0,11.923,2,9.855,9.855,0,0,0,3,11.985Zm7.343-7.652a10.382,10.382,0,0,0-.488,3.144A9.89,9.89,0,0,0,18.137,17.4,7.4,7.4,0,0,1,12.569,20,7.811,7.811,0,0,1,5,11.985,7.992,7.992,0,0,1,10.343,4.333Z" />
                </svg>


                <svg class="themeIconLight" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="24px" height="24px" viewBox="0 0 512 512" xml:space="preserve">
                    <path d="M360.266,43.188C333.656,16.531,296.656-0.016,256,0c-40.656-0.016-77.656,16.531-104.266,43.188
                        c-26.641,26.625-43.203,63.609-43.188,104.266c-0.016,34.641,12.016,66.656,32.078,91.797c5.906,7.438,11.016,13.609,15.094,18.906
                        c3.063,3.969,5.547,7.438,7.516,10.594c2.953,4.75,4.75,8.672,6.078,13.375c1.297,4.719,2.094,10.469,2.109,18.594
                        c0,5.469,0.609,10.797,2.141,16.031c1.141,3.906,2.844,7.781,5.25,11.344c3.547,5.375,8.813,9.891,14.594,12.563
                        c5.766,2.703,11.781,3.688,17.391,3.688h90.422c4.984,0,10.281-0.781,15.469-2.859c3.875-1.547,7.656-3.859,10.875-6.828
                        c4.875-4.438,8.297-10.141,10.281-15.953c2-5.844,2.75-11.828,2.75-17.984c0-7.219,0.641-12.578,1.688-16.969
                        c1.625-6.563,4-11.438,8.641-18.266c4.609-6.766,11.578-15.078,20.484-26.234c20.047-25.141,32.063-57.172,32.047-91.797
                        C403.469,106.797,386.906,69.813,360.266,43.188z M338.531,213.063c-5.672,7.094-10.781,13.297-15.516,19.406
                        c-3.531,4.594-6.859,9.156-9.906,14.031c-4.547,7.281-8.422,15.375-10.922,24.438s-3.625,18.859-3.625,29.781
                        c0,0.594-0.016,1.125-0.047,1.594h-85c-0.031-0.469-0.063-0.984-0.063-1.594c0-9.719-0.875-18.531-2.859-26.75
                        c-2.906-12.359-8.391-22.922-14.828-32.25c-6.484-9.406-13.813-18-22.266-28.656c-14.375-18.047-22.906-40.734-22.922-65.609
                        c0.016-29.172,11.766-55.391,30.891-74.547C200.609,53.797,226.813,42.031,256,42.031s55.406,11.766,74.547,30.875 c19.109,19.156,30.859,45.375,30.875,74.547C361.406,172.344,352.875,195.031,338.531,213.063z" />
                    <path d="M256,512c17.406,0,31.531-14.109,31.531-31.531h-63.063C224.469,497.891,238.594,512,256,512z" />
                    <path d="M310.047,369.375H201.969c-9.406,0-17.016,7.609-17.016,17c0,9.406,7.609,17.016,17.016,17.016h108.078  c9.391,0,17.016-7.609,17.016-17.016C327.063,376.984,319.438,369.375,310.047,369.375z" />
                    <path d="M310.047,424.297H201.969c-9.406,0-17.016,7.609-17.016,17.016c0,9.391,7.609,17,17.016,17h108.078 c9.391,0,17.016-7.609,17.016-17C327.063,431.906,319.438,424.297,310.047,424.297z" />
                </svg>
                <span>Turn on light theme</span>
                <span>Turn on dark theme</span>
            </button>



            <form id="logoutForm" action="logout.php" method="post">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="h-5 w-5 shrink-0">
                        <path fill="currentColor" fill-rule="evenodd" d="M6 4a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h4a1 1 0 1 1 0 2H6a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h4a1 1 0 1 1 0 2zm9.293 3.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L17.586 13H11a1 1 0 1 1 0-2h6.586l-2.293-2.293a1 1 0 0 1 0-1.414" clip-rule="evenodd"></path>
                    </svg>
                    Logout</button>
            </form>

            <form id="deleteAccountForm" action="delete_user.php" method="post">
                <button type="submit" name="action" value="delete_account">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon-md">
                        <path fill="currentColor" fill-rule="evenodd" d="M5.636 5.636a1 1 0 0 1 1.414 0l4.95 4.95 4.95-4.95a1 1 0 0 1 1.414 1.414L13.414 12l4.95 4.95a1 1 0 0 1-1.414 1.414L12 13.414l-4.95 4.95a1 1 0 0 1-1.414-1.414l4.95-4.95-4.95-4.95a1 1 0 0 1 0-1.414" clip-rule="evenodd"></path>
                    </svg>
                    Delete Account</button>
            </form>
        </div>






    </div>


    <script src="messageHandler.js?v=<?php echo $version; ?>"></script>
    <script src="assets/js/auth.js?v=<?php echo $version; ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputElements = document.querySelectorAll('input');

            inputElements.forEach(function(inputElement) {
                inputElement.addEventListener('input', function() {
                    if (inputElement.value.length > 0) {
                        inputElement.classList.add('get-focus');
                    } else {
                        inputElement.classList.remove('get-focus');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var inputElements = document.querySelectorAll('input');

            inputElements.forEach(function(inputElement) {
                var formElement = inputElement.closest('form');

                if (formElement) {
                    inputElement.addEventListener('focus', function() {
                        removeInputClasses(formElement, inputElements);
                        formElement.classList.add(inputElement.id);
                    });

                    inputElement.addEventListener('mouseenter', function() {
                        removeInputClasses(formElement, inputElements);
                        formElement.classList.add(inputElement.id);
                    });

                    inputElement.addEventListener('blur', function() {
                        if (!inputElement.matches(':hover')) {
                            formElement.classList.remove(inputElement.id);
                        }
                    });

                    inputElement.addEventListener('mouseleave', function() {
                        if (!inputElement.matches(':focus')) {
                            formElement.classList.remove(inputElement.id);
                        }
                    });
                }
            });

            function removeInputClasses(formElement, inputElements) {
                inputElements.forEach(function(input) {
                    if (input.id) {
                        formElement.classList.remove(input.id);
                    }
                });
            }
        });





        function togglePasswordVisibility(passwordFieldId, toggleButtonId) {
            var passwordField = document.getElementById(passwordFieldId);
            var toggleButton = document.getElementById(toggleButtonId);
            var hiImgDiv = document.querySelector('.hi-img');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = 'Hide';
                if (hiImgDiv) {
                    hiImgDiv.classList.add('hide-img-password');
                }
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = 'Show';
                if (hiImgDiv) {
                    hiImgDiv.classList.remove('hide-img-password');
                }
            }
        }













        // document.addEventListener('DOMContentLoaded', function() {
        //     const themeToggleBtn = document.querySelector('.themeToggle');

        //     if (themeToggleBtn) {
        //         themeToggleBtn.addEventListener('click', function() {
        //             const htmlElement = document.documentElement;

        //             if (htmlElement.classList.contains('light-theme')) {
        //                 htmlElement.classList.remove('light-theme');
        //                 htmlElement.classList.add('dark-theme');
        //                 localStorage.setItem('theme', 'dark');
        //             } else {
        //                 htmlElement.classList.remove('dark-theme');
        //                 htmlElement.classList.add('light-theme');
        //                 localStorage.setItem('theme', 'light');
        //             }
        //         });
        //     }

        //     // Проверка сохранённой темы при загрузке страницы
        //     const savedTheme = localStorage.getItem('theme');
        //     if (savedTheme === 'dark') {
        //         document.documentElement.classList.add('dark-theme');
        //         document.documentElement.classList.remove('light-theme');
        //     } else if (savedTheme === 'light') {
        //         document.documentElement.classList.add('light-theme');
        //         document.documentElement.classList.remove('dark-theme');
        //     }
        // });





document.addEventListener('DOMContentLoaded', function() {
    const themeToggleBtn = document.querySelector('.themeToggle');

    // Функция для установки темы
    function setTheme(theme) {
        const htmlElement = document.documentElement;
        if (theme === 'dark') {
            htmlElement.classList.add('dark-theme');
            htmlElement.classList.remove('light-theme');
            localStorage.setItem('theme', 'dark');
        } else if (theme === 'light') {
            htmlElement.classList.add('light-theme');
            htmlElement.classList.remove('dark-theme');
            localStorage.setItem('theme', 'light');
        }
    }

    // Проверка сохранённой темы при загрузке страницы
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        setTheme(savedTheme);
    } else {
        // Если сохранённой темы нет, используем системные настройки
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            setTheme('dark');
        } else {
            setTheme('light');
        }
    }

    // Переключение темы по нажатию на кнопку
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            const htmlElement = document.documentElement;

            if (htmlElement.classList.contains('light-theme')) {
                setTheme('dark');
            } else {
                setTheme('light');
            }
        });
    }
});







        document.getElementById('toggleClassBtn').addEventListener('click', function() {
            document.body.classList.toggle('open-answer');
        });



        const newPostButton = document.querySelector('.new-post');
        newPostButton.addEventListener('click', function() {
            window.location.href = '/';
        });
    </script>


</body>

</html>