<?php
require_once '../../config.php';
$id = $_POST['id'];

$sql = "delete from users where id = :id";
$pdo->prepare($sql)->execute([
    ':id' => $id,
]);

header('Location: /pages/admin/pages/users.php');
