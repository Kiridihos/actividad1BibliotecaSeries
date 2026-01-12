<?php
$pageTitle = 'Idiomas';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Crear nuevo idioma</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=languages&action=store">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre del Idioma</label>
                                <input type="text" class="form-control mb-3" id="name" name="name" required autofocus
                                    placeholder="Ej: Español, Inglés, Francés">
                                <input type="text" class="form-control mb-3" id="iso" name="iso" required autofocus
                                    placeholder="Ej: ESP, ENG, FRA">
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