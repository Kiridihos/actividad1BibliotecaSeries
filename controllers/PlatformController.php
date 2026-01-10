<?php
require_once(__DIR__ . '/../models/PlatformModel.php');

class PlatformController
{
    public function index()
    {
        $platforms = Platform::getAll();
        require_once(__DIR__ . '/../views/platforms/list-platforms.php');
    }
    public function create()
    {
        require_once(__DIR__ . '/../views/platforms/create-platforms.php');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
            $name = trim($_POST['name']);

            if (empty($name)) {
                $_SESSION['error'] = 'El nombre de la plataforma no puede estar vacío.';
                header('Location: temporalRouter.php?entity=platform&action=create');
                exit;
            }

            if (Platform::getByName($name)) {
                $_SESSION['error'] = 'La plataforma ya existe.';
                header('Location: temporalRouter.php?entity=platform&action=create');
                exit;
            }

            $platform = new Platform(null, ucfirst($name));
            if ($platform->save()) {
                $_SESSION['success'] = 'Plataforma creada exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha guardado correctamente';
            }

            header('Location: temporalRouter.php?entity=platform&action=create');
            exit;
        } else {
            
            header('Location: temporalRouter.php?entity=platforms');
            exit;

        }
    }

}

?>