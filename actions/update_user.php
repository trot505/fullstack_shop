<?php
require_once "../config.php";

extract($_POST);

$sql = "UPDATE users SET name = :name, email = :email, city_id = :city_id WHERE id = :id";

$res = $pdo->prepare($sql);
$status  = $res->execute([
    ':id' => $id,
    ':name' => $name,
    ':email' => $email,
    ':city_id' => ($city_id) ? $city_id : NULL,
]);

if (!$status) {
    $_SESSION['error'] =  $res->errorInfo()[2];
    header("Location: /pages/user.php?id=$id");
} else header("Location: /index.php");
