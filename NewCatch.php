<?php
$name = $_POST["name"];
$art = $_POST["art"];
$vaegt = $_POST["vaegt"];
$uge = $_POST["uge"];

// Adapted from http://www.lornajane.net/posts/2011/posting-json-data-with-php-curl
$data = array("Navn" => $name, "Art" => $art, "Vaegt" => $vaegt,"Uge" => $uge);
$data_string = json_encode($data);

//$uri = "http://eksamen.cloudapp.net/Service1.svc/Catch";
$uri = "http://eksamen.cloudapp.net/Service1.svc/Catchdb";
$ch = curl_init($uri);
// Vi bruger curl til mere komplekse operationer end GET
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// TRUE for at retunere som string
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
);
$jsondata = curl_exec($ch);
$newcatch = json_decode($jsondata,true);

$catchArray = array($newcatch);

require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('catches.html.twig');

echo $template->render(array('catches' => $catchArray));