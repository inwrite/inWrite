

window.onload = function() {

    quill.clipboard.dangerouslyPasteHTML(0, '<h1><br></h1><p><br></p><p><br></p>');

    var h1Element = quill.root.querySelector('h1');
    if (h1Element) {
        quill.setSelection(0, 0);
    }

    var observer = new MutationObserver(function(mutations) {
        let elementsRestored = false;

        mutations.forEach(function(mutation) {
            mutation.removedNodes.forEach(function(node) {
                if ((node.tagName === 'H1' || node.tagName === 'P') && !elementsRestored) {
                    if (!quill.root.querySelector('h1') || !quill.root.querySelector('p')) {
                        observer.disconnect();
                        quill.clipboard.dangerouslyPasteHTML(0, '<h1><br></h1><p><br></p>');
                        observer.observe(quill.root, { childList: true, subtree: true });
                        elementsRestored = true;
                    }
                }
            });
        });
    });

    observer.observe(quill.root, {
        childList: true,
        subtree: true
    });
};





quill.on('text-change', function(delta, oldDelta, source) {
    if (source === 'user') {
        if (delta.ops.every(op => op.retain && !op.insert && !op.delete)) {
            return;
        }

        
        var h1Element = quill.root.querySelector('h1');
        var firstPElement = quill.root.querySelector('p');
        var nextPElement = firstPElement ? firstPElement.nextElementSibling : null;

        if (h1Element) {
            var h1HasText = h1Element.innerText.trim() !== '';
            var h1HasPlaceholder = h1Element.classList.contains('h1-presholder');

            if (h1HasText && !h1HasPlaceholder) {
                h1Element.classList.add('h1-presholder');
            } else if (!h1HasText && h1HasPlaceholder) {
                h1Element.classList.remove('h1-presholder');
            }
        }

        if (firstPElement) {
            var pHasText = firstPElement.innerText.trim() !== '';
            var pHasPlaceholder = firstPElement.classList.contains('p-presholder');

            if (pHasText && !pHasPlaceholder) {
                firstPElement.classList.add('p-presholder');
            } else if (!pHasText && pHasPlaceholder) {
                firstPElement.classList.remove('p-presholder');
            }
        }

        if (nextPElement && nextPElement.tagName === 'P') {
            var nextPHasText = nextPElement.innerText.trim() !== '';
            var nextPHasPlaceholder = nextPElement.classList.contains('p-presholder');

            if (nextPHasText && !nextPHasPlaceholder) {
                nextPElement.classList.add('p-presholder');
            } else if (!nextPHasText && nextPHasPlaceholder) {
                nextPElement.classList.remove('p-presholder');
            }
        }
    }
});





quill.on('selection-change', function(range, oldRange, source) {
    
    var h1Element = quill.root.querySelector('h1');
    var firstPElement = quill.root.querySelector('p');
    

    if (range) {
        var [line, offset] = quill.getLine(range.index);
        var lineNode = line.domNode;

        if (source === 'user' && lineNode) {
            
            if (lineNode.tagName.toLowerCase() === 'h1') {
                if (h1Element && !h1Element.classList.contains('focush1')) {
                    h1Element.classList.add('focush1');
                }
                var tooltip = document.querySelector('.ql-tooltip');
                if (tooltip) {
                    tooltip.classList.add('ql-hidden');
                }
            } else {
                if (h1Element && h1Element.classList.contains('focush1')) {
                    h1Element.classList.remove('focush1');
                }
            }

            if (lineNode.tagName.toLowerCase() === 'p' && lineNode === firstPElement) {
                if (firstPElement && !firstPElement.classList.contains('focusp')) {
                    firstPElement.classList.add('focusp');
                }
                var tooltip = document.querySelector('.ql-tooltip');
                if (tooltip) {
                    tooltip.classList.add('ql-hidden');
                }
            } else {
                if (firstPElement && firstPElement.classList.contains('focusp')) {
                    firstPElement.classList.remove('focusp');
                }
            }
            
        } else if (source === 'api') {
        }
    } else {
        
        if (h1Element && h1Element.classList.contains('focush1')) {
            h1Element.classList.remove('focush1');
        }
        if (firstPElement && firstPElement.classList.contains('focusp')) {
            firstPElement.classList.remove('focusp');
        }
        
    }
});

quill.root.addEventListener('keydown', function(event) {
    var h1Element = quill.root.querySelector('h1');
    var firstPElement = quill.root.querySelector('p');
    var range = quill.getSelection();

    if (range) {
        var [line, offset] = quill.getLine(range.index);
        var lineNode = line.domNode;

        if ((lineNode === h1Element || lineNode === firstPElement) && 
            (lineNode.innerText.trim() === '' || lineNode.innerHTML === '<br>')) {
            if (event.key === 'Backspace' || event.key === 'Delete') {
                event.preventDefault();
            }
        }
    }

    if (event.key === 'Enter') {
    } else if (event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'ArrowUp' || event.key === 'ArrowDown') {
    }
}, true);

quill.root.addEventListener('mousedown', function() {
});
