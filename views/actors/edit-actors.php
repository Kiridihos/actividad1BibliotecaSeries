<?php
$pageTitle = 'Editar Actores';
require_once __DIR__ . '/../../templates/header.php';
$id;
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header btn-primary">
                        <h2 class="card-title">Editar actor</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=actors&action=update">
                            <input type="hidden" name="id" value="<?php echo $actorToEdit->getId(); ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del actor</label>
                                <input type="text" class="form-control mb-3" id="name" name="name" required autofocus
                                    placeholder="Ej: Español, Inglés, Francés"
                                    value="<?php echo htmlspecialchars($actorToEdit->getName()); ?>">
                                <label for="surname" class="form-label">Apellido del actor</label>
                                <input type="text" class="form-control mb-3" id="surname" name="surname" required
                                    autofocus placeholder="Ej: García, López, Martínez"
                                    value="<?php echo htmlspecialchars($actorToEdit->getSurname()); ?>">
                                <label for="birth_date" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control mb-3" id="birth_date" name="birth_date" required
                                    autofocus value="<?php echo htmlspecialchars($actorToEdit->getBirthdate()); ?>">
                                <label for="nationality" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control mb-3" id="nationality" name="nationality"
                                    placeholder=""
                                    value="<?php echo htmlspecialchars($actorToEdit->getNationality()); ?>">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="?entity=actors" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Cancelar
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