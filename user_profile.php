<?php include 'head.php'; ?>
<title>User Profile</title>
</head>
<body>




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

        <div class="profile-out">
            <form id="deleteAccountForm" action="delete_user.php" method="post">
                <button type="submit" name="action" value="delete_account">Delete Account</button>
            </form>

            <form id="logoutForm" action="logout.php" method="post">
                <button type="submit">Logout</button>
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
    </script>


</body>

</html>