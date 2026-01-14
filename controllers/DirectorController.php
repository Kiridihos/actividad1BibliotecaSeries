<?php
require_once(__DIR__ . '/../models/DirectorsModel.php');

class DirectorController
{
    public function index()
    {
        $directors = Directors::getAll();
        require_once(__DIR__ . '/../views/directors/list-directors.php');
    }
    public function create()
    {
        require_once(__DIR__ . '/../views/directors/create-directors.php');
    }
    public function edit($id)
    {
        $directorToEdit = Directors::getById($id);
        require_once(__DIR__ . '/../views/directors/edit-directors.php');
    }
    public function store()
    {
        if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'], $_POST['surname'], $_POST['birthdate'], $_POST['nationality']) ) {
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $birthdate = trim($_POST['birthdate']);
            $nationality = trim($_POST['nationality']);
            // Condicion de validación de los campos
            if (empty($name) || empty($surname) || empty($birthdate) || empty($nationality)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: index.php?entity=directors&action=create');
                exit;
            }

            $director = new Directors(null, ucfirst($name), ucfirst($surname), $birthdate, ucfirst($nationality));
            if ($director->save()) {
                $_SESSION['success'] = 'Director creado exitosamente';
                header('Location: index.php?entity=directors');
                exit;
            } else {
                $_SESSION['error'] = 'No se ha guardado correctamente';
                header('Location: index.php?entity=directors&action=create');
                exit;
            }
        } else {
            header('Location: index.php?entity=directors');
            exit;
        }
    }
    public function update()
    {
        if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['birthdate'], $_POST['nationality']) ) {
            $id = trim($_POST['id']);
            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $birthdate = trim($_POST['birthdate']);
            $nationality = trim($_POST['nationality']);
            // Condicion de validación de los campos
            if (empty($name) || empty($surname) || empty($birthdate) || empty($nationality)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: index.php?entity=directors&action=edit&id=' . $id);
                exit;
            }
            $directorToEdit = Directors::getById($id);
            if ($directorToEdit != null) {
                $directorToEdit->setName(ucfirst($name));
                $directorToEdit->setSurname(ucfirst($surname));
                $directorToEdit->setBirthdate($birthdate);
                $directorToEdit->setNationality(ucfirst($nationality));
                if ($directorToEdit->save()) {
                    $_SESSION['success'] = 'Director actualizado exitosamente';
                    header('Location: index.php?entity=directors');
                    exit;
                } else {
                    $_SESSION['error'] = 'No se ha actualizado correctamente';
                    header('Location: index.php?entity=directors&action=edit&id=' . $id);
                    exit;
                }
            } else {
                $_SESSION['error'] = 'Director no encontrado.';
                header('Location: index.php?entity=directors');
                exit;
            }
        } else {
            header('Location: index.php?entity=directors');
            exit;
        }
    }
    public function delete($id)
    {
        if(!isset($_GET['id'])) {
            header('Location: index.php?entity=directors');
            exit;
        }
        $id = (int)$_GET['id'];
        $directorToDelete = Directors::getById($id);
        if (!$directorToDelete) {
            $_SESSION['error'] = 'Director no encontrado.';
            header('Location: index.php?entity=directors');
            exit;
        }

        require_once(__DIR__ . '/../views/directors/delete-directors.php');
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $id = trim($_POST['id']);
            $director = Directors::getById($id);
            if ($director && $director->delete()) {
                $_SESSION['success'] = 'Director eliminado exitosamente';
                header('Location: index.php?entity=directors');
                exit;
            } else {
                $_SESSION['error'] = 'No se ha eliminado correctamente';
                header('Location: index.php?entity=directors');
                exit;
            }
        } else {
            header('Location: index.php?entity=directors');
            exit;
        }
    }
}