<?php
session_start();
require_once(__DIR__ . '/../../controllers/LanguageController.php');
$languageController = new LanguageController();
$entity = $_GET['entity'] ?? null; //Temporary it will be platforms
$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'index':
        $languageController->index();
        break;
    case 'create':
        // go to create platform form
        $languageController->create();
        break;
    case 'edit':
        $platformId = $_GET['id'];
        $languageController->edit($platformId);
        break;
    case 'delete':
        $platformId = $_GET['id'];
        $languageController->delete($platformId);
        break;
    case 'store':
        $languageController->store();
        break;
    case 'update':
        $languageController->update();
        break;
    case 'destroy':
        $languageController->destroy();
        break;
    default:
        $languageController->index();
        break;
}
?>