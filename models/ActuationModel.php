<?php
require_once(__DIR__ . '/../config/DBConnection.php');
class Actuation
{
    private $actorId;
    private $serieId;
    public function __construct($actorId, $serieId)
    {
        $this->actorId = $actorId;
        $this->serieId = $serieId;

    }

    public function getActorId()
    {
        return $this->actorId;
    }
    public function getSerieId()
    {
        return $this->serieId;
    }
    public function setActorId($actorId)
    {
        $this->actorId = $actorId;
    }
    public function setSerieId($serieId)
    {
        $this->serieId = $serieId;
    }

    public function equals($other)
    {
        if ($other instanceof self) {
            return $this->actorId == $other->actorId && $this->serieId == $other->serieId;
        }
        return false;
    }

        public static function getBySerieId($serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM actuan WHERE id_serie = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$serieId]);
        $result = $stmt->get_result();
        $actuations = [];
        foreach ($result as $row) {
            $actuation = new Actuation($row['id_actor'], $row['id_serie']);
            $actuations[] = $actuation;
        }
        $dbConn->closeConnection();
        return $actuations;
    }
    public static function getByActorId($actorId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM actuan WHERE id_actor = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$actorId]);
        $result = $stmt->get_result();
        $actuations = [];
        foreach ($result as $row) {
            $actuation = new Actuation($row['id_actor'], $row['id_serie']);
            $actuations[] = $actuation;
        }
        $dbConn->closeConnection();
        return $actuations;
    }
    public static function createActuation($actorId, $serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'INSERT INTO actuan (id_actor, id_serie) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$actorId, $serieId]);
        $dbConn->closeConnection();
        return $result;
    }

    public function delete()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM actuan WHERE id_actor = ? AND id_serie = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->actorId, $this->serieId]);
        if($result){
            $this->actorId = null;
            $this->serieId = null;
        }
        $dbConn->closeConnection();
        return $result;
    }
    public static function deleteBySerieId($serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM actuan WHERE id_serie = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$serieId]);
        $dbConn->closeConnection();
        return $result;
    }
    public static function deleteByActorId($actorId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM actuan WHERE id_actor = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$actorId]);
        $dbConn->closeConnection();
        return $result;
    }

}
?>