<?php
require_once(__DIR__ . '/../models/LanguageModel.php');

class LanguageController
{
    public function index()
    {
        $languages = Language::getAll();
        require_once(__DIR__ . '/../views/languages/list-languages.php');
    }
    public function create()
    {
        require_once(__DIR__ . '/../views/languages/create-language.php');
    }

    //actions
    public function store()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['iso'])) {
            $name = trim($_POST['name']);
            $iso = trim($_POST['iso']);
            $urlBack = 'Location: temporalRouter.php?entity=languages&action=create';

            if (empty($name) || empty($iso)) {
                $this->sendErrorAndRedirect('El nombre y el código ISO del idioma no pueden estar vacíos.', $urlBack);
            }

            if ($this->validateLanguageName($name)) {
                $this->sendErrorAndRedirect('El nombre del idioma ya existe.', $urlBack);
            }
            if ($this->validateLanguageISO($iso)) {
                $this->sendErrorAndRedirect('El código ISO del idioma ya existe.', $urlBack);
            }

            $language = new Language(null, ucfirst($name), strtoupper($iso));
            if ($language->save()) {
                $_SESSION['success'] = 'Idioma creado exitosamente';
            } else {
                $_SESSION['error'] = 'No se ha guardado correctamente';
            }

            header($urlBack);
            exit;
        } else {

            header('Location: temporalRouter.php?entity=languages');
            exit;

        }
    }

    private function validateLanguageName($name)
    {
        return Language::getByName($name) != null;
    }
        private function validateLanguageISO($iso)
    {
        return Language::getByIsoCode($iso) != null;
    }

    private function sendErrorAndRedirect($message, $urlBack)
    {
        $_SESSION['error'] = $message;
        header($urlBack);
        exit;
    }
}
?>