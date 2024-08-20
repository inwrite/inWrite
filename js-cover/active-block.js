function highlightActiveBlock(quill) {
    let lastActiveBlock = null;

    function clearActiveBlock() {
        document.querySelectorAll('.ql-editor .active-block').forEach(block => {
            block.classList.remove('active-block');
        });
        lastActiveBlock = null;
    }

    function setActiveBlock(range) {
        if (range && range.index !== null) {
            const [line, offset] = quill.getLine(range.index);
            const lineNode = line.domNode;

            if (lineNode) {
                lineNode.classList.add('active-block');
                lastActiveBlock = lineNode;
            }
        } else {
        }
    }

    quill.on('selection-change', function(range) {
        clearActiveBlock();
        setActiveBlock(range);
    });

    quill.on('text-change', function(delta, oldDelta, source) {
        if (source === 'user') {

            const range = quill.getSelection();
            clearActiveBlock();
            setActiveBlock(range);
        }
    });

    quill.root.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            clearActiveBlock();
            setTimeout(() => {
                const range = quill.getSelection();
                setActiveBlock(range);
            }, 0);
        }
    });

    setTimeout(() => {
        const h1Element = quill.root.querySelector('h1');
        if (h1Element) {
            h1Element.classList.add('active-block');
            lastActiveBlock = h1Element;
        }
    }, 0);
}

(function addActiveBlockStyles() {
    const style = document.createElement('style');
    style.innerHTML = `
        .ql-editor .active-block {
           color: var(--color-text);
        }
    `;
    document.head.appendChild(style);
})();

window.addEventListener('load', function() {
    highlightActiveBlock(quill);
});
