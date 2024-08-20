quill.on('text-change', function() {
    var selection = quill.getSelection();
    if (selection) {
        var caretBounds = quill.getBounds(selection.index);
        var editorContainer = document.querySelector('#editor-container');

        var footerHeight = 300;

        var caretY = editorContainer.getBoundingClientRect().top + caretBounds.bottom;

        var windowHeight = window.innerHeight;

        if (caretY > windowHeight - footerHeight) {
            var scrollDistance = Math.max(caretY - (windowHeight - footerHeight), 100);
            window.scrollBy(0, scrollDistance);
        }
    } else {
    }
});

