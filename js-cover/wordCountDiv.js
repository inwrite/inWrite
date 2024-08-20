document.addEventListener('DOMContentLoaded', () => {
    const wordCountDiv = document.createElement('div');
    wordCountDiv.id = 'wordCount';

    const publishBar = document.querySelector('footer .wordCountDiv');
    
    if (publishBar) {
        publishBar.appendChild(wordCountDiv);
    } else {
        return;
    }

    if (typeof quill === 'undefined') {
        return;
    }

    const updateWordCount = () => {
        const h1 = document.querySelector('.ql-editor h1');
        let textContent = quill.getText().trim();

        if (h1) {
            const p = h1.nextElementSibling;
            if (p && p.tagName === 'P') {
                const pText = p.innerText.trim();
                textContent = textContent.replace(pText, '').trim();
            }
        }

        const wordCount = textContent.split(/\s+/).filter(word => word.length > 0).length;
        const readingTimeInMinutes = wordCount / 120;

        const minutes = Math.floor(readingTimeInMinutes);
        const seconds = Math.floor((readingTimeInMinutes - minutes) * 60);

        let readingTimeText = '';
        if (minutes > 0) {
            readingTimeText += `${minutes}m `;
        }
        readingTimeText += `${seconds}sec`;

        const wordLabel = wordCount === 1 ? 'word' : 'words';

        wordCountDiv.innerHTML = `${wordCount} ${wordLabel} <span>|</span> Reading ${readingTimeText}`;
    };

    quill.on('text-change', updateWordCount);

    updateWordCount();
});
