<?php
$DIR_PATH = $_SERVER['DOCUMENT_ROOT'];

require_once "$DIR_PATH/config.php";
?>
<!doctype html>
<html lang="ru">

<head>
    <title><?=$title?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/"><i class="fas fa-store fs-2 me-2"></i>LAVKA</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/')?'active':''?>" href="/"><i class="fas fa-home fs-4 me-2"></i>Главная</a>
                        </li>
                        <?php if (!$_SESSION['user']) {?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/pages/register.php')?'active':''?>" href="/pages/register.php"><i class="fas fa-user-plus fs-4 me-2"></i>Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/pages/login.php')?'active':''?>" href="/pages/login.php"><i class="fas fa-sign-in-alt fs-4 me-2"></i>Авторизация</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php require_once "$DIR_PATH/templates/user_menu.php";?>
            </div>
        </nav>
    </header>


    