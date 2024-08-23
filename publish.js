document.addEventListener("DOMContentLoaded", function() {
    const fileListDiv = document.querySelector(".ul-list-file");
    const authUserBox = document.querySelector("div.authuserBox");
    const publishButton = document.getElementById("publishbtn");

    let existingFileName = null;

    const honeypot = document.createElement('input');
    honeypot.type = 'text';
    honeypot.name = 'website';
    honeypot.style.display = 'none';

    const editor = document.getElementById('editor');
    const qlEditor = document.querySelector('.ql-editor');

    if (editor) {
        editor.appendChild(honeypot);
    } else {
        console.error('Element with ID "editor" not found.');
    }

    const startTime = new Date().getTime();

    function updatePublishButtonState() {
        const titleElement = document.querySelector('#editor .ql-editor h1');
        const titleText = titleElement ? titleElement.textContent.trim() : '';
        publishButton.disabled = titleText.length < 2;
    }

    const observeTitleChanges = () => {
        const titleElement = document.querySelector('#editor .ql-editor h1');
        if (titleElement) {
            const observer = new MutationObserver(updatePublishButtonState);
            observer.observe(titleElement, { characterData: true, subtree: true, childList: true });
            updatePublishButtonState();
        }
    };

    const editorObserver = new MutationObserver((mutationsList, observer) => {
        if (mutationsList.some(mutation => mutation.addedNodes.length > 0)) {
            observeTitleChanges();
        }
    });

    if (qlEditor) {
        editorObserver.observe(qlEditor, { childList: true, subtree: true });
    }

    function loadHtmlFiles() {
        const editorTitleElement = document.querySelector('.ql-editor h1');
        const editorTitle = editorTitleElement ? editorTitleElement.textContent.trim() : '';

        fetch('getFiles.php')
            .then(response => response.json())
            .then(data => {
                fileListDiv.innerHTML = '';

                const ulElement = document.createElement('ul');

                if (data.length > 0 && authUserBox) {
                    authUserBox.classList.add('listBox');
                } else if (authUserBox) {
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

                    const settingsButton = document.createElement('button');
                    settingsButton.textContent = 'Опции редактирования поста';
                    settingsButton.classList.add('settingPost');
                    settingsButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon-md">
                            <path fill="currentColor" fill-rule="evenodd" d="M3 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0m7 0a2 2 0 1 1 4 0 2 2 0 0 1-4 0m7 0a2 2 0 1 1 4 0 2 2 0 0 1-4 0" clip-rule="evenodd"></path>
                        </svg>
                    `;

                    const buttonContainer = document.createElement('div');
                    buttonContainer.classList.add('button-get');

                    const openButton = document.createElement('button');
                    openButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="h-5 w-5 shrink-0"><path fill="currentColor" fill-rule="evenodd" d="M15 5a1 1 0 1 1 0-2h5a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0V6.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L17.586 5zM4 7a3 3 0 0 1 3-3h3a1 1 0 1 1 0 2H7a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-3a1 1 0 1 1 2 0v3a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3z" clip-rule="evenodd"></path></svg>
                        <span>Open in new window</span>
                    `;
                    openButton.addEventListener('click', function() {
                        window.open(linkElement.href, '_blank');
                    });

                    const copyButton = document.createElement('button');
                    copyButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="h-5 w-5 shrink-0"><path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path></svg>
                        <span>Copy link</span>
                    `;
                    copyButton.addEventListener('click', function() {
                        navigator.clipboard.writeText(linkElement.href)
                            .then(() => {
                                showMessage('Link copied!', true);
                            })
                            .catch(err => {
                                console.error('Copy error:', err);
                                showMessage('Failed to copy link.', false);
                            });
                    });

                    const deleteButton = document.createElement('button');
                    deleteButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="h-5 w-5 shrink-0"><path fill="currentColor" fill-rule="evenodd" d="M10.556 4a1 1 0 0 0-.97.751l-.292 1.14h5.421l-.293-1.14A1 1 0 0 0 13.453 4zm6.224 1.892-.421-1.639A3 3 0 0 0 13.453 2h-2.897A3 3 0 0 0 7.65 4.253l-.421 1.639H4a1 1 0 1 0 0 2h.1l1.215 11.425A3 3 0 0 0 8.3 22H15.7a3 3 0 0 0 2.984-2.683l1.214-11.425H20a1 1 0 1 0 0-2zm1.108 2H6.112l1.192 11.214A1 1 0 0 0 8.3 20H15.7a1 1 0 0 0 .995-.894zM10 10a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0v-5a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0v-5a1 1 0 0 1 1-1" clip-rule="evenodd"></path></svg>
                        <span>Delete</span>
                    `;
                    deleteButton.addEventListener('click', function() {
                        deleteFile(file.filename);
                    });

                    buttonContainer.appendChild(openButton);
                    buttonContainer.appendChild(copyButton);
                    buttonContainer.appendChild(deleteButton);

                    liElement.appendChild(linkElement);
                    liElement.appendChild(settingsButton);
                    liElement.appendChild(buttonContainer);
                    ulElement.appendChild(liElement);
                });

                fileListDiv.appendChild(ulElement);
            })
            .catch(error => {
                console.error('Error loading files:', error);
                if (authUserBox) authUserBox.classList.remove('listBox');
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
                console.error('Error when deleting a file:', data.error);
            }
        })
        .catch(error => console.error('Error when deleting a file:', error));
    }

    fileListDiv.addEventListener("click", function(event) {
        const link = event.target.closest("a");
        if (link) {
            event.preventDefault();

            const url = link.getAttribute("href");
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Server returned ${response.status} - ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(htmlContent => {
                    console.log("Loaded HTML content:", htmlContent);

                    const tempDiv = document.createElement("div");
                    tempDiv.innerHTML = htmlContent;

                    const mainContent = tempDiv.querySelector("main");
                    if (mainContent) {
                        const contentToInsert = Array.from(mainContent.childNodes)
                            .map(node => node.outerHTML || node.textContent)
                            .join("");
                        console.log("Content to be inserted into Quill:", contentToInsert);

                        const quillEditor = document.querySelector("#editor .ql-editor");
                        if (quillEditor) {
                            quillEditor.innerHTML = contentToInsert;

                            activateButtons(url);

                            const observer = new MutationObserver(() => {
                                console.log("Checking content in Quill:");
                                const paragraphs = quillEditor.querySelectorAll("p");

                                console.log("Content in Quill after insertion:", quillEditor.innerHTML);

                                paragraphs.forEach((paragraph, index) => {
                                    console.log(`Paragraph ${index + 1}:`, paragraph.outerHTML);

                                    if (paragraph.innerHTML.trim() === "") {
                                        console.log(`Removing empty paragraph: ${paragraph.outerHTML}`);
                                        paragraph.remove();
                                    }
                                });

                                observer.disconnect();

                                console.log("Final content in Quill after cleanup:", quillEditor.innerHTML);

                                fileListDiv.innerHTML = '';
                                
                                loadHtmlFiles();
                            });

                            observer.observe(quillEditor, { childList: true, subtree: true });

                        } else {
                            console.error("Quill editor root element not found.");
                        }
                    } else {
                        console.error("Main content not found in the loaded HTML.");
                    }
                })
                .catch(error => {
                    console.error("Error loading post:", error);
                });
        }
    });

    publishButton.addEventListener('click', async function() {
        if (publishButton.textContent === 'Edit publication') {
            document.body.classList.remove('publisOk');
            publishButton.textContent = 'Save publication';
            toggleEditorState(true);
            return;
        }

        const titleElement = document.querySelector('#editor .ql-editor h1');
        const firstParagraph = document.querySelector('#editor .ql-editor p');

        if (!titleElement || !firstParagraph) {
            console.error("Required elements not found.");
            return;
        }

        const currentDate = new Date().toLocaleDateString('en-US', {
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        const datePattern = /\s*•?\s*\b\w+\s\d{1,2},\s\d{4}\s\d{2}:\d{2}:\d{2}\s(?:AM|PM)\b/g;

        firstParagraph.innerHTML = firstParagraph.innerHTML.replace(datePattern, '').trim();
        firstParagraph.innerHTML = `<br> • ${currentDate}`;

        const updatedContent = document.querySelector('#editor .ql-editor').innerHTML.trim();

        const formData = new FormData();
        formData.append('title', titleElement.innerText.trim());
        formData.append('content', updatedContent);

        const isFirstSave = !existingFileName;

        if (existingFileName) {
            formData.append('filename', existingFileName);
        }

        formData.append('website', honeypot.value);
        formData.append('start_time', startTime);


        showLoadingIndicator(true);

        try {
            const response = await fetch('save_publication.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(errorText);
            }

            const result = await response.json();

            const listUserFilesDiv = document.querySelector('.list-user-files ul');

            if (listUserFilesDiv) {
                let existingListItem = listUserFilesDiv.querySelector(`a[href*="${result.filename}"]`);

                if (existingListItem) {
                    existingListItem.parentElement.innerHTML = result.html;
                } else {
                    listUserFilesDiv.insertAdjacentHTML('beforeend', result.html);
                }
            }


            if (isFirstSave) {
                existingFileName = result.filename;
            
                let publicationLink;
                if (!document.body.classList.contains('authuser')) {
                    publicationLink = `${window.location.origin}/incognito-publications/${result.filename}`;
                } else {
                    publicationLink = `${window.location.origin}/users/${username}/${result.filename}`;
                }
            
                createCopyLinkButton(publicationLink);
            
                document.body.classList.add('publishFirst');
            }

        showLoadingIndicator(false);

            showMessage(`Publication ${isFirstSave ? 'completed' : 'updated'}!`, true);
            publishButton.textContent = 'Edit publication';
            document.body.classList.add('publisOk');
            toggleEditorState(false);
            loadHtmlFiles();

        } catch (error) {
            showLoadingIndicator(false);
            console.error('Error saving publication:', error);
            showMessage(error.message, false);
        }
    });

    function toggleEditorState(isEditable) {
        const qlEditor = document.querySelector('.ql-editor');
        qlEditor.setAttribute('contenteditable', isEditable ? 'true' : 'false');
    }

    function activateButtons(url) {
        existingFileName = url.split('/').pop();
        publishButton.disabled = false;
        publishButton.textContent = 'Edit publication';

        const publicationLink = `${window.location.origin}/users/${username}/${existingFileName}`;
        createCopyLinkButton(publicationLink);
    }

    function createCopyLinkButton(link) {
        let copyBtn = document.querySelector('.btnCopy');
        if (!copyBtn) {
            copyBtn = document.createElement('button');
            copyBtn.className = 'btnCopy';
            copyBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="h-5 w-5 shrink-0"><path fill="currentColor" fill-rule="evenodd" d="M7 5a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-2v2a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h2zm2 2h5a3 3 0 0 1 3 3v5h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-9a1 1 0 0 0-1 1zM5 9a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1v-9a1 1 0 0 0-1-1z" clip-rule="evenodd"></path></svg>
                Copy link
            `;

            publishButton.parentNode.insertBefore(copyBtn, publishButton.nextSibling);
        }

        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(link)
                .then(() => {
                    showMessage('Link copied!', true);
                })
                .catch(err => {
                    console.error('Copy error:', err);
                    showMessage('Failed to copy link.', false);
                });
        });
    }

    loadHtmlFiles();
});





document.addEventListener('DOMContentLoaded', function() {
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            const button = document.querySelector('#publishbtn');
            
            if (button && button.textContent.trim() === 'Edit publication') {
                document.body.classList.add('publisOk');
                
                const editorDiv = document.querySelector('.ql-editor');
                if (editorDiv) {
                    editorDiv.setAttribute('contenteditable', 'false');
                }

                observer.disconnect(); // Остановить наблюдение после выполнения условия
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});



function showLoadingIndicator(isLoading) {
    let loadingIndicator = document.querySelector('.loading-indicator');
    
    if (!loadingIndicator) {
        loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'loading-indicator';
        loadingIndicator.innerHTML = `<span>Saving...</span>`;
        document.body.appendChild(loadingIndicator);
    }

    loadingIndicator.style.display = isLoading ? 'flex' : 'none';
}
