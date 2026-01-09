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

    public function getAll()
    {
        $dbConn = new DBConnection(
            'localhost',
            'root',
            'root',
            'series',
            8889,
        );
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
}
?>