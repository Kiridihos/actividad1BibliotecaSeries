<?php
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

    public function getAll()
    {
        $mysqli = initConnectionDb();
        $query = $mysqli->query("SELECT * FROM actores");
        $listData = [];

        foreach ($query as $row) {
            $actor = new Actors(
                $row['id'],
                $row['name'],
                $row['surname'],
                $row['birthdate'],
                $row['nationality'],
            );
            $listData[] = $actor;
        }

        return $listData;
    }
}
?>