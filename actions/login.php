<?php
require_once '../config.php';

extract($_POST, EXTR_OVERWRITE);


$sql = "SELECT * FROM users WHERE email = :email AND password = :password";

$r = $pdo->prepare($sql);

$r->execute([
    'password' => $password,
    'email' => $email
]);

$user = $r->fetch();

if ($user) {
    $_SESSION['user'] = $user;
    header("Location: /index.php");
} else header("Location: /pages/login.php");