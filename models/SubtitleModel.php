<?
require_once(__DIR__ . '/../config/DBConnection.php');
class Subtitle
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
    private static function getResultData($result)
    {
        if ($row = $result->fetch_assoc()) {
            $subtitle = new Subtitle($row['id_serie'], $row['id_idioma']);
        } else {
            $subtitle = null;
        }
        return $subtitle;
    }
    public static function getBySerieId($serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM subtitulada WHERE id_serie = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$serieId]);
        $result = $stmt->get_result();
        $subtitles = [];
        foreach ($result as $row) {
            $subtitle = new Subtitle($row['id_serie'], $row['id_idioma']);
            $subtitles[] = $subtitle;
        }
        $dbConn->closeConnection();
        return $subtitles;
    }
    public static function getByLanguageId($languageId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = "SELECT * FROM subtitulada WHERE id_idioma = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$languageId]);
        $result = $stmt->get_result();
        $subtitles = [];
        foreach ($result as $row) {
            $subtitle = new Subtitle($row['id_serie'], $row['id_idioma']);
            $subtitles[] = $subtitle;
        }
        $dbConn->closeConnection();
        return $subtitles;
    }
    public function delete()
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM subtitulada WHERE id_serie = ? AND id_idioma = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$this->serieId, $this->languageId]);
        if ($result) {
            $this->serieId = null;
            $this->languageId = null;
        }

        $dbConn->closeConnection();
        return $result;
    }
    public static function createSubtitle($serieId, $languageId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'INSERT INTO subtitulada (id_serie, id_idioma) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$serieId, $languageId]);
        $dbConn->closeConnection();
        return $result;
    }
    public static function deleteBySerieId($serieId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM subtitulada WHERE id_serie = ?';
        $stmt = $db->prepare($query);
        $result = $stmt->execute([$serieId]);
        $dbConn->closeConnection();
        return $result;
    }
    public static function deleteByLanguageId($languageId)
    {
        $dbConn = new DBConnection();
        $db = $dbConn->getConnection();
        $query = 'DELETE FROM subtitulada WHERE id_idioma = ?';
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