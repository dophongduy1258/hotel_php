<?php


$models = __DIR__.'/classes';
$routeFiles = scandir($models);
foreach ($routeFiles as $routeFile) {
    $routeFilePath = $models . '/' . $routeFile;
    if (is_file($routeFilePath) && preg_match('/^.*\.(php)$/i', $routeFilePath))
        require $routeFilePath;
}

// include "include/session.php";
include "include/db.php";
include "#drectthumuc/config.php";
include "include/global.php";

$setup = $opt->showall();
