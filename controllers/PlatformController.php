<?php
require_once(__DIR__ . '/../models/PlatformModel.php');
function listPlatforms()
{
    $platformModel = new Platform(null, null);
    $platforms = $platformModel->getAll();
    $platformArray = [];

    foreach ($platforms as $platform) {
        $platformObj = new Platform($platform->getId(), $platform->getName());
        $platformArray[] = $platformObj;
    }
    return $platformArray;
}

?>