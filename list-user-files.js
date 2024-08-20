document.addEventListener('DOMContentLoaded', function() {

    const publishButton = document.getElementById('publishbtn');

    function loadHtmlFiles() {
        const fileListDiv = document.querySelector('div.ul-list-file');
        const authUserBox = document.querySelector('div.authuserBox');
        const editorTitleElement = document.querySelector('.ql-editor h1');
        const editorTitle = editorTitleElement ? editorTitleElement.textContent.trim() : '';
        
        fetch('getFiles.php')
            .then(response => response.json())
            .then(data => {
                fileListDiv.innerHTML = '';

                if (data.error) {
                    fileListDiv.textContent = data.error;
                    authUserBox.classList.remove('listBox');
                    return;
                }

                const ulElement = document.createElement('ul');

                if (data.length > 0) {
                    authUserBox.classList.add('listBox');
                } else {
                    authUserBox.classList.remove('listBox');
                }

                data.forEach(file => {
                    const liElement = document.createElement('li');

                    const linkElement = document.createElement('a');
                    linkElement.href = `users/${username}/${file.filename}`;
                    linkElement.textContent = file.title ? file.title : file.filename;

                                        if (file.title === editorTitle) {
                                            liElement.classList.add('highlighted');
                                        }
                                        
                    const buttonContainer = document.createElement('div');
                    buttonContainer.classList.add('button-get');
                    buttonContainer.style.display = 'inline-block';
                    const openButton = document.createElement('button');
                    openButton.textContent = 'Открыть';
                    openButton.style.marginLeft = '10px';
                    openButton.addEventListener('click', function() {
                        window.open(linkElement.href, '_blank');
                    });

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Удалить!!!';
                    deleteButton.style.marginLeft = '10px';
                    // deleteButton.innerHTML = `
                    // <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    //     <path d="M20.5001 6H3.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                    //     <path d="M18.8332 8.5L18.3732 15.3991C18.1962 18.054 18.1077 19.3815 17.2427 20.1907C16.3777 21 15.0473 21 12.3865 21H11.6132C8.95235 21 7.62195 21 6.75694 20.1907C5.89194 19.3815 5.80344 18.054 5.62644 15.3991L5.1665 8.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                    //     <path d="M9.1709 4C9.58273 2.83481 10.694 2 12.0002 2C13.3064 2 14.4177 2.83481 14.8295 4" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                    // </svg>
                    // `;
                    deleteButton.addEventListener('click', function() {
                        deleteFile(file.filename);
                    });

                    buttonContainer.appendChild(openButton);
                    buttonContainer.appendChild(deleteButton);

                    liElement.appendChild(linkElement);
                    liElement.appendChild(buttonContainer);
                    ulElement.appendChild(liElement);
                });

                fileListDiv.appendChild(ulElement);
            })
            .catch(error => {
                console.error('Ошибка при загрузке файлов:', error);
                authUserBox.classList.remove('listBox');
            });
    }

    function deleteFile(filename) {
        fetch('delete_publication.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ filename: filename, username: username })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadHtmlFiles();
            } else {
                console.error('Ошибка при удалении файла:', data.error);
            }
        })
        .catch(error => console.error('Ошибка при удалении файла:', error));
    }

    publishButton.addEventListener('click', function() {
        loadHtmlFiles();
    });

    loadHtmlFiles();
});
