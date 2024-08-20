document.addEventListener("DOMContentLoaded", function() {
    const fileListDiv = document.querySelector(".ul-list-file");
    const authUserBox = document.querySelector("div.authuserBox");
    const publishButton = document.getElementById("publishbtn");

    if (!fileListDiv) {
        console.log("User is not authorized or file list not found.");
        return;
    }

    function loadHtmlFiles() {
        const editorTitleElement = document.querySelector('.ql-editor h1');
        const editorTitle = editorTitleElement ? editorTitleElement.textContent.trim() : ''; 

        fetch('getFiles.php')
            .then(response => response.json())
            .then(data => {
                fileListDiv.innerHTML = ''; 

                if (data.error) {
                    fileListDiv.textContent = data.error;
                    if (authUserBox) authUserBox.classList.remove('listBox');
                    return;
                }

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
                    deleteButton.textContent = 'Удалить111';
                    deleteButton.style.marginLeft = '10px';
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

    publishButton.addEventListener('click', function() {
        loadHtmlFiles();
    });

    loadHtmlFiles();
});
