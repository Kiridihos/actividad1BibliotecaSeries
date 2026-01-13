<?php
require_once(__DIR__ . '/../config/DBConnection.php');
class Actors
{
    private $id;
    private $name;
    private $surname;
    private $birthdate;
    private $nationality;

    public function __construct($id, $name, $surname, $birthdate, $nationality)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->birthdate = $birthdate;
        $this->nationality = $nationality;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function getNationality()
    {
        return $this->nationality;
    }
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }
    public static function getAll()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = 'SELECT * FROM actores';

        $result = $db->query($query);
        $actors = [];

        foreach ($result as $row) {
            $actor = new Actors($row['id'], $row['nombres'], $row['apellidos'], $row['fecha_nacimiento'], $row['nacionalidad']);
            $actors[] = $actor;
        }
        $dbConn->closeConnection();
        return $actors;
    }
    public static function getById($id)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM actores WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $actor = new Actors($row['id'], $row['nombres'], $row['apellidos'], $row['fecha_nacimiento'], $row['nacionalidad']);
        } else {
            $actor = null;
        }

        $dbConn->closeConnection();
        return $actor;
    }
    public static function getByName($name)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM actores WHERE LOWER(nombres) = LOWER(?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$name]);
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $actor = new Actors($row['id'], $row['nombres'], $row['apellidos'], $row['fecha_nacimiento'], $row['nacionalidad']);
        } else {
            $actor = null;
        }

        $dbConn->closeConnection();
        return $actor;
    }

    // Guarda los actores en la base de datos
    public function save()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        if ($this->id) {
            // Update existing actor
            $query = "UPDATE actores SET nombres = ?, apellidos = ?, fecha_nacimiento = ?, nacionalidad = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->name, $this->surname, $this->birthdate, $this->nationality, $this->id]);
        } else {
            // Insert new actor
            $query = "INSERT INTO actores (nombres, apellidos, fecha_nacimiento, nacionalidad) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->name, $this->surname, $this->birthdate, $this->nationality]);
            $this->id = $db->insert_id;
        }
        $dbConn->closeConnection();
    }
    // Eliminar un actor de la base de datos
    public function delete(){

    }
    // Crear un nuevo actor en la base de datos
    public static function create(){

    }
    // Actualizar un actor existente en la base de datos
    public static function update(){

    }
    // Eliminar un actor por su ID
    public static function deleteById($id){

    }
}
?>