<?php
$pageTitle = 'Plataformas de Streaming';
require_once __DIR__ . '/../../templates/header.php';
?>

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
                                    <a href="?entity=platforms&action=edit&id=<?php echo $platform->getId(); ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <a href="?entity=platforms&action=delete&id=<?php echo $platform->getId(); ?>"
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
<?php
require_once __DIR__ . '/../../templates/footer.php';
?>