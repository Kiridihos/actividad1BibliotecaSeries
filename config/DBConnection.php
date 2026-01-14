<?php

class DBConnection
{
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $db_port;
    private $connection = null;

    public function __construct($host = 'localhost', $user = 'root', $pass = 'root', $name = 'series', $db_port = 3306)
    {
        $this->db_host = $host;
        $this->db_user = $user;
        $this->db_pass = $pass;
        $this->db_name = $name;
        $this->db_port = $db_port;
    }

    public function getConnection()
    {
        if ($this->connection == null) {
            $mysqli = new mysqli(
                $this->db_host,
                $this->db_user,
                $this->db_pass,
                $this->db_name,
                $this->db_port
            );

            if ($mysqli->connect_errno) {
                throw new Exception("Error de conexión: " . $mysqli->connect_error);
            }

            $this->connection = $mysqli;
        }

        return $this->connection;
    }

    public function closeConnection()
    {
        if ($this->connection !== null) {
            $this->connection->close();
            $this->connection = null;
        }
    }
}
?>