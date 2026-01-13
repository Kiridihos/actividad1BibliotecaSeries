<?php
require_once(__DIR__ . '/../models/SerieModel.php');
class SerieController
{
    public function index()
    {
        $series = Serie::getAll();
        echo "<pre> 2". print_r($series, true) ."</pre>";
        require_once(__DIR__ . '/../views/series/list-series.php');
    }
}
?>