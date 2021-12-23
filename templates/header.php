<?php
$r_path = $_SERVER['DOCUMENT_ROOT'];
require_once "$r_path/config.php";
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

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <div class="container">
                <a class="navbar-brand" href="#">Супер-Магаз</a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/register.php">Регистрация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/login.php">Авторизация</a>
                        </li>
                        <?php if ($_SESSION['user']) {?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['user']['name']?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="/pages/admin/user.php?id=<?= $_SESSION['user']['id']?>">Личный кабинет</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/actions/logout.php">Выход</a></li>
                            </ul>
                        </li>
                        <?php }?>
                    </ul>
                </div>
          </div>
        </nav>
        
    </header>