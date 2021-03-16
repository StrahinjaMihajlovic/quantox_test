<?php
require __DIR__ . '/vendor/autoload.php';

$controllerType =filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING) . "Controller";
if($controllerType == "Controller"){
    $controllerType = implode ("", ["index", $controllerType]);
}
$controllerType = implode("", ["\\quantox\\controllers\\",$controllerType]);
$controller = new $controllerType;
echo $controller->index();