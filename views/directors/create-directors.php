<?php
$pageTitle = 'Directores';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Crear nuevo director</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=directors&action=store">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombres</label>
                                <input type="text" class="form-control mb-3" id="name" name="name" required autofocus
                                    placeholder="Ej: Tom, Emma, Robert">
                                <label for="surname" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control mb-3" id="surname" name="surname"
                                        required autofocus placeholder="Ej: Hanks, Stone, Downey Jr.">
                                    <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control mb-3" id="birth_date" name="birth_date"
                                        required autofocus placeholder="Ej: 1970-07-09">
                                    <label for="nationality" class="form-label">Nacionalidad</label>
                                    <input type="text" class="form-control mb-3" id="nationality" name="nationality"
                                        required autofocus placeholder="Ej: Estadounidense, Británica, Canadiense">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="?entity=directors" class="btn btn-secondary">
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