<?php
$pageTitle = 'Directores';
require_once __DIR__ . '/../../templates/header.php';
?>
<section class="container centered-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h2 class="card-title">Confirmar Eliminación</h2>
                    </div>
                    <div class="card-body">
                        <p class="lead">¿Estás seguro de que deseas eliminar este director?</p>
                        <div class="alert alert-warning">
                            <strong>Director:</strong>
                            <?php echo htmlspecialchars($directorToDelete->getName() . ' ' . $directorToDelete->getSurname()); ?>
                        </div>
                        <p class="text-muted">Esta acción no se puede deshacer.</p>
                        <form method="POST" action="?entity=directors&action=destroy">
                            <input type="hidden" name="id"
                                value="<?php echo htmlspecialchars($directorToDelete->getId()); ?>">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="?entity=directors" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-trash"></i> Sí, Eliminar
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