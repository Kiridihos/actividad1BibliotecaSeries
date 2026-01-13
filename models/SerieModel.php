<?php
require_once('DBConnection.php');
require_once('ActuationModel.php');
require_once('SpeakModel.php');
require_once('SubtitleModel.php');
require_once('LanguageModel.php');
require_once('PlatformModel.php');
class Serie
{
    private $id;
    private $title;
    private $platform;
    private $director;
    private $actors;
    private $audioLanguages;
    private $subtitleLanguages;

    public function __construct($id, $title, $platform, $director, $actors, $audioLanguages, $subtitleLanguages)
    {
        $this->id = $id;
        $this->title = $title;
        $this->platform = $platform;
        $this->director = $director;
        $this->actors = $actors;
        $this->audioLanguages = $audioLanguages;
        $this->subtitleLanguages = $subtitleLanguages;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getPlatform()
    {
        return $this->platform;
    }
    public function getDirector()
    {
        return $this->director;
    }
    public function getActors()
    {
        return $this->actors;
    }
    public function getAudioLanguages()
    {
        return $this->audioLanguages;
    }
    public function getSubtitleLanguages()
    {
        return $this->subtitleLanguages;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }
    public function setDirector($director)
    {
        $this->director = $director;
    }
    public function setActors($actors)
    {
        $this->actors = $actors;
    }
    public function setAudioLanguages($audioLanguages)
    {
        $this->audioLanguages = $audioLanguages;
    }
    public function setSubtitleLanguages($subtitleLanguages)
    {
        $this->subtitleLanguages = $subtitleLanguages;
    }
    private static function getResultData($result)
    {
        if ($row = $result->fetch_assoc()) {
            $serieId = $row['id'];
            $actors = self::getActorsNames($serieId);
            $audioLanguages = self::getAudioLanguagesNames($serieId);
            $subtitleLanguages = self::getSubLanguagesNames($serieId);
            $platform = Platform::getById($row['plataforma'])->getName();
            $director = $row['director']; //TODO: get director name
            $serie = new Serie(
                $serieId = $row['id'],
                $row['titulo'],
                $platform,
                $director,
                $actors,
                $audioLanguages,
                $subtitleLanguages
            );
        } else {
            $serie = null;
        }
        return $serie;
    }
    private static function getResultLanguages($results)
    {

        $languageNames = [];
        foreach ($results as $language) {
            $languageId = $language->getLanguageId();
            $languageNames[] = Language::getById($languageId)->getName();
        }
        return $languageNames;
    }
    private static function getResultActors($results)
    {

        $actorNames = [];
        foreach ($results as $actuation) {
            $actorId = $actuation->getActorId();
            //TODO: $actorNames[] = Actor::getById($actorId)->getName();
            $actorNames[] = $actorId; // Placeholder until Actor model is implemented
        }
        return $actorNames;
    }

    private static function getAudioLanguagesNames($serieId)
    {
        $audioLanguages = Speak::getBySerieId($serieId);
        return self::languageArrayToString($audioLanguages);
    }
    private static function getSubLanguagesNames($serieId)
    {
        $subtitleLanguages = Subtitle::getBySerieId($serieId);
        return self::languageArrayToString($subtitleLanguages);
    }
    private static function getActorsNames($serieId)
    {
        $actors = Actuation::getBySerieId($serieId);
        return self::actorArrayToString($actors);
    }

    private static function languageArrayToString($results)
    {
        $languages = Serie::getResultLanguages($results);
        return implode(', ', $languages);
    }
    private static function actorArrayToString($results)
    {
        $actors = Serie::getResultActors($results);
        return implode(', ', $actors);
    }

    public static function getAll()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = 'SELECT * FROM series';

        $result = $db->query($query);
        $series = [];

        foreach ($result as $row) {
            $serieId = $row['id'];
            $actors = self::getActorsNames($serieId);
            $audioLanguages = self::getAudioLanguagesNames($serieId);
            $subtitleLanguages = self::getSubLanguagesNames($serieId);
            $platform = Platform::getById($row['plataforma'])->getName();
            $director = $row['director']; //TODO: get director name
            $serie = new Serie(
                $serieId = $row['id'],
                $row['titulo'],
                $platform,
                $director,
                $actors,
                $audioLanguages,
                $subtitleLanguages
            );
            $series[] = $serie;
        }
        $dbConn->closeConnection();
        return $series;
    }
    public static function getById($id)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM series WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->get_result();
        $serie = self::getResultData($result);
        $dbConn->closeConnection();
        return $serie;
    }
    public static function getByTitle($title)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();

        $query = "SELECT * FROM series WHERE title = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$title]);
        $result = $stmt->get_result();
        $serie = self::getResultData($result);
        $dbConn->closeConnection();
        return $serie;
    }

    public function save()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        if ($this->id) {
            $query = "UPDATE series SET title = ?, platform = ?, director = ?, actors = ?, audio_languages = ?, subtitle_languages = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $result = $stmt->execute([$this->title, $this->platform, $this->director, $this->actors, $this->audioLanguages, $this->subtitleLanguages, $this->id]);

        }
    }

    public function delete()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        if ($this->id == null) {
            return false;
        }
        $query = 'DELETE FROM series WHERE id = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->id]);
        if ($result) {
            $this->id = null;
            $this->title = null;
            $this->platform = null;
            $this->director = null;
            $this->actors = null;
            $this->audioLanguages = null;
            $this->subtitleLanguages = null;
            $this->deleteRelatedData();
        }
        $dbConn->closeConnection();
        return $result;
    }
    private function deleteRelatedData()
    {
        Actuation::deleteBySerieId($this->id);
        Speak::deleteBySerieId($this->id);
        Subtitle::deleteBySerieId($this->id);
    }
    public static function deleteById($id)
    {
        $serie = self::getById($id);
        if ($serie) {
            return $serie->delete();
        }
        return false;
    }

}
?>