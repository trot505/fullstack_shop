<?php
session_start();
$db_name = 'fullstack';
$u = 'mois';
$p = 'mois';

$pdo = new PDO("mysql:dbname=$db_name;host=127.0.0.1", $u, $p);

function dd ($a){
    echo '<pre>';
    print_r($a);
    exit('</pre>');
}
