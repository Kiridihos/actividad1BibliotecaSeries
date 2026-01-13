<?php
$pageTitle = 'Idiomas';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <a href="?entity=languages&action=create" class="btn btn-success mb-3 "><i class="bi bi-plus-circle"></i> Añadir
            Idioma</a>
        <?php if (!empty($languages)) {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col" class="w-30">Nombre</th>
                        <th scope="col">Código ISO</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($languages as $language) { ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($language->getId()); ?></th>
                            <td><?php echo htmlspecialchars($language->getName()); ?></td>
                            <td><?php echo htmlspecialchars($language->getIsoCode()); ?></td>
                            <td>
                                <a href="?entity=languages&action=edit&id=<?php echo $language->getId(); ?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?entity=languages&action=delete&id=<?php echo $language->getId(); ?>"
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