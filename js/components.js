document.addEventListener('DOMContentLoaded', function () {
    // Load Navbar
    fetch('navbar.html')
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            document.getElementById('navbar-placeholder').innerHTML = data;

            // Initialize site functionality (Navbar, Mobile Menu, Scroll Spy)
            // We call the global function defined in main.js
            if (typeof window.initializeSite === 'function') {
                window.initializeSite();
            }
        })
        .catch(error => {
            console.error('Error loading navbar:', error);
            // Helpful warning for local file access
            if (window.location.protocol === 'file:') {
                console.warn('NOTE: Fetch API does not work with file:// protocol. Please use a local server (http://localhost).');
            }
        });

    // Load Footer
    fetch('footer.html')
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(data => {
            document.getElementById('footer-placeholder').innerHTML = data;
        })
        .catch(error => console.error('Error loading footer:', error));
});
