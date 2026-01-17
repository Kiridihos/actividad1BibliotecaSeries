<?php
$pageTitle = 'Series';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Editar Serie</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=series&action=update">
                            <input type="hidden" name="id" value="<?php echo $serieToEdit->getId(); ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Serie</label>
                                <input type="text" class="form-control mb-3" id="name" name="name" required autofocus
                                    placeholder="Ej: Breaking Bad, La Casa de Papel"
                                    value="<?php echo htmlspecialchars($serieToEdit->getTitle()); ?>">
                                <label for="platform" class="form-label">Plataforma</label>
                                <select class="form-select" required name="platform">
                                    <?php foreach ($platforms as $platform) { ?>
                                        <option value="<?php echo htmlspecialchars($platform->getId()); ?>"
                                        <?php echo $platform->getId() == $serieToEdit->getPlatform()->getId() ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($platform->getName()); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="director" class="form-label">Director</label>
                                <select class="form-select" required name="director">
                                    <?php foreach ($directors as $director) { ?>
                                        <option value="<?php echo htmlspecialchars($director->getId()); ?>"
                                        <?php echo $director->getId() == $serieToEdit->getDirector()->getId() ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($director->getName()); ?></option>
                                    <?php } ?>
                                </select>
                                <label for="actors" class="form-label">Actores</label>
                                <select class="form-select" required name="actors[]" multiple>
                                    <?php foreach ($actors as $actor) { ?>
                                        <option value="<?php echo htmlspecialchars($actor->getId()); ?>" 
                                            <?php echo in_array($actor->getId(), $serieActorsId) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($actor->getName()); ?></option>
                                    <?php } ?>
                                </select>
                                <label for="audioLanguages" class="form-label">Idiomas de Audio</label>
                                <select class="form-select" required name="audioLanguages[]" multiple>
                                    <?php foreach ($languages as $language) { ?>
                                        <option value="<?php echo htmlspecialchars($language->getId()); ?>"
                                        <?php echo in_array($language->getId(), $audioLanguagesId) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($language->getName()); ?></option>
                                    <?php } ?>
                                </select>
                                <label for="subtitleLanguages" class="form-label">Idiomas de Subtitulado</label>
                                <select class="form-select" required name="subtitleLanguages[]" multiple>
                                    <?php foreach ($languages as $language) { ?>
                                        <option value="<?php echo htmlspecialchars($language->getId()); ?>"
                                        <?php echo in_array($language->getId(), $subtitleLanguagesId) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($language->getName()); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="?entity=languages" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Volver
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Guardar
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php
require_once __DIR__ . '/../../templates/footer.php';
?>