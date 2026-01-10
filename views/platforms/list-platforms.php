<?php
require_once(__DIR__ . '/../../controllers/PlatformController.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de series | Plataformas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="shortcut icon" href="../imgs/video-folder.png" type="image/x-icon">
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
                    <a class="nav-item nav-link" href="../languages/list-languages.html">Idiomas</a>
                </div>
            </div>
        </nav>
        <h1 class="text-center my-4">Plataformas de Streaming</h1>
    </section>
    <section class="container centered-content">
        <div class="container">
            <a href="?entity=platforms&action=create" class="btn btn-success mb-3 "><i
                    class="bi bi-plus-circle"></i> Añadir Plataforma</a>
            <?php if (!empty($platforms)) {
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col" class="w-50">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($platforms as $platform) { ?>
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($platform->getId()); ?></th>
                                <td><?php echo htmlspecialchars($platform->getName()); ?></td>
                                <td>
                                    <a href="index.php?entity=platforms&action=edit&id=<?php echo $platform->getId(); ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <a href="index.php?entity=platforms&action=delete&id=<?php echo $platform->getId(); ?>"
                                        class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="alert alert-warning" role="alert">Aun no existen plataformas</div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>