<?php
require_once(__DIR__ . '/../config/DBConnection.php');
class Speak
{
    private $serieId;
    private $languageId;
    public function __construct($serieId, $languageId)
    {
        $this->serieId = $serieId;
        $this->languageId = $languageId;
    }
    public function getSerieId()
    {
        return $this->serieId;
    }
    public function getLanguageId()
    {
        return $this->languageId;
    }
    public function setSerieId($serieId)
    {
        $this->serieId = $serieId;
    }
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    }

    public static function getBySerieId($serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM hablada WHERE id_serie = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$serieId]);
        $result = $stmt->get_result();
        $speaks = [];
        foreach ($result as $row) {
            $speak = new Speak($row['id_serie'], $row['id_idioma']);
            $speaks[] = $speak;
        }
        $dbConn->closeConnection();
        return $speaks;
    }
    public static function getByLanguageId($languageId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM hablada WHERE id_idioma = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$languageId]);
        $result = $stmt->get_result();
        $speaks = [];
        foreach ($result as $row) {
            $speak = new Speak($row['id_serie'], $row['id_idioma']);
            $speaks[] = $speak;
        }
        $dbConn->closeConnection();
        return $speaks;
    }
    public function delete()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM hablada WHERE id_serie = ? AND id_idioma = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->serieId, $this->languageId]);
        if ($result) {
            $this->serieId = null;
            $this->languageId = null;
        }

        $dbConn->closeConnection();
        return $result;
    }
    public static function createSpeak($serieId, $languageId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'INSERT INTO hablada (id_serie, id_idioma) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$serieId, $languageId]);
        $dbConn->closeConnection();
        return $result;
    }

    public static function deleteBySerieId($serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM hablada WHERE id_serie = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$serieId]);
        $dbConn->closeConnection();
        return $result;
    }
    public static function deleteByLanguageId($languageId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM hablada WHERE id_idioma = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$languageId]);
        $dbConn->closeConnection();
        return $result;
    }
    public function equals($other)
    {
        if ($other instanceof self) {
            return $this->languageId == $other->languageId && $this->serieId == $other->serieId;
        }
        return false;
    }
}
?>