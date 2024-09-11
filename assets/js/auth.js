
function validateUsername() {
    var username = document.getElementById('profileUsername').value;
    var message = "";
    var messageColor = "var(--text-error-)";
    var regex = /^[a-z0-9-]{2,}$/;

    if (username.length < 2) {
        message = "Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.";
    } else if (!regex.test(username)) {
        message = "Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.";
    } else {
        message = "Username is valid.";
        messageColor = "var(--text-success-)";
    }

    document.getElementById('usernameMessage').innerText = message;
    document.getElementById('usernameMessage').style.color = messageColor;
    if (username.length >= 2 && regex.test(username)) {
        checkUsername();
    }
}


function validatePassword() {

    var passwordField = document.getElementById('password');
    var newPasswordField = document.getElementById('newPassword');

    if (newPasswordField && newPasswordField.offsetParent !== null) {
        passwordField = newPasswordField;
    }


    if (passwordField) {
        var isChangePassword = passwordField.id === 'newPassword';
    } else {
        return;  
    } 

    var password = passwordField.value;
    var message = "";
    var messageColor = "var(--text-error-)";
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;

    ['continueQuestionButton', 'loginButton', 'forgotPasswordButton', 'changePasswordButton'].forEach(function(id) {
        var button = document.getElementById(id);
        if (button) button.remove();
    });

    var isRegistration = !!document.getElementById('continueRegistrationButton');

    if (!isRegistration && password.length > 0 && !isChangePassword) {
        var forgotPasswordButton = document.createElement('button');
        forgotPasswordButton.type = 'button';
        forgotPasswordButton.id = 'forgotPasswordButton';
        forgotPasswordButton.style.display = 'block';
        forgotPasswordButton.style.marginTop = '10px';
        forgotPasswordButton.innerText = 'Forgot Password?';
        forgotPasswordButton.onclick = forgotPassword;
        document.getElementById('passwordSection').appendChild(forgotPasswordButton);
    }

    if (password.length < 6) {
        message = "Password must be at least 6 characters long.";
    } else if (!regex.test(password)) {
        message = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        message = "Password is valid.";
        messageColor = "var(--text-success-)";

        if (isRegistration) {
            var continueQuestionButton = document.createElement('button');
            continueQuestionButton.type = 'button';
            continueQuestionButton.id = 'continueQuestionButton';
            continueQuestionButton.style.display = 'block';
            continueQuestionButton.style.marginTop = '10px';
            continueQuestionButton.innerText = 'Next step question & answer';
            continueQuestionButton.onclick = function() {
                document.getElementById('passwordSection').style.display = 'none';
                document.getElementById('registrationSection').style.display = 'block';
            };
            document.getElementById('passwordSection').appendChild(continueQuestionButton);
        } else if (isChangePassword) {
            var changePasswordButton = document.createElement('button');
            changePasswordButton.type = 'button';
            changePasswordButton.id = 'changePasswordButton';
            changePasswordButton.style.display = 'block';
            changePasswordButton.style.marginTop = '10px';
            changePasswordButton.innerText = 'Change Password';
            changePasswordButton.onclick = changePassword;
            document.getElementById('changePasswordSection').appendChild(changePasswordButton);
        } else {
            var loginButton = document.createElement('button');
            loginButton.type = 'button';
            loginButton.id = 'loginButton';
            loginButton.name = 'action';
            loginButton.value = 'login';
            loginButton.style.display = 'block';
            loginButton.style.marginTop = '10px';
            loginButton.innerText = 'Login';
            loginButton.onclick = loginUser;
            document.getElementById('passwordSection').appendChild(loginButton);
        }
    }

    var passwordMessageElement = isChangePassword ? 
        document.getElementById('newPasswordMessage') : 
        document.getElementById('passwordMessage');
        
    if (passwordMessageElement) {
        passwordMessageElement.innerText = message;
        passwordMessageElement.style.color = messageColor;
    } else {
    }
}


function validateQuestionAndAnswer() {
    var question = document.getElementById('secret_question').value;
    var answer = document.getElementById('secret_answer').value;
    var isValidQuestion = question.length >= 2;
    var isValidAnswer = answer.length > 0;

    document.getElementById('questionMessage').innerText = isValidQuestion ? 'Question is valid.' : 'Question must be at least 2 characters long.';
    document.getElementById('questionMessage').style.color = isValidQuestion ? 'var(--text-success-)' : 'var(--text-error-)';

    var registerButton = document.getElementById('registerButton');
    if (registerButton) {
        registerButton.remove();
    }

    if (isValidQuestion && isValidAnswer) {
        registerButton = document.createElement('button');
        registerButton.type = 'button';
        registerButton.id = 'registerButton';
        registerButton.name = 'action';
        registerButton.value = 'register';
        registerButton.innerText = 'Register';
        registerButton.onclick = registerUser;

        document.getElementById('registrationSection').appendChild(registerButton);
    }
}

