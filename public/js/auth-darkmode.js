// Dark Mode Toggle for Auth Pages
window.toggleDarkModeAuth = function() {
    const body = document.body;
    const icon = document.getElementById('darkModeIconAuth');

    body.classList.toggle('light-mode');

    if (body.classList.contains('light-mode')) {
        icon.classList.remove('bi-brightness-high');
        icon.classList.add('bi-moon-fill');
        localStorage.setItem('authMode', 'light');
    } else {
        icon.classList.remove('bi-moon-fill');
        icon.classList.add('bi-brightness-high');
        localStorage.setItem('authMode', 'dark');
    }
}

// Load saved preference
document.addEventListener('DOMContentLoaded', function() {
    const savedMode = localStorage.getItem('authMode');
    const body = document.body;
    const icon = document.getElementById('darkModeIconAuth');

    if (savedMode === 'light') {
        body.classList.add('light-mode');
        if (icon) {
            icon.classList.remove('bi-brightness-high');
            icon.classList.add('bi-moon-fill');
        }
    }
});
