<?php
session_start();
$pdo = new PDO('mysql:dbname=fullstack;host=127.0.0.1', 'mois', 'mois');
extract($_POST);
var_dump(($city_id)?$city_id:NULL);

$sql = "UPDATE users SET name = :name, email = :email, city_id = :city_id WHERE id = :id";

$res = $pdo->prepare($sql);
$status  = $res->execute([
    ':id' => $id,
    ':name' => $name, 
    ':email' => $email,
    ':city_id' => ($city_id)?$city_id:NULL,
]);

if(!$status) $_SESSION['error'] =  $res->errorInfo()[2];
else $_SESSION['succsess'] =  'Данные сохранены!';

header("Location: ../pages/user.php?id=$id");