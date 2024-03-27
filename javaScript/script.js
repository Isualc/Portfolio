document.addEventListener("DOMContentLoaded", function() {
    var navbarToggler = document.querySelector('.navbar-toggler');
    var navbarCollapse = document.querySelector('.navbar-collapse');

    // Toggle Navbar
    navbarToggler.addEventListener('click', function() {
        navbarCollapse.classList.toggle('show');
    });
});

function openProjectDetails() {
   if (button === 'RocketGame') {
       window.location.href = 'projekte/RocketGame/index.html';
   } else if (button === 'RechnerJavaScript') {
       window.location.href = 'projekte/RechnerJavaScript/index.php';
   } else if (button === 'TicTacToe') {
         window.location.href = 'projekte/TicTacToe/index.html';
   } else if (button === 'RPG-Onlineshop') {
         window.location.href = 'projekte/RPG-Onlineshop/index.php';
   } else if (button === 'SnakeGame') {
         window.location.href = 'https://github.com/Isualc/Java-Projects/tree/main/SnakeGame';
   }
}
