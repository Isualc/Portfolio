<!DOCTYPE html>
<html lang="de" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projekte</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">
    <header class="text-center p-3 border">
        <h1>Meine Projekte</h1>
    </header>
    <?php include 'navbar.php'; ?>
    <main class="container mt-5 border">
        <section id="projects" class="mt-4">
            <h2>Projekte</h2>
            <div class="row">
                <div class="col-md-4 mb-4 bg-dark">
                    <div class="card">
                        <img src="../assets/project-thumbnail1.jpg" class="card-img-top" alt="Projektbild">
                        <div class="card-body bg-dark">
                            <a href="../projekte/RocketGame/index.html" class="btn btn-primary bg-dark border"
                                onclick="openProjectDetails('RocketGame')">Rocket Game</a>
                        </div>
                    </div>
                </div>
        </section>
        <section id="projectDetails" class="mt-4">
            <div class="col-md-4 mb-4 bg-dark">
                <div class="card">
                    <img src="../assets/project-thumbnail2.jpg" class="card-img-top" alt="Projektbild">
                    <div class="card-body bg-dark">
                        <a href="../projekte/RechnerJavaScript/index.php" class="btn btn-primary bg-dark border"
                            onclick="openProjectDetails('RechnerJavaScript')">Taschenrechner</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="projectDetails" class="mt-4">
            <div class="row">
                <div class="col-md-4 mb-4 bg-dark">
                    <div class="card">
                        <img src="../assets/project-thumbnail3.jpg" class="card-img-top" alt="Projektbild">
                        <div class="card-body bg-dark">
                            <a href="../projekte/TicTacToe/index.html" class="btn btn-primary bg-dark border"
                                onclick="openProjectDetails('RechnerJavaScript')">TicTacToe</a>
                        </div>
                    </div>
                </div>
        </section>
        <section id="projects" class="mt-4">
            <div class="row">
                <div class="col-md-4 mb-4 bg-dark">
                    <div class="card">
                        <img src="../assets/project-thumbnail4.jpg" class="card-img-top" alt="Projektbild">
                        <div class="card-body bg-dark">
                            <a href="../projekte/RPG-Onlineshop/index.php" class="btn btn-primary bg-dark border"
                                onclick="openProjectDetails('RPG-Onlineshop')">Griswold's Online Schmiede</a>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="./javaScript/script.js"></script>
</body>

</html>