<?php
require_once('DBConnection.php');
class Platform
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public static function getAll()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = 'SELECT * FROM plataformas';

        $result = $db->query($query);
        $platforms = [];

        foreach ($result as $row) {
            $platform = new Platform($row['id'], $row['nombre']);
            $platforms[] = $platform;
        }
        $dbConn->closeConnection();
        return $platforms;

    }
    public static function getById($id)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM plataformas WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $platform = new Platform($row['id'], $row['nombre']);
        } else {
            $platform = null;
        }

        $dbConn->closeConnection();
        return $platform;

    }

    public function save()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        if ($this->id == null) {
            // Create new platform
            $query = 'INSERT INTO plataformas (nombre) VALUES (?)';
            $stmt = $db->prepare($query);
            $result = $stmt->execute([$this->id]);

            if ($result) {
                $this->id = $db->insert_id;
                return true;
            }
            return false;
        } else {
            // Update existing platform
            $query = 'UPDATE plataformas SET nombre = ? WHERE id = ?';
            $stmt = $db->prepare($query);
            return $stmt->execute([$this->name, $this->id]);
        }
    }

    public function delete()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        if ($this->id == null) {
            return false;
        }

        $query = 'DELETE FROM plataformas WHERE id = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->id]);

        if ($result) {
            $this->id = null;
            $this->name = null;
        }

        $dbConn->closeConnection();
        return $result;
    }

    public static function createPlatform($name)
    {
        $newPlatform = new Platform(null, $name);
        return $newPlatform->save();
    }

    public static function updatePlatform($id, $name)
    {
        $platform = new Platform($id, $name);
        return $platform->save();
    }

    public static function deleteById($id)
    {
        $platform = self::getById($id);
        if ($platform) {
            return $platform->delete();
        }
        return false;
    }


}
?>