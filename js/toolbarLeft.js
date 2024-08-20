
quill.on('editor-change', function(eventName, ...args) {
    if (eventName === 'selection-change') {
        var range = args[0];
        var toolbarLeft = document.getElementById('toolbarFloating');

        if (!toolbarLeft) {
            console.error('Element with ID "toolbarFloating" not found.');
            return;
        }

        if (range) {
            var [line, offset] = quill.getLine(range.index);
            var lineNode = line.domNode;

            var isInH1 = lineNode.tagName.toLowerCase() === 'h1';
            var isFirstPAfterH1 = (
                lineNode.tagName.toLowerCase() === 'p' && 
                lineNode.previousElementSibling && 
                lineNode.previousElementSibling.tagName.toLowerCase() === 'h1'
            );

            if (lineNode.innerHTML === '<br>' && !isInH1 && !isFirstPAfterH1) {
                var editorRect = document.getElementById('editor').getBoundingClientRect();
                var lineRect = lineNode.getBoundingClientRect();

                toolbarLeft.style.top = (lineRect.top - editorRect.top + document.getElementById('editor').scrollTop) + 'px';
                toolbarLeft.style.left = '0px';

                toolbarLeft.style.opacity = '1';
            } else {
                toolbarLeft.style.opacity = '0';
            }
        } else {
            toolbarLeft.style.opacity = '0';
        }
    }
});

