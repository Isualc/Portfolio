document.addEventListener("DOMContentLoaded", function() {
    var navbarToggler = document.querySelector('.navbar-toggler');
    var navbarCollapse = document.querySelector('.navbar-collapse');
    // var switchColorBtn = document.querySelector('.switch-color-btn');

    // Toggle Navbar
    navbarToggler.addEventListener('click', function() {
        navbarCollapse.classList.toggle('show');
    });

//     console.log("Switch Color Button:", switchColorBtn);

//     // Switch Color Theme
//    function switchColor() {
//     console.log("Switch Color aufgerufen"); // Überprüfen, ob die Funktion aufgerufen wird
//     document.body.classList.toggle('light-theme');
//     document.body.classList.toggle('dark-theme');
// }

// if (switchColorBtn) {
//     switchColorBtn.addEventListener('click', switchColor);
// } else {
//     console.log("Switch Color Button nicht gefunden");
// }
});

function openProjectDetails(projectFolder) {
   if (button === 'RocketGame') {
       window.location.href = 'projekte/RocketGame/index.html';
   } else if (button === 'RechnerJavaScript') {
       window.location.href = 'projekte/RechnerJavaScript/index.php';
   } else if (button === 'TicTacToe') {
         window.location.href = 'projekte/TicTacToe/index.html';
   }
}
