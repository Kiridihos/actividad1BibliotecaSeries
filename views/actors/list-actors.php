<?php
$pageTitle = 'Actores';
require_once __DIR__ . '/../../templates/header.php';
?>

<section class="container centered-content">
    <div class="container">
        <a href="?entity=actors&action=create" class="btn btn-success mb-3 "><i class="bi bi-plus-circle"></i> Añadir
            actor</a>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); ?>
        <?php if (!empty($actors)) {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col" class="w-50">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Nacionalidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actors as $actor): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($actor->getId()); ?></th>
                            <td><?php echo htmlspecialchars($actor->getName()); ?></td>
                            <td><?php echo htmlspecialchars($actor->getSurname()); ?></td>
                            <td><?php echo htmlspecialchars($actor->getBirthdate()); ?></td>
                            <td><?php echo htmlspecialchars($actor->getNationality()); ?></td>
                            <td>
                                <a href="?entity=actors&action=edit&id=<?php echo $actor->getId(); ?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?entity=actors&action=delete&id=<?php echo $actor->getId(); ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <div class="alert alert-warning" role="alert">Aun no existen actores</div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>