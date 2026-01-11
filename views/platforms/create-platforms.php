<?php
$pageTitle = 'Plataformas de Streaming';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Crear nueva plataforma</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=platforms&action=store">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Plataforma</label>
                                <input type="text" class="form-control" id="name" name="name" required autofocus
                                    placeholder="Ej: Netflix, HBO, Disney+">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="?entity=platforms" class="btn btn-secondary">
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