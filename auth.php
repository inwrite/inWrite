<?php include 'head.php'; ?>
<title>Authorization</title>
</head>
<body class="none-header">
<?php include 'header.php'; ?>

<div class="auth-form">
    <div class="hi-img">
        <!-- <img src="video/ResistanceDog_AgADxgADVp29Cg.gif" alt="" class="hi-img1"> -->
        <!-- <img src="video/ResistanceDog_AgAD2wADVp29Cg.gif" alt="" class="hi-img2-pass"> -->


<div class="container" id="cow">
  <div class="hat">
  <div class="hat-bottom"></div>
  </div>
  <div class="glasses">
    
    <div class='eye'></div>
    <div class='eye'></div>
  </div>
</div>

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









//     document.addEventListener('DOMContentLoaded', function() {
//     // const themeToggleBtn = document.querySelector('.themeToggle');

//     // if (themeToggleBtn) {
//     //     themeToggleBtn.addEventListener('click', function() {
//     //         const htmlElement = document.documentElement;

//     //         if (htmlElement.classList.contains('light-theme')) {
//     //             htmlElement.classList.remove('light-theme');
//     //             htmlElement.classList.add('dark-theme');
//     //             localStorage.setItem('theme', 'dark');
//     //         } else {
//     //             htmlElement.classList.remove('dark-theme');
//     //             htmlElement.classList.add('light-theme');
//     //             localStorage.setItem('theme', 'light');
//     //         }
//     //     });
//     // }

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
    // const themeToggleBtn = document.querySelector('.themeToggle');

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
    // if (themeToggleBtn) {
    //     themeToggleBtn.addEventListener('click', function() {
    //         const htmlElement = document.documentElement;

    //         if (htmlElement.classList.contains('light-theme')) {
    //             setTheme('dark');
    //         } else {
    //             setTheme('light');
    //         }
    //     });
    // }
});



const newPostButton = document.querySelector('.new-post');
            newPostButton.addEventListener('click', function() {
                window.location.href = '/';
            });

</script>



<script>
document.body.addEventListener('mousemove', function(event) {
  var eyes = document.querySelectorAll('.eye');
  
  eyes.forEach(function(eye) {
    var eyeRect = eye.getBoundingClientRect();
    var x = eyeRect.left + (eyeRect.width / 2);
    var y = eyeRect.top + (eyeRect.height / 2);
    var rad = Math.atan2(event.pageX - x, event.pageY - y);
    var rot = (rad * (180 / Math.PI) * -1) + 180;
    eye.style.transform = 'rotate(' + rot + 'deg)';
  });
});

document.body.addEventListener('mouseenter', function() {
  var eyes = document.querySelectorAll('.eye');
  
  eyes.forEach(function(eye) {
    eye.style.display = 'inherit';
  });
});

document.body.addEventListener('mouseleave', function() {
  var eyes = document.querySelectorAll('.eye');
  
  eyes.forEach(function(eye) {
    // eye.style.display = 'none';
  });
});







var passwordSection = document.getElementById('passwordSection');
var hiImgs = document.querySelectorAll('.hi-img');

var observer = new MutationObserver(function(mutations) {
  mutations.forEach(function(mutation) {
    if (getComputedStyle(passwordSection).display === 'flex') {
      hiImgs.forEach(function(hiImg) {
        hiImg.classList.add('lookpass');
      });
    } else {
      hiImgs.forEach(function(hiImg) {
        hiImg.classList.remove('lookpass');
      });
    }
  });
});

observer.observe(passwordSection, { attributes: true, attributeFilter: ['style'] });

</script>


</body>

</html>