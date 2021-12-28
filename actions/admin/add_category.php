<?php
require_once "../../config.php";

extract($_POST, EXTR_OVERWRITE);

$sql = "insert into categories (name,discriprion)
        values (:name,:discription)";
$res = $pdo->prepare($sql);

$status = $res->execute([
    ':name' => $name,
    ':discription' => $discription
]);

header('Location: /pages/admin/pages/categories.php');
