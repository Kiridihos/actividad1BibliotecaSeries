<?php
$pageTitle = 'Editar Plataformas de Streaming';
require_once __DIR__ . '/../../templates/header.php';
$id;
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header btn-primary">
                        <h2 class="card-title">Editar plataforma</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?entity=platforms&action=update">
                            <input type="hidden" name="id" value="<?php echo $platformToEdit->getId(); ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Plataforma</label>
                                <input type="text" class="form-control" id="name" name="name" required autofocus
                                    placeholder="Ej: Netflix, HBO, Disney+" value="<?php echo htmlspecialchars($platformToEdit->getName()); ?>">
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