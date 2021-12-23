<?php
$id = $_POST['id'];
var_dump($id);
$pdo = new PDO('mysql:dbname=fullstack;host=127.0.0.1', 'mois', 'mois');

$sql = "delete from users where id = :id";
$pdo->prepare($sql)->execute([
    ':id' => $id,
]);

header('Location: ../index.php');