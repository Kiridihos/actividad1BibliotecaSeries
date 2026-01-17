<?php
require_once(__DIR__ . '/../config/DBConnection.php');
class Directors
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

        $query = 'SELECT * FROM directores';

        $result = $db->query($query);
        $directors = [];

        foreach ($result as $row) {
            $director = new Directors($row['id'], $row['nombres'], $row['apellidos'], $row['fecha_nacimiento'], $row['nacionalidad']);
            $directors[] = $director;
        }
        $dbConn->closeConnection();
        return $directors;
    }
    public static function getById($id)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM directores WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $director = new Directors($row['id'], $row['nombres'], $row['apellidos'], $row['fecha_nacimiento'], $row['nacionalidad']);
        } else {
            $director = null;
        }

        $dbConn->closeConnection();
        return $director;
    }

    public static function getByName($name)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM directores WHERE LOWER(nombres) = LOWER(?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$name]);
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $director = new Directors($row['id'], $row['nombres'], $row['apellidos'], $row['fecha_nacimiento'], $row['nacionalidad']);
        } else {
            $director = null;
        }

        $dbConn->closeConnection();
        return $director;
    }
    public function save()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        if($this->id == null){
            $query = "INSERT INTO directores (nombres, apellidos, fecha_nacimiento, nacionalidad) VALUES (?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->name, $this->surname, $this->birthdate, $this->nationality]);
            
            if($stmt){
                $this->id = $db->insert_id;
                return true;
            }
            return false;
        } else {
            // Actualizar director existente
            $query = "UPDATE directores SET nombres = ?, apellidos = ?, fecha_nacimiento = ?, nacionalidad = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->name, $this->surname, $this->birthdate, $this->nationality, $this->id]);
            return $stmt->affected_rows > 0;

        }
        $dbConn->closeConnection();
    }
    public function delete(){
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        if ($this->id == null) {
            return false; // No se puede eliminar un director sin ID
        }
        $query = "DELETE FROM directores WHERE id = ?";
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->id]);
    
        if ($result) {
            $this->id = null; //limpiar el ID del objeto después de eliminarlo
            $this->name = null;
            $this->surname = null;
            $this->birthdate = null;
            $this->nationality = null;
        }
        $dbConn->closeConnection();
        return $stmt->affected_rows > 0;
    }
    public static function create($name, $surname, $birthdate, $nationality){
        $director = new Directors(null, $name, $surname, $birthdate, $nationality);
        return $director->save();
    }
    public static function update($name, $surname, $birthdate, $nationality){
        $director = new Directors(null, $name, $surname, $birthdate, $nationality);
        return $director->save();
    }
    public static function deleteById($id){
        $director = self::getById($id);
        if ($director != null) {
            return $director->delete();
        }
        return false; 
    }
    public function equals($other)
    {
        if ($other instanceof self) {
            return $this->id == $other->id;
        }
        return false;
    }
}