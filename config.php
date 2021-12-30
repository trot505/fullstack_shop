<?php
session_start();
$DIR_PATH = $_SERVER['DOCUMENT_ROOT'];
$DIR_IMG_PATH = $DIR_PATH."/images";
$DIR_IMG_PRODUCTS_PATH = $DIR_IMG_PATH."/products";

$db_name = 'fullstack';
$u = 'mois';
$p = 'mois';

$pdo = new PDO("mysql:dbname=$db_name;host=127.0.0.1", $u, $p);

function dd ($a){
    echo '<pre>';
    print_r($a);
    exit('</pre>');
}
