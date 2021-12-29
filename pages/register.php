<?php
$title = "Страница регистрации";
require_once "../templates/header.php";
$cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();
$opt = "<div class='form-floating mt-2'><select class='form-select' id='city_id' name='city_id'><option selected disabled>--Выберите город--</option>";
foreach ($cities as $k => $c) {
    extract($c, EXTR_OVERWRITE);
    $opt .= "<option value='$c_id'>$c_city</option>";
}
$opt .= "</select><label for='city_id'>Город</label></div>";

?>
<section class="container-fluid mt-3">
    <form action="../actions/register.php" method="POST">
        <div class="mb-2 form-floating">
            <input class="form-control" type="text" id="name" placeholder="Имя" id="name" name="name" required/>
            <label for="name">Имя</label>
        </div>
        <div class="mb-2 form-floating">
            <input class="form-control" type="email" id="name" placeholder="Электронная почта" id="email" name="email" required/>
            <label for="email">Электронная почта</label>
        </div>
        <div class="mb-2 form-floating">
            <input class="form-control" type="password" id="name" placeholder="Пароль" id="password" name="password" required/>
            <label for="password">Пароль</label>
        </div>
        <?=$opt?>
        <button type="submit" class="btn btn-primary w-100 mt-4">Зарегистрироваться</button>
    </form> 
</section>
<?php require_once '../templates/footer.php'; ?>