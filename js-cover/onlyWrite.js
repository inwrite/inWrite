document.addEventListener('DOMContentLoaded', () => {
    const editor = document.querySelector('.ql-editor');
    
    if (!editor) {
        console.error('Element with class "ql-editor" not found.');
        return;
    }

    editor.addEventListener('focusin', () => {
        document.body.classList.add('onlyWrite');
    });

    editor.addEventListener('focusout', () => {
        document.body.classList.remove('onlyWrite');
    });

    editor.addEventListener('mousedown', () => {
        document.body.classList.add('onlyWrite');
    });

    document.addEventListener('mousedown', (event) => {
        if (!editor.contains(event.target)) {
            document.body.classList.remove('onlyWrite');
        }
    });
});


document.addEventListener('mousemove', function(event) {
    const myBlock = document.querySelector('#editor');
    const isHoveringOverMyBlock = myBlock.contains(event.target);

    document.body.classList.toggle('hover-onlyWrite', !isHoveringOverMyBlock);
});

