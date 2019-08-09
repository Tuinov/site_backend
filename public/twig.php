<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../twigtemplates');
$twig = new \Twig\Environment($loader);

echo $twig->render('index.html', ['name' => 'Admin', 'content' => $twig->render('catalog.html')]);