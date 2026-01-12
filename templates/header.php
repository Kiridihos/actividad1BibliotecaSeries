<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de series | <?php echo isset($pageTitle) ? $pageTitle : ''; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/views/styles/styles.css">
    <link rel="shortcut icon" href="/views/imgs/video-folder.png" type="image/x-icon">
</head>

<body>

    <section class="container centered-content">
        <nav class="navbar navbar-expand-lg navbar-light align-items-center mb-4">
            <a class="navbar-brand" href="../../index.html">
                <img src="../imgs/video-folder.png" alt="Logo" width="30" height="30" class="d-inline-block align-top">
                Biblioteca de series</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav mx-auto">
                    <a class="nav-item nav-link" href="../series/list-series.html">Series</a>
                    <a class="nav-item nav-link" href="../actors/list-actors.html">Actores</a>
                    <a class="nav-item nav-link" href="../directors/list-directors.html">Directores</a>
                    <a class="nav-item nav-link" href="../platforms/list-platforms.php">Plataformas</a>
                    <a class="nav-item nav-link" href="../languages/list-languages.php">Idiomas</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <h1 class="text-center my-4"><?php echo isset($pageTitle) ? $pageTitle : 'Biblioteca de series'; ?></h1>
    </section>