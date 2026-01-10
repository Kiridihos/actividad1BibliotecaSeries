<?php
session_start();
require_once(__DIR__ . '/../../controllers/PlatformController.php');
$platformController = new PlatformController();
$entity = $_GET['entity'] ?? null; //Temporary it will be platforms
$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'index':
        $platformController->index();
        break;
    case 'create':
        // go to create platform form
        $platformController->create();
        break;
    case 'edit':
        $platformId = $_GET['id'];
        $platformController->edit($platformId);
        break;
    case 'delete':
        $platformController->delete();
        break;
    case 'store':
        $platformController->store();
        break;
    case 'update':
        $platformController->update();
        break;
    default:
        $platformController->index();
        break;
}
?>