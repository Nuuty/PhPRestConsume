<?php
//$uri = "http://eksamen.cloudapp.net/Service1.svc/Catch/";
$uri = "http://eksamen.cloudapp.net/Service1.svc/Catchdb/";
$name = $_POST['name'];
$jsondata = file_get_contents($uri . "fisker/" . $name);
$catches = json_decode($jsondata, true);

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('catches.html.twig');

echo $template->render(array('catches' => $catches));