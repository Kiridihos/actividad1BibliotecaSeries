<?php
require_once(__DIR__ . '/../models/SerieModel.php');
class SerieController
{
    public function index()
    {
        $series = Serie::getAll();
        require_once(__DIR__ . '/../views/series/list-series.php');
    }
    public function create()
    {
        $platforms = Platform::getAll();
        //$directors = Director::getAll();
        //$actors = Actor::getAll();
        $languages = Language::getAll();
        require_once(__DIR__ . '/../views/series/create-series.php');
    }
    public function delete($id)
    {
        $serieToDelete = Serie::getById($id);
        require_once(__DIR__ . '/../views/series/delete-series.php');
    }
    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = trim($_POST['id']);
            $urlBack = 'Location: temporalRouter.php?entity=series';
            if (Serie::deleteById($id)) {
                $_SESSION['success'] = 'Serie eliminada exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha eliminado correctamente';
            }

            header($urlBack);
            exit;
        } else {
            header('Location: temporalRouter.php?entity=series');
            exit;

        }
    }
}
?>