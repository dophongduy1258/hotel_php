<?php
include 'include/session.php';
include 'include/db.php';
include 'include/global.php';
include 'library/smarty/Smarty.class.php';

$st = new Smarty();

$models = __DIR__.'/class';
$routeFiles = scandir($models);
foreach ($routeFiles as $routeFile) {
    $routeFilePath = $models . '/' . $routeFile;
    if (is_file($routeFilePath) && preg_match('/^.*\.(php)$/i', $routeFilePath))
        require_once $routeFilePath;
}

include '#drectthumuc/config.php';

$setup = $opt->showall();
$st->assign('setup', $setup);

