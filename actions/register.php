<?php
require_once "../config.php";

extract($_POST, EXTR_OVERWRITE);

$sql = "insert into users (name,email,password,city_id)
        values (:name,:email,:password,:city_id)";
$res = $pdo->prepare($sql);
echo '11111';
$status = $res->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => md5($password),
    ':city_id' => $city_id
]);

if($status){
    $sql = 'SELECT * FROM users WHERE name = :name AND email = :email';
    $r = $pdo->prepare($sql);
    $r->execute([':name' => $name,':email' => $email]);
    $_SESSION['user'] = $r->fetch();
}

header('Location: /index.php');
