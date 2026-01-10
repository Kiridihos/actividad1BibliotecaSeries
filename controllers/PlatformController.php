<?php
require_once(__DIR__ . '/../models/PlatformModel.php');

class PlatformController
{
    public function index()
    {
        $platforms = Platform::getAll();
        require_once (__DIR__ .'/../views/platforms/list-platforms.php');
    }
}

?>