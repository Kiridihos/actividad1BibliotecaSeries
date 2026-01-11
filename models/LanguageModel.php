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
        $query = "SELECT * FROM idiomas WHERE id = ?";
        $stmt = self::requestQuery($query, [$id]);
        $result = $stmt->get_result();
        $language = self::getResultData($result);
        return $language;
    }
    public static function getByName($name)
    {
        $query = "SELECT * FROM idiomas WHERE LOWER(nombre) = LOWER(?)";
        $stmt = self::requestQuery($query, [$name]);
        $result = $stmt->get_result();
        $language = self::getResultData($result);
        return $language;
    }
    public static function getByIsoCode($isoCode)
    {
        $query = "SELECT * FROM idiomas WHERE LOWER(iso_code) = LOWER(?)";
        $stmt = self::requestQuery($query, [$isoCode]);
        $result = $stmt->get_result();
        $language = self::getResultData($result);
        return $language;
    }
    public function save()
    {
        if ($this->id) {
            $query = "UPDATE idiomas SET nombre = ?, iso_code = ? WHERE id = ?";
            $result = self::requestQuery($query, [$this->name, $this->isoCode, $this->id]);
            return $result;
        } else {
            $query = "INSERT INTO idiomas (nombre, iso_code) VALUES (?, ?)";
            $result = self::requestQuery($query, [$this->name, $this->isoCode]);
            if ($result) {
                $this->id = $result->insert_id;
                return true;
            }
            return false;
        }
    }

    public function delete()
    {
        if ($this->id == null) {
            return false;
        }
        $query = 'DELETE FROM plataformas WHERE id = ?';
        $result = self::requestQuery($query, [$this->id]);
        if ($result) {
            $this->id = null;
            $this->name = null;
            $this->isoCode = null;
        }
        return $result;
    }

    public static function createLanguage($name, $isoCode)
    {
        $newLanguage = new Language(null, $name, $isoCode);
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
    private static function requestQuery($query, $params)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}
?>