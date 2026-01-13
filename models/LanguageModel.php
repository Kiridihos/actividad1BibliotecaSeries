<?php
require_once('DBConnection.php');

class Language
{
    private $id;
    private $name;
    private $isoCode;
    public function __construct($id, $name, $isoCode)
    {
        $this->id = $id;
        $this->name = $name;
        $this->isoCode = $isoCode;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getIsoCode()
    {
        return $this->isoCode;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
    }

    public static function getAll()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = 'SELECT * FROM idiomas';

        $result = $db->query($query);
        $languages = [];

        foreach ($result as $row) {
            $language = new Language($row['id'], $row['nombre'], $row['iso_code']);
            $languages[] = $language;
        }
        $dbConn->closeConnection();
        return $languages;

    }

    public static function getById($id)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM idiomas WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $language = self::getResultData($result);
        $stmt->close();
        $dbConn->closeConnection();
        return $language;
    }
    public static function getByName($name)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM idiomas WHERE LOWER(nombre) = LOWER(?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$name]);
        $result = $stmt->get_result();
        $language = self::getResultData($result);
        $stmt->close();
        $dbConn->closeConnection();
        return $language;
    }
    public static function getByIsoCode($isoCode)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM idiomas WHERE LOWER(iso_code) = LOWER(?)";
        $stmt = $db->prepare($query);
        $stmt->execute([$isoCode]);
        $result = $stmt->get_result();
        $language = self::getResultData($result);
        $dbConn->closeConnection();
        return $language;
    }
    public function save()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        if ($this->id) {
            $query = "UPDATE idiomas SET nombre = ?, iso_code = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $result = $stmt->execute([$this->name, $this->isoCode, $this->id]);
            $dbConn->closeConnection();
            return $result;
        } else {
            $query = "INSERT INTO idiomas (nombre, iso_code) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            $result = $stmt->execute([$this->name, $this->isoCode]);
            if ($result) {
                $this->id = $db->insert_id;
                $dbConn->closeConnection();
                return true;
            }
            $dbConn->closeConnection();
            return false;
        }
    }

    public function delete()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        if ($this->id == null) {
            return false;
        }
        $query = 'DELETE FROM idiomas WHERE id = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->id]);
        if ($result) {
            $this->id = null;
            $this->name = null;
            $this->isoCode = null;
        }
        $dbConn->closeConnection();
        return $result;
    }

    public static function createLanguage($name, $isoCode)
    {
        $newLanguage = new Language(null, $name, strtoupper($isoCode));
        return $newLanguage->save();
    }

    public static function updateLanguage($id, $name, $isoCode)
    {
        $language = new Language($id, $name, $isoCode);
        return $language->save();
    }
    public static function deleteById($id)
    {
        $language = self::getById($id);
        if ($language) {
            return $language->delete();
        }
        return false;
    }

    private static function getResultData($result)
    {
        if ($row = $result->fetch_assoc()) {
            $language = new Language($row['id'], $row['nombre'], $row['iso_code']);
        } else {
            $language = null;
        }
        return $language;
    }
}
?>