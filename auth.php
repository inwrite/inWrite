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



<?php if (isset($_GET['error'])): ?>
    <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<div class="auth-form">
    <div class="hi-img">
        <img src="video/ResistanceDog_AgADxgADVp29Cg.gif" alt="" class="hi-img1">
        <img src="video/ResistanceDog_AgAD2wADVp29Cg.gif" alt="" class="hi-img2-pass">
    </div>

    <form id="authForm" onsubmit="return false;">

        <div id="usernameSection" style="position: relative; margin-bottom: 1.5rem;">
            <span id="usernameMessage">Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.</span>
            <input type="text" id="profileUsername" name="username" required onkeyup="validateUsername()">
            <label for="profileUsername">Username:</label>
        </div>

        <div id="passwordSection" style="display: none; position: relative; margin-bottom: 1.5rem;">
            <span id="passwordMessage">Password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</span>
            <input type="password" id="password" name="password" required onkeyup="validatePassword()">
            <label for="password">Password:</label>
            <button type="button" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')">Show</button>

            <button type="button" id="loginButton" name="action" value="login" style="display: none;" onclick="loginUser()">Login</button>
        </div>

        <div id="secretQuestionSection" style="display: none; position: relative; margin-bottom: 1.5rem;">
            <span id="secretQuestion"></span>
            <div id="secretQuestionSection" style="position: relative;">
                <input type="text" id="secretAnswer" name="secretAnswer" onkeyup="checkSecretAnswer()">
                <label for="secretAnswer">Answer:</label>
            </div>
        </div>

        <div id="changePasswordSection" style="display: none; position: relative; margin-bottom: 1.5rem;">
            <span id="newPasswordMessage">Password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.</span>
            <input type="password" id="newPassword" name="newPassword" onkeyup="validatePassword()">
            <label for="newPassword">New Password:</label>
            <button type="button" id="toggleNewPassword" onclick="togglePasswordVisibility('newPassword', 'toggleNewPassword')">Show</button>
        </div>

        <div id="registrationSection" style="display: none; position: relative; margin-bottom: 1.5rem;">
            <div style="position: relative;">
                <span id="questionMessage">Question must be at least 2 characters long.</span>
                <input type="text" id="secret_question" name="secret_question" onkeyup="validateQuestion()">
                <label for="secret_question">Secret Question:</label>
            </div>
            <div style="position: relative;">
                <input type="text" id="secret_answer" name="secret_answer">
                <label for="secret_answer">Secret Answer:</label>
            </div>

            <input type="hidden" id="honeypot" name="honeypot">
            <input type="hidden" id="timestamp" name="timestamp" value="<?php echo time(); ?>">

        </div>
    </form>


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