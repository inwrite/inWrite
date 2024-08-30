





    <footer>
    <div class="wordCountDiv"></div>
    <!-- <div class="made">Made by <a href="https://www.netwebdev.com/" target="_blank">Mikhail</a></div> -->
    </footer>





    <script src="js/quill.js?v=<?php echo $version; ?>"></script>
        <!-- <script src="js/quill-resize-module.js?v=<?php echo $version; ?>"></script> -->
        <script src="js/quill.blot-formatter.min.js?v=<?php echo $version; ?>"></script>


        <script src="js/quill-focus.js?v=<?php echo $version; ?>"></script>
        <script src="js/quill.imageCompressor.min.js?v=<?php echo $version; ?>"></script>
        <script src="js/quill.image-drop.min.js?v=<?php echo $version; ?>"></script>


        <script src="js/quill.magic-url.js?v=<?php echo $version; ?>"></script>
        <!-- <script src="js/quill.autoformat.js?v=<?php echo $version; ?>"></script> -->



        <script src="js/quill.table-ui.js?v=<?php echo $version; ?>"></script>


        
        <script src="js/config.js?v=<?php echo $version; ?>"></script>


        <script src="js/addToolbarButton.js?v=<?php echo $version; ?>"></script>
        <script src="js/quill.table.js?v=<?php echo $version; ?>"></script>



        <script src="js/h1.js?v=<?php echo $version; ?>"></script>
        <script src="js/toolbarLeft.js?v=<?php echo $version; ?>"></script>






        <script>
            const username = "<?php echo htmlspecialchars($username); ?>";
        </script>




        <script src="js-cover/scroll.js?v=<?php echo $version; ?>"></script>
        <!-- <script src="js-cover/active-block.js?v=<?php echo $version; ?>"></script> -->
        <script src="js-cover/wordCountDiv.js?v=<?php echo $version; ?>"></script>
        <script src="js-cover/onlyWrite.js?v=<?php echo $version; ?>"></script>





        <script src="messageHandler.js?v=<?php echo $version; ?>"></script>
        <script src="publish.js?v=<?php echo $version; ?>"></script>
        


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


            const newPostButton = document.querySelector('.new-post');
            newPostButton.addEventListener('click', function() {
                window.location.href = '/';
            });




            const goLoginPage = document.querySelector('.goLoginPage');
            if (goLoginPage) {
                goLoginPage.addEventListener('click', function() {
                    window.location.href = '/auth.php';
                });
            } else {

            }


            const goUserProfile = document.querySelector('.goUserProfile');
            if (goUserProfile) {
                goUserProfile.addEventListener('click', function() {
                    window.location.href = '/user_profile.php';
                });
            } else {
            }


            const buttonOpenSidebar = document.querySelector('.bottom-open-sidebar');
            buttonOpenSidebar.addEventListener('click', function(event) {
                event.stopPropagation();
                document.body.classList.toggle('open-sidebar');
            });

            document.addEventListener('click', function(event) {
                const body = document.body;
                const authUserBox = document.querySelector('.authuserBox');

                if (body.classList.contains('open-sidebar')) {
                    if (!authUserBox.contains(event.target)) {
                        body.classList.remove('open-sidebar');
                    }
                }
            });


            document.addEventListener('DOMContentLoaded', function() {
                const observer = new MutationObserver(function() {
                    document.querySelectorAll('.settingPost:not([data-listener-added])').forEach(function(button) {
                        button.addEventListener('click', function(event) {
                            event.stopPropagation();

                            document.querySelectorAll('.settingPost.active').forEach(function(activeButton) {
                                if (activeButton !== button) {
                                    activeButton.classList.remove('active');
                                }
                            });

                            button.classList.toggle('active');
                        });
                        button.dataset.listenerAdded = 'true';
                    });
                });

                const targetNode = document.querySelector('.ul-list-file');
                if (targetNode) {
                    observer.observe(targetNode, {
                        childList: true,
                        subtree: true
                    });
                }

                document.addEventListener('click', function() {
                    document.querySelectorAll('.settingPost.active').forEach(function(button) {
                        button.classList.remove('active');
                    });
                });
            });


            document.addEventListener('DOMContentLoaded', function() {
                const editorElement = document.getElementById('editor');

                if (editorElement) {
                    editorElement.addEventListener('click', function() {
                        const bodyElement = document.querySelector('body.publisOk');

                        if (bodyElement) {
                            bodyElement.classList.add('editNo');

                            setTimeout(function() {
                                bodyElement.classList.remove('editNo');
                            }, 500);
                        }
                    });
                }
            });










// document.addEventListener('DOMContentLoaded', function() {
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


// // Функция для применения сохраненной темы
// function applySavedTheme() {
//     const savedTheme = localStorage.getItem('theme');
//     if (savedTheme === 'dark') {
//         document.documentElement.classList.add('dark-theme');
//         document.documentElement.classList.remove('light-theme');
//     } else if (savedTheme === 'light') {
//         document.documentElement.classList.add('light-theme');
//         document.documentElement.classList.remove('dark-theme');
//     } else {
//         // Удаляем классы, если сохраненной темы нет
//         document.documentElement.classList.remove('light-theme', 'dark-theme');
//     }
// }

// // Применение темы при загрузке страницы
// window.addEventListener('load', function() {
//     applySavedTheme();
// });

// // Переключение темы по нажатию кнопки
// document.getElementById('themeToggle').addEventListener('click', function() {
//     const htmlElement = document.documentElement;

//     if (htmlElement.classList.contains('light-theme')) {
//         htmlElement.classList.remove('light-theme');
//         htmlElement.classList.add('dark-theme');
//         localStorage.setItem('theme', 'dark');
//     } else {
//         htmlElement.classList.remove('dark-theme');
//         htmlElement.classList.add('light-theme');
//         localStorage.setItem('theme', 'light');
//     }
// });








        </script>


</body>

</html>