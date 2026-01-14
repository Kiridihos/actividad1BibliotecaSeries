<?php
$pageTitle = 'Editar Director';
require_once __DIR__ . '/../../templates/header.php';
$id;
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header btn-primary">
                        <h2 class="card-title">Editar director</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=directors&action=update">
                            <input type="hidden" name="id" value="<?php echo $directorToEdit->getId(); ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombres</label>
                                <input type="text" class="form-control mb-3" id="name" name="name" required autofocus
                                    placeholder="Ej: Español, Inglés, Francés"
                                    value="<?php echo htmlspecialchars($directorToEdit->getName()); ?>">
                                <label for="surname" class="form-label">Apellidos</label>
                                <input type="text" class="form-control mb-3" id="surname" name="surname" required
                                    autofocus placeholder="Ej: García, López, Martínez"
                                    value="<?php echo htmlspecialchars($directorToEdit->getSurname()); ?>">
                                <label for="birthdate" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control mb-3" id="birthdate" name="birthdate" required
                                    autofocus value="<?php echo htmlspecialchars($directorToEdit->getBirthdate()); ?>">
                                <label for="nationality" class="form-label">Nacionalidad</label>
                                <input type="text" class="form-control mb-3" id="nationality" name="nationality"
                                    placeholder=""
                                    value="<?php echo htmlspecialchars($directorToEdit->getNationality()); ?>">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="?entity=directors" class="btn btn-secondary">
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