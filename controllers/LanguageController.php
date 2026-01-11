<?php
require_once(__DIR__ . '/../models/LanguageModel.php');

class LanguageController
{
    public function index()
    {
        $languages = Language::getAll();
        require_once(__DIR__ . '/../views/languages/list-languages.php');
    }
    
}
?>