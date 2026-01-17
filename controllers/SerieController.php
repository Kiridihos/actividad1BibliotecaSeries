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
        $directors = Directors::getAll();
        $actors = Actors::getAll();
        $languages = Language::getAll();
        require_once(__DIR__ . '/../views/series/create-series.php');
    }
    public function delete($id)
    {
        $serieToDelete = Serie::getById($id);
        require_once(__DIR__ . '/../views/series/delete-series.php');
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['platform'], $_POST['director'], $_POST['actors'], $_POST['audioLanguages'], $_POST['subtitleLanguages'])) {
            $title = trim($_POST['name']);
            $platform = trim($_POST['platform']);
            $director = trim($_POST['director']);
            $actors = $_POST['actors'];
            $audioLanguages = $_POST['audioLanguages'];
            $subtitleLanguages = $_POST['subtitleLanguages'];

            $urlBack = 'Location: index.php?entity=series&action=create';
            
            if (empty($title)) {
                $this->sendErrorAndRedirect('El nombre de la serie no puede estar vacío.', $urlBack);
            }

            if (Serie::getByTitle($title)) {
                $this->sendErrorAndRedirect('El nombre de la serie ya existe.', $urlBack);
            }

            $serie = new Serie(null, ucfirst($title), $platform, $director, $actors, $audioLanguages, $subtitleLanguages);
            if ($serie->save()) {
                $_SESSION['success'] = 'Serie creada exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha guardado correctamente';
            }
            
            header($urlBack);
            exit;
        } else {

            header('Location: index.php?entity=series');
            exit;

        }
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
    private function sendErrorAndRedirect($message, $urlBack)
    {
        $_SESSION['error'] = $message;
        header($urlBack);
        exit;
    }
}
?>