document.getElementById('secret_question').addEventListener('input', validateQuestionAndAnswer);
document.getElementById('secret_answer').addEventListener('input', validateQuestionAndAnswer);



function checkUsername() {
    var username = document.getElementById('profileUsername').value;

    if (username.length < 2) {
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_username.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            var messageElement = document.getElementById('usernameMessage');
            var usernameSection = document.getElementById('usernameSection');

            var continueRegistrationButton = document.getElementById('continueRegistrationButton');
            var loginButton = document.getElementById('loginButton');
            if (continueRegistrationButton) {
                continueRegistrationButton.remove();
            }
            if (loginButton) {
                loginButton.remove();
            }

            var newButton = document.createElement('button');
            newButton.type = 'button';
            newButton.style.display = 'block';
            newButton.style.marginTop = '10px';

            if (response.exists) {
                messageElement.innerText = 'Username is taken';
                // messageElement.style.color = 'var(--color-primary)';
                messageElement.style.color = 'var(--link-)';

                newButton.id = 'loginButton';
                newButton.innerText = 'Login';
                newButton.onclick = function() {
                    document.getElementById('usernameSection').style.display = 'none';
                    document.getElementById('passwordSection').style.display = 'flex';
                };
            } else {
                messageElement.innerText = 'Username is available';
                messageElement.style.color = 'var(--text-success-)';

                newButton.id = 'continueRegistrationButton';
                newButton.innerText = 'Continue registration';
                newButton.onclick = function() {
                    document.getElementById('usernameSection').style.display = 'none';
                    document.getElementById('passwordSection').style.display = 'flex';
                };
            }

            usernameSection.appendChild(newButton);
        }
    };
    xhr.send('username=' + encodeURIComponent(username));
}


function checkUsername() {
    var username = document.getElementById('profileUsername').value;
    var messageElement = document.getElementById('usernameMessage');
    var usernameSection = document.getElementById('usernameSection');

    var continueRegistrationButton = document.getElementById('continueRegistrationButton');
    var loginButton = document.getElementById('loginButton');
    if (continueRegistrationButton) {
        continueRegistrationButton.remove();
    }
    if (loginButton) {
        loginButton.remove();
    }

    if (username.length < 2 || !/^[a-z0-9-]+$/.test(username)) {
        messageElement.innerText = 'Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.';
        messageElement.style.color = 'var(--text-error-)';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_username.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.exists) {
                messageElement.innerText = 'Username is taken';
                // messageElement.style.color = 'var(--color-primary)';
                messageElement.style.color = ' var(--link-)';

                if (!document.getElementById('loginButton')) {
                    var newButton = document.createElement('button');
                    newButton.type = 'button';
                    newButton.id = 'loginButton';
                    newButton.style.display = 'block';
                    newButton.style.marginTop = '10px';
                    newButton.innerText = 'Login';
                    newButton.onclick = function() {
                        document.getElementById('usernameSection').style.display = 'none';
                        document.getElementById('passwordSection').style.display = 'flex';
                    };
                    usernameSection.appendChild(newButton);
                }
            } else {
                messageElement.innerText = 'Username is available';
                messageElement.style.color = 'var(--text-success-)';

                if (!document.getElementById('continueRegistrationButton')) {
                    var newButton = document.createElement('button');
                    newButton.type = 'button';
                    newButton.id = 'continueRegistrationButton';
                    newButton.style.display = 'block';
                    newButton.style.marginTop = '10px';
                    newButton.innerText = 'Continue registration';
                    newButton.onclick = function() {
                        document.getElementById('usernameSection').style.display = 'none';
                        document.getElementById('passwordSection').style.display = 'flex';
                    };
                    usernameSection.appendChild(newButton);
                }
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username));
}

// document.getElementById('profileUsername').addEventListener('keyup', function() {
//     var username = this.value;
//     var messageElement = document.getElementById('usernameMessage');
//     var continueRegistrationButton = document.getElementById('continueRegistrationButton');
//     var loginButton = document.getElementById('loginButton');

//     if (username.length < 2 || !/^[a-z0-9-]+$/.test(username)) {
//         if (continueRegistrationButton) {
//             continueRegistrationButton.remove();
//         }
//         if (loginButton) {
//             loginButton.remove();
//         }
//         messageElement.innerText = 'Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.';
//         messageElement.style.color = 'var(--text-error-)';
//     } else {
//         checkUsername();
//     }
// });

// document.addEventListener('DOMContentLoaded', function() {
//     var profileUsernameElement = document.getElementById('profileUsername');
//     if (profileUsernameElement) {
//         profileUsernameElement.addEventListener('keyup', function() {
//             var username = this.value;
//             var messageElement = document.getElementById('usernameMessage');
//             var continueRegistrationButton = document.getElementById('continueRegistrationButton');
//             var loginButton = document.getElementById('loginButton');

