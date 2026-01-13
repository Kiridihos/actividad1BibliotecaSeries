<?php
session_start();
require_once(__DIR__ . '/../../controllers/SerieController.php');
$serieController = new SerieController();
$entity = $_GET['entity'] ?? null; //Temporary it will be platforms
$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'index':
        $serieController->index();
        break;
    case 'create':
        // go to create platform form
        $serieController->create();
        break;
    case 'edit':
        
        $platformId = $_GET['id'];
        $serieController->edit($platformId);
        break;
    case 'delete':
        $platformId = $_GET['id'];
        $serieController->delete($platformId);
        break;
    case 'store':
        $serieController->store();
        break;
    case 'update':
        $serieController->update();
        break;
    case 'destroy':
        $serieController->destroy();
        break;
    default:
        $serieController->index();
        break;
}
?>