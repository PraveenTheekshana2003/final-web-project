const toggle = document.getElementById('darkModeToggle');
const savedColorScheme = localStorage.getItem('color-scheme');

if(savedColorScheme === 'dark') {
    toggle.checked = true;
    document.documentElement.style.colorScheme = 'dark';
}
else 
    document.documentElement.style.colorScheme = 'light';

toggle.addEventListener('change', function() {
    if (this.checked) {
        document.documentElement.style.colorScheme = 'dark';
        localStorage.setItem('color-scheme','dark');
    } else {
        document.documentElement.style.colorScheme = 'light';
        localStorage.setItem('color-scheme','light');
    }
});