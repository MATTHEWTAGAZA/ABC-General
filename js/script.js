function validateLoginForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username.length < 3) {
        alert('Username must be at least 3 characters long.');
        return false;
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return false;
    }

    return true;
}

function validateRegisterForm() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (username.length < 3) {
        alert('Username must be at least 3 characters long.');
        return false;
    }

    if (!email.includes('@')) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return false;
    }

    return true;
}