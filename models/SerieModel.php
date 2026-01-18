<?php
require_once(__DIR__ . '/../config/DBConnection.php');
require_once('ActuationModel.php');
require_once('SpeakModel.php');
require_once('SubtitleModel.php');
require_once('LanguageModel.php');
require_once('PlatformModel.php');
require_once('ActorsModel.php');
require_once('DirectorsModel.php');
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
    /**
     * @return Serie|null
     */
    private static function getResultData($result)
    {
        if ($row = $result->fetch_assoc()) {
            $serie = self::getSerieData($row);
        } else {
            $serie = null;
        }
        return $serie;
    }
    private static function getSerieData($row)
    {
        $serieId = $row['id'];
        $actors = self::getActorsObj($serieId);
        $audioLanguages = self::getAudioLanguagesObj($serieId);
        $subtitleLanguages = self::getSubLanguagesObj($serieId);
        $platform = Platform::getById($row['plataforma']);
        $director = Directors::getById($row['director']);

        if (!$platform) {
            $platform = new platform(null, 'No registrado');
        }
        if (!$director) {
            $director = new directors(null, 'No registrado','',null, null);
        }

        $serie = new Serie(
            $serieId = $row['id'],
            $row['titulo'],
            $platform,
            $director,
            $actors,
            $audioLanguages,
            $subtitleLanguages
        );
        return $serie;
    }
    private static function getResultLanguages($results)
    {

        $languageArray = [];
        foreach ($results as $language) {
            $languageId = $language->getLanguageId();
            $languageArray[] = Language::getById($languageId);
        }
        return $languageArray;
    }
    private static function getResultActors($results)
    {

        $actorArray = [];
        foreach ($results as $actuation) {
            $actorId = $actuation->getActorId();
            $actorArray[] = Actors::getById($actorId);
        }
        return $actorArray;
    }

    private static function getAudioLanguagesObj($serieId)
    {
        $audioLanguages = Speak::getBySerieId($serieId);
        return self::getResultLanguages($audioLanguages);
    }
    private static function getSubLanguagesObj($serieId)
    {
        $subtitleLanguages = Subtitle::getBySerieId($serieId);
        return self::getResultLanguages($subtitleLanguages);
    }
    private static function getActorsObj($serieId)
    {
        $actors = Actuation::getBySerieId($serieId);
        return self::getResultActors($actors);
    }

    public function getAudioLanguageNames()
    {
        $name = fn($a) => $a->getName();
        $languages = array_map($name, $this->audioLanguages);
        return implode(', ', $languages);
    }
    public function getSutitleLanguageNames()
    {
        $name = fn($a) => $a->getName();
        $languages = array_map($name, $this->subtitleLanguages);
        return implode(', ', $languages);
    }
    public function getActorsNames()
    {
        $name = fn($a) => $a->getName() . ' ' . $a->getSurname();
        $actors = array_map($name, $this->actors);
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
            $serie = self::getSerieData($row);
            $series[] = $serie;
        }
        $dbConn->closeConnection();
        return $series;
    }
    /**
     * @return Serie|null
     */
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

        $query = "SELECT * FROM series WHERE titulo = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$title]);
        $result = $stmt->get_result();
        $serie = self::getResultData($result);
        $dbConn->closeConnection();
        return $serie;
    }
    private function creteAudiolanguagesRelations()
    {
        foreach ($this->audioLanguages as $languageId) {
            Speak::createSpeak($this->id, $languageId);
        }
    }
    private function createSubtitlelanguagesRelations()
    {
        foreach ($this->subtitleLanguages as $languageId) {
            Subtitle::createSubtitle($this->id, $languageId);
        }
    }
    private function createActuationRelations()
    {
        foreach ($this->actors as $actorId) {
            Actuation::createActuation($actorId, $this->id);
        }
    }
    private function updateActuationRelations()
    {
        $existingActuations = Actuation::getBySerieId($this->id);

        $desiredActuations = [];
        if (is_array($this->actors)) {
            foreach ($this->actors as $actorId) {
                $desiredActuations[] = new Actuation($actorId, $this->id);
            }
        }

        $compare = function ($a, $b) {
            return $a->equals($b) ? 0 : ($a->getActorId() <=> $b->getActorId());
        };

        $toDelete = array_udiff($existingActuations, $desiredActuations, $compare);
        $toInsert = array_udiff($desiredActuations, $existingActuations, $compare);

        foreach ($toDelete as $actuation) {
            $actuation->delete();
        }
        foreach ($toInsert as $actuation) {
            Actuation::createActuation($actuation->getActorId(), $actuation->getSerieId());
        }
    }
    private function updateAudioRelations()
    {
        $existingAudio = Speak::getBySerieId($this->id);

        $desiredAudio = [];
        if (is_array($this->audioLanguages)) {
            foreach ($this->audioLanguages as $language) {
                $desiredAudio[] = new Speak($this->id, $language);
            }
        }
        $compare = function ($a, $b) {
            return $a->equals($b) ? 0 : ($a->getLanguageId() <=> $b->getLanguageId());
        };
        $toDelete = array_udiff($existingAudio, $desiredAudio, $compare);
        $toInsert = array_udiff($desiredAudio, $existingAudio, $compare);

        foreach ($toDelete as $language) {
            $language->delete();
        }
        foreach ($toInsert as $language) {
            Speak::createSpeak($language->getSerieId(), $language->getLanguageId());
        }
    }
    private function updateSubtitleRelations()
    {
        $existingSubtitles = Subtitle::getBySerieId($this->id);

        $desiredSubtitles = [];
        if (is_array($this->subtitleLanguages)) {
            foreach ($this->subtitleLanguages as $language) {
                $desiredSubtitles[] = new Subtitle($this->id, $language);
            }
        }
        $compare = function ($a, $b) {
            return $a->equals($b) ? 0 : ($a->getLanguageId() <=> $b->getLanguageId());
        };
        $toDelete = array_udiff($existingSubtitles, $desiredSubtitles, $compare);
        $toInsert = array_udiff($desiredSubtitles, $existingSubtitles, $compare);

        foreach ($toDelete as $language) {
            $language->delete();
        }
        foreach ($toInsert as $language) {
            Subtitle::createSubtitle($language->getSerieId(), $language->getLanguageId());
        }
    }



    public function save()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        if ($this->id == null) {
            // create new platform
            $query = "INSERT INTO series (titulo, plataforma, director) VALUES (?, ?, ?)";
            $stmt = $db->prepare($query);
            $result = $stmt->execute([$this->title, $this->platform, $this->director]);
            if ($result) {
                $this->id = $db->insert_id;
                $this->creteAudiolanguagesRelations();
                $this->createSubtitlelanguagesRelations();
                $this->createActuationRelations();
                return true;
            }

        } else {
            $query = "UPDATE series SET titulo = ?, plataforma = ?, director = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $result = $stmt->execute([$this->title, $this->platform, $this->director, $this->id]);
            if ($result) {
                $this->updateActuationRelations();
                $this->updateAudioRelations();
                $this->updateSubtitleRelations();
            }
            return $result;
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

    public static function updateSerie($id, $tile, $platform, $director, $actors, $audioLanguages, $subtitleLanguages)
    {
        $serie = new Serie($id, $tile, $platform, $director, $actors, $audioLanguages, $subtitleLanguages);
        return $serie->save();
    }

}
?>