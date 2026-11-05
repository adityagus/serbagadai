// Theme management script
(function() {
    // Check local storage or system preference
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    // Default to dark mode if no preference is saved
    const isDark = savedTheme === null ? true : savedTheme === 'dark';
    
    if (!isDark) {
        document.documentElement.classList.add('light-mode');
    }
})();

document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (!themeToggleBtn) return;
    
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    
    // Set initial icon states
    function updateIcons() {
        const isLight = document.documentElement.classList.contains('light-mode');
        if (isLight) {
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        } else {
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        }
    }
    
    updateIcons();
    
    // Click event handler
    themeToggleBtn.addEventListener('click', () => {
        const isLight = document.documentElement.classList.toggle('light-mode');
        localStorage.setItem('theme', isLight ? 'light' : 'dark');
        updateIcons();
    });

    // Mobile Hamburger Menu Toggle
    const menuToggleBtn = document.getElementById('menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    if (menuToggleBtn && navLinks) {
        menuToggleBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
});
