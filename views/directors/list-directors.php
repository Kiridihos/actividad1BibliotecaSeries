<?php
$pageTitle = 'Directores';
require_once __DIR__ . '/../../templates/header.php';
?>

<section class="container centered-content">
    <div class="container">
        <a href="?entity=directors&action=create" class="btn btn-success mb-3 "><i class="bi bi-plus-circle"></i> Añadir
            director</a>
        <?php if (!empty($directors)) {
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
                    <?php foreach ($directors as $director): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($director->getId()); ?></th>
                            <td><?php echo htmlspecialchars($director->getName()); ?></td>
                            <td><?php echo htmlspecialchars($director->getSurname()); ?></td>
                            <td><?php echo htmlspecialchars($director->getBirthdate()); ?></td>
                            <td><?php echo htmlspecialchars($director->getNationality()); ?></td>
                            <td>
                                <a href="?entity=directors&action=edit&id=<?php echo $director->getId(); ?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?entity=directors&action=delete&id=<?php echo $director->getId(); ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <div class="alert alert-warning" role="alert">Aun no existen directores</div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once __DIR__ . '/../../templates/footer.php';
?>