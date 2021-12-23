<?php
$title = "Страница регистрации";
require_once "../templates/header.php";
$cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();
$opt = '';
foreach ($cities as $k => $c) {
    extract($c, EXTR_OVERWRITE);
    $opt .= "<option value='$c_id'>$c_city</option>";
}
?>
    <form action="../actions/register.php" method="POST">
            <input type="text" class="form-control mb-3" name="name" aria-describedby="helpId" placeholder="Имя">
            <input type="email" class="form-control mb-3" name="email" aria-describedby="emailHelpId" placeholder="Электронная почта">
            <input type="password" class="form-control mb-3" name="password" placeholder="Пароль">
            <select class="form-select mb-3" name="city_id">
                <option selected disabled>--Выберете город--</option>
                <?= $opt ?>
            </select>
            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
        </form>  
<?php require_once '../templates/footer.php'; ?>