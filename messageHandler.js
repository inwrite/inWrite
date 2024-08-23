function showMessage(message, isSuccess) {
    var messageDiv = document.getElementById('messageDiv');
    if (!messageDiv) {
        messageDiv = document.createElement('div');
        messageDiv.id = 'messageDiv';
        messageDiv.style.position = 'fixed';
        messageDiv.style.top = '8px';
        messageDiv.style.right = '8px';
        messageDiv.style.zIndex = '1000';
        document.body.appendChild(messageDiv);
    }

    messageDiv.innerText = message;
    messageDiv.style.color = isSuccess ? 'var(--text-success-)' : 'var(--text-error-)';
    messageDiv.style.backgroundColor = isSuccess ? 'var(--text-success-bg)' : 'var(--text-error-bg)';
    messageDiv.style.display = 'block';

    document.body.classList.add('message');

    setTimeout(function() {
        messageDiv.style.display = 'none';
        document.body.classList.remove('message');
    }, 2000);
}

function saveMessageToLocalStorage(message, isSuccess) {
    localStorage.setItem('message', message);
    localStorage.setItem('messageType', isSuccess ? 'success' : 'error');
}

function displayMessageFromLocalStorage() {
    var message = localStorage.getItem('message');
    var messageType = localStorage.getItem('messageType');

    if (message) {
        showMessage(message, messageType === 'success');
        localStorage.removeItem('message');
        localStorage.removeItem('messageType');
    }
}

document.addEventListener("DOMContentLoaded", function() {
    displayMessageFromLocalStorage();
});
