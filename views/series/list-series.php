<?php
$pageTitle = 'Series';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <a href="?entity=series&action=create" class="btn btn-success mb-3 "><i class="bi bi-plus-circle"></i> Añadir
            Serie</a>
        <?php if (!empty($series)) {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Título</th>
                        <th scope="col">Plataforma</th>
                        <th scope="col">Director</th>
                        <th scope="col">Actores</th>
                        <th scope="col">Idiomas audio</th>
                        <th scope="col">Idiomas subtítulos</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($series as $serie) { ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($serie->getId()); ?></th>
                            <td><?php echo htmlspecialchars($serie->getTitle()); ?></td>
                            <td><?php echo htmlspecialchars($serie->getPlatform()->getName()); ?></td>
                            <td><?php echo htmlspecialchars($serie->getDirector()->getName())." ".htmlspecialchars($serie->getDirector()->getSurname()); ?></td>
                            <td><?php echo ($serie->getActorsNames()); ?></td>
                            <td><?php echo ($serie->getAudioLanguageNames()); ?></td>
                            <td><?php echo ($serie->getSutitleLanguageNames()); ?></td>
                            <td>
                                <a href="?entity=series&action=edit&id=<?php echo htmlspecialchars($serie->getId()); ?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?entity=series&action=delete&id=<?php echo htmlspecialchars($serie->getId()); ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <div class="alert alert-warning" role="alert">Aun no existen series</div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<?php
require_once __DIR__ . '/../../templates/footer.php';
?>