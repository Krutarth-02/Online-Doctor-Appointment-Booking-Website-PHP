// Get the body element
const body = document.body;

// Get the radio buttons
const light = document.getElementById('light');
const dark = document.getElementById('dark');
const defaultMode = document.getElementById('default');

// Light mode functionality
light.onclick = function() {
    body.style.backgroundColor = 'white';
    body.style.color = 'black';
    localStorage.setItem('mode', 'light'); // Save the mode to localStorage
};

// Dark mode functionality
dark.onclick = function() {
    body.style.backgroundColor = 'black';
    body.style.color = 'white';
    localStorage.setItem('mode', 'dark'); // Save the mode to localStorage
};

// System default functionality
defaultMode.onclick = function() {
    body.style.backgroundColor = '';
    body.style.color = '';
    localStorage.removeItem('mode'); // Remove the mode from localStorage
};

// Check localStorage for saved mode on page load
window.onload = function() {
    const savedMode = localStorage.getItem('mode');
    if (savedMode === 'light') {
        light.checked = true;
        body.style.backgroundColor = 'white';
        body.style.color = 'black';
    } else if (savedMode === 'dark') {
        dark.checked = true;
        body.style.backgroundColor = 'black';
        body.style.color = 'white';
    } else {
        defaultMode.checked = true;
        body.style.backgroundColor = '';
        body.style.color = '';
    }
};