document.addEventListener('DOMContentLoaded', () => {
    if (!localStorage.getItem('loggedIn')) {
        window.location.href = 'login.html'; // Arahkan ke halaman login jika belum login
    }
});

function logout() {
    localStorage.removeItem('loggedIn');
    window.location.href = 'login.html'; // Arahkan ke halaman login setelah logout
}
