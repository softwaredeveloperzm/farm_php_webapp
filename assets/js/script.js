// JavaScript to determine the active page and change button color
document.addEventListener('DOMContentLoaded', function () {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    var buttons = document.querySelectorAll('.navbar-nav a');
    buttons.forEach(function (button) {
        if (button.getAttribute('href') == page) {
            button.classList.remove('btn-primary');
            button.classList.add('btn-secondary'); // Change to a different color (e.g., secondary)
        }
    });
});