//             if (username.length < 2 || !/^[a-z0-9-]+$/.test(username)) {
//                 if (continueRegistrationButton) {
//                     continueRegistrationButton.remove();
//                 }
//                 if (loginButton) {
//                     loginButton.remove();
//                 }
//                 messageElement.innerText = 'Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.';
//                 messageElement.style.color = 'var(--text-error-)';
//             } else {
//                 checkUsername();
//             }
//         });
//     } else {
//     }
// });




document.addEventListener('DOMContentLoaded', function() {
    var profileUsernameElement = document.getElementById('profileUsername');
    var debounceTimeout;

    if (profileUsernameElement) {
        profileUsernameElement.addEventListener('keyup', function() {
            var username = this.value;
            var messageElement = document.getElementById('usernameMessage');
            var continueRegistrationButton = document.getElementById('continueRegistrationButton');
            var loginButton = document.getElementById('loginButton');

            if (continueRegistrationButton) {
                continueRegistrationButton.remove();
            }
            if (loginButton) {
                loginButton.remove();
            }

            if (username.length < 2 || !/^[a-z0-9-]+$/.test(username)) {
                messageElement.innerText = 'Username must be at least 2 characters long and contain only lowercase Latin letters, numbers, and hyphens.';
                messageElement.style.color = 'var(--text-error-)';
            } else {
                clearTimeout(debounceTimeout); // Очистка предыдущего таймера
                debounceTimeout = setTimeout(checkUsername, 600); // Задержка перед проверкой
            }
        });
    }
});



function forgotPassword() {
    var username = document.getElementById('profileUsername').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'forgot_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.question) {
                document.getElementById('secretQuestion').innerText = response.question;
                document.getElementById('secretQuestionSection').style.display = 'block';
                document.getElementById('passwordSection').style.display = 'none';
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username));
}

function checkSecretAnswer() {
    var username = document.getElementById('profileUsername').value;
    var secretAnswer = document.getElementById('secretAnswer').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_secret_answer.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.valid) {
                document.getElementById('changePasswordSection').style.display = 'flex';
                document.getElementById('secretQuestionSection').style.display = 'none';
            } else {
                document.getElementById('changePasswordSection').style.display = 'none';
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&secretAnswer=' + encodeURIComponent(secretAnswer));
}

function changePassword() {
    var username = document.getElementById('profileUsername').value;
    var newPassword = document.getElementById('newPassword').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'auth_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                saveMessageToLocalStorage('Password changed successfully!', true);
                window.location.href = '/';
            } else {
                showMessage(response.error, false);
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&newPassword=' + encodeURIComponent(newPassword) + '&action=change_password' + '&timestamp=' + encodeURIComponent(document.querySelector('input[name="timestamp"]').value));
    return false;
}

function changeSecretQuestion() {
    var username = document.getElementById('questionUsername').value;
    var secretQuestion = document.getElementById('secret_question').value;
    var secretAnswer = document.getElementById('secret_answer').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'auth_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                saveMessageToLocalStorage('Secret question and answer changed successfully!', true);
                window.location.href = '/';
            } else {
                showMessage(response.error, false);
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&secret_question=' + encodeURIComponent(secretQuestion) + '&secret_answer=' + encodeURIComponent(secretAnswer) + '&action=change_question' + '&timestamp=' + encodeURIComponent(document.querySelector('input[name="timestamp"]').value));
    return false;
}

function registerUser() {
    var username = document.getElementById('profileUsername').value;
    var password = document.getElementById('password').value;
    var secretQuestion = document.getElementById('secret_question').value;
    var secretAnswer = document.getElementById('secret_answer').value;
    var honeypot = document.getElementById('honeypot').value;
    var timestamp = document.getElementById('timestamp').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'auth_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                saveMessageToLocalStorage('Registration successful!', true);
                window.location.href = '/';
            } else {
                showMessage(response.error, false);
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password) + '&secret_question=' + encodeURIComponent(secretQuestion) + '&secret_answer=' + encodeURIComponent(secretAnswer) + '&honeypot=' + encodeURIComponent(honeypot) + '&timestamp=' + encodeURIComponent(timestamp) + '&action=register');
    return false;
}

function loginUser() {
    var username = document.getElementById('profileUsername').value;
    var password = document.getElementById('password').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'auth_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                saveMessageToLocalStorage('Login successful!', true);
                window.location.href = '/';
            } else {
                showMessage(response.error, false);
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password) + '&action=login' + '&timestamp=' + encodeURIComponent(document.querySelector('input[name="timestamp"]').value));
    return false;
}
