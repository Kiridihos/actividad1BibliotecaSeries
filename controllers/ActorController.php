<?php
require_once(__DIR__ . '/../models/ActorsModel.php');

class ActorController
{
    public function index()
    {
        $actors = Actors::getAll();
        require_once(__DIR__ . '/../views/actors/list-actors.php');
    }
    public function create()
    {
        require_once(__DIR__ . '/../views/actors/create-actors.php');
    }
    public function edit($id)
    {
        $actorToEdit = Actors::getById($id);
        require_once(__DIR__ . '/../views/actors/edit-actors.php');
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['surname'], $_POST['birth_date'], $_POST['nationality'])) {
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $birth_date = trim($_POST['birth_date']);
            $nationality = trim($_POST['nationality']);
            // Condicion de validación de los campos
            if (empty($name) || empty($surname) || empty($birth_date) || empty($nationality)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: index.php?entity=actors&action=create');
                exit;
            }

            $actor = new Actors(null, ucfirst($name), ucfirst($surname), $birth_date, ucfirst($nationality));
            if ($actor->save()) {
                $_SESSION['success'] = 'Actor creado exitosamente';
                header('Location: index.php?entity=actors');
                exit;
            } else {
                $_SESSION['error'] = 'No se ha guardado correctamente';
                header('Location: index.php?entity=actors&action=create');
                exit;
            }
        } else {
            header('Location: index.php?entity=actors');
            exit;
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['birth_date'], $_POST['nationality'])) {
            $id = trim($_POST['id']);
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $birth_date = trim($_POST['birth_date']);
            $nationality = trim($_POST['nationality']);
            // Condicion de validación de los campos
            if (empty($name) || empty($surname) || empty($birth_date) || empty($nationality)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: index.php?entity=actors&action=edit&id=' . $id);
                exit;
            }
            $actorToEdit = Actors::getById($id);
            if ($actorToEdit != null) {
                $actorToEdit->setName(ucfirst($name));
                $actorToEdit->setSurname(ucfirst($surname));
                $actorToEdit->setBirthdate($birth_date);
                $actorToEdit->setNationality(ucfirst($nationality));
                if ($actorToEdit->save()) {
                    $_SESSION['success'] = 'Actor actualizado exitosamente';
                    header('Location: index.php?entity=actors');
                    exit;
                } else {
                    $_SESSION['error'] = 'No se ha actualizado correctamente';
                    header('Location: index.php?entity=actors&action=edit&id=' . $id);
                    exit;
                }
            } else {
                $_SESSION['error'] = 'Actor no encontrado.';
                header('Location: index.php?entity=actors');
                exit;
            }
        } else {
            header('Location: index.php?entity=actors');
            exit;
        }
    }
    public function delete($id)
    {
        if (!isset($_GET['id'])) {
            header('Location: index.php?entity=actors');
            exit;
        }
        $id = (int) $_GET['id'];
        $actorToDelete = Actors::getById($id);

        if (!$actorToDelete) {
            $_SESSION['error'] = 'Actor no encontrado.';
            header('Location: index.php?entity=actors');
            exit;
        }

        require_once(__DIR__ . '/../views/actors/delete-actors.php');
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = trim($_POST['id']);
            $actor = Actors::getById($id);
            if ($actor && $actor->delete()) {
                $_SESSION['success'] = 'Actor eliminado exitosamente';
                header('Location: index.php?entity=actors');
                exit;
            } else {
                $_SESSION['error'] = 'No se ha eliminado correctamente';
                header('Location: index.php?entity=actors');
                exit;
            }
        } else {
            header('Location: index.php?entity=actors');
            exit;
        }
    }
}