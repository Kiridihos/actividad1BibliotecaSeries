<?php
require_once(__DIR__ . '/../models/PlatformModel.php');

class PlatformController
{
    //Pages
    public function index()
    {
        $platforms = Platform::getAll();
        require_once(__DIR__ . '/../views/platforms/list-platforms.php');
    }
    public function create()
    {
        require_once(__DIR__ . '/../views/platforms/create-platforms.php');
    }

    public function edit($id)
    {
        $platformToEdit = Platform::getById($id);
        require_once(__DIR__ . '/../views/platforms/edit-platforms.php');
    }
    public function delete($id)
    {
        $platformToDelete = Platform::getById($id);
        require_once(__DIR__ . '/../views/platforms/delete-platforms.php');
    }

    //actions

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
            $name = trim($_POST['name']);
            $urlBack = 'Location: temporalRouter.php?entity=platform&action=create';

            if (empty($name)) {
                $this->sendErrorAndRedirect('El nombre de la plataforma no puede estar vacío.', $urlBack);
            }

            if ($this->validatePlatformName($name)) {
                $this->sendErrorAndRedirect('El nombre de la plataforma ya existe.', $urlBack);
            }


            $platform = new Platform(null, ucfirst($name));
            if ($platform->save()) {
                $_SESSION['success'] = 'Plataforma creada exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha guardado correctamente';
            }

            header($urlBack);
            exit;
        } else {

            header('Location: temporalRouter.php?entity=platforms');
            exit;

        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['name'])) {
            $id = trim($_POST['id']);
            $name = trim($_POST['name']);
            $urlBack = 'Location: temporalRouter.php?entity=platforms&action=edit&id=' . $id;


            if (empty($name)) {
                $this->sendErrorAndRedirect('El nombre de la plataforma no puede estar vacío.', $urlBack);
            }

            if ($this->validatePlatformName($name)) {
                $this->sendErrorAndRedirect('El nombre de la plataforma ya existe.', $urlBack);
            }


            if (Platform::updatePlatform($id, $name)) {
                $_SESSION['success'] = 'Plataforma actualizada exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha actualizado correctamente';
            }

            header($urlBack);
            exit;
        } else {
            header('Location: temporalRouter.php?entity=platforms');
            exit;
        }
    }
    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = trim($_POST['id']);
            $urlBack = 'Location: temporalRouter.php?entity=platforms';
            //TODO: Update related series to set platform_id to null or a default value before deleting the platform
            if (Platform::deleteById($id)) {
                $_SESSION['success'] = 'Plataforma eliminada exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha eliminado correctamente';
            }

            header($urlBack);
            exit;
        } else {
            header('Location: temporalRouter.php?entity=platforms');
            exit;
        }
    }

    private function validatePlatformName($name)
    {
        return Platform::getByName($name) != null;
    }

    private function sendErrorAndRedirect($message, $urlBack)
    {
        $_SESSION['error'] = $message;
        header($urlBack);
        exit;
    }

}
?>