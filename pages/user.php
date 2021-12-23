<?php
session_start();
$alert = '';
$userid = (integer) $_GET['id'];
if($userid == null || gettype($userid) != 'integer') {
    exit("Неверные данные");
}
$pdo = new PDO('mysql:dbname=fullstack;host=127.0.0.1', 'mois', 'mois');
    
$sql = 'SELECT * FROM users WHERE id = :id';

$res = $pdo->prepare($sql);
$res->execute([
    ':id' => $userid
]);
$user = $res->fetch();

if(!$user) exit("Такой пользователь не найден");
extract($user, EXTR_OVERWRITE);

$cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();

$opt = '';
foreach ($cities as $k => $c) {
    extract($c, EXTR_OVERWRITE);
    $selected = ($city_id && $city_id == $id) ? ' selected':'';
    $opt .= "<option $selected value='$c_id'>$c_city</option>";
}
$opt = (!$city_id)?"<option selected disabled>Выберите город</option> $opt":"$opt <option value=''>Исключить город</option>";
if($_SESSION['error']){
    $alert = "<div class='alert alert-danger' role='alert'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
} else if ($_SESSION['succsess']){
    $alert = "<div class='alert alert-success' role='alert'>{$_SESSION['succsess']}</div>";
    unset($_SESSION['succsess']);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
    <?=$alert?>
  <form action="../actions/update_user.php" method="POST">
        <input name="id" hidden value="<?=$id?>">
        <input type="text" class="form-control mb-3" name="name" aria-describedby="helpId" placeholder="Имя" value="<?=$name?>">
        <input type="email" class="form-control mb-3" name="email" aria-describedby="emailHelpId" placeholder="Электронная почта" value="<?=$email?>">
        <select class="form-select mb-3" name="city_id">
            <?=$opt?>
        </select>
        <button type="submit" class="btn btn-primary w-100">Сохранить</button>
    </form> 
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>