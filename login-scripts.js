document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('login-form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const errorMessage = document.getElementById('error-message');

    // Simulasi kredensial yang benar
    const correctUsername = 'Linda Leo';
    const correctPassword = '26';

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (username === correctUsername && password === correctPassword) {
            localStorage.setItem('loggedIn', 'true');
            window.location.href = 'index.html'; // Arahkan ke halaman daftar peserta
        } else {
            errorMessage.style.display = 'block';
        }
    });
});
