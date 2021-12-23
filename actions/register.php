<?php

$pdo = new Pdo('mysql:dbname=fullstack;127.0.0.1;port=3306', 'mois', 'mois');

extract($_POST, EXTR_OVERWRITE);

$sql = "insert into users (name,email,password,city_id)
        values (:name,:email,:password,:city_id)";
$res = $pdo->prepare($sql);
var_dump($res->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => $password,
    ':city_id' => $city_id
]));

header('Location: index.php');
