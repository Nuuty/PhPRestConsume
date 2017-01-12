<?php
//$uri = "http://eksamen.cloudapp.net/Service1.svc/Catch";
$uri = "http://eksamen.cloudapp.net/Service1.svc/Catchdb";

$jsondata = file_get_contents($uri);

$convertToAssociateArray = true;
$catches = json_decode($jsondata,$convertToAssociateArray);

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('catches.html.twig');

echo $template->render(array('catches' => $catches));