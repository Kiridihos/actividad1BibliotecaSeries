<?php

// Iniciar session para mensajes flash
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Obtener la entidad y accion solicitadas
$entity = $_GET['entity'] ?? null;
$action = $_GET['action'] ?? 'index';

// Si no hay entidad, redirigir al index principal
if (!$entity) {
    require_once(__DIR__ . '/views/home.php');
    exit();
}

// Enrutar segun la entidad
switch ($entity) {
    case 'platforms':
        require_once(__DIR__ . '/controllers/PlatformController.php');
        $contoller = new PlatformController();

        // Enrutar segun la accion
        switch ($action) {
            case 'index':
                $contoller->index();
                break;
            case 'create':
                $contoller->create();
                break;
            case 'store':
                $contoller->store();
                break;
            case 'edit':
                $id = $_GET['id'];
                $contoller->edit($id);
                break;
            case 'update':
                $contoller->update();
                break;
            case 'delete':
                $id = $_GET['id'];
                $contoller->delete($id);
                break;
            case 'destroy':
                $contoller->destroy();
                break;
            default:
                $contoller->index();
                break;
        }
        break;
    case 'languages':
        // Similar routing logic for languages can be added here
        break;
    case 'actors':
        require_once(__DIR__ . '/controllers/ActorController.php');
        $contoller = new ActorController();
        // Enrutar segun la accion
        switch ($action) {
            case 'index':
                $contoller->index();
                break;
            case 'create':
                $contoller->create();
                break;
            case 'store':
                $contoller->store();
                break;
            case 'edit':
                $id = $_GET['id'];
                $contoller->edit($id);
                break;
            case 'update':
                $contoller->update();
                break;
            case 'delete':
                $id = $_GET['id'];
                $contoller->delete($id);
                break;
            case 'destroy':
                $contoller->destroy();
                break;
            default:
                $contoller->index();
                break;
        }
        break;

    case 'directors':
        // Similar routing logic for directors can be added here
        break;
    case 'series':
        // Similar routing logic for series can be added here
        break;

    default:
        header('Location: index.php');
        exit();
}


