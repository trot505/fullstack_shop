<?php
$pdo = new PDO('mysql:dbname=fullstack;host=127.0.0.1', 'mois', 'mois');
$cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();
$opt = '';
foreach ($cities as $k => $c) {
    extract($c, EXTR_OVERWRITE);
    $opt .= "<option value='$c_id'>$c_city</option>";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Страница регистрации</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
    <form action="actions/register.php" method="POST">
            <input type="text" class="form-control mb-3" name="name" aria-describedby="helpId" placeholder="Имя">
            <input type="email" class="form-control mb-3" name="email" aria-describedby="emailHelpId" placeholder="Электронная почта">
            <input type="password" class="form-control mb-3" name="password" placeholder="Пароль">
            <select class="form-select mb-3" name="city_id">
                <option selected disabled>--Выберете город--</option>
                <?= $opt ?>
            </select>
            <button type="submit" class="btn btn-primary w-100">Отправить</button>
        </form>  
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>