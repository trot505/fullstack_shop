<?php
require_once '../../config';
$id = $_POST['id'];

$sql = "delete from categories where id = :id";
$pdo->prepare($sql)->execute([
    ':id' => $id,
]);

header('Location: /pages/admin/pages/categories.php');
