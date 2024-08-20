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
        <img src="video/ResistanceDog_AgAD5wADVp29Cg.gif" alt="" class="hi-img1">
    </div>

    <div class="preloader">
    <div>
        <span class="adress-typed"><span>I</span>nWrite</span>


    </div>
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