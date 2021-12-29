<?php 
$title = "Страница авторизации";
require_once "../templates/header.php";
?>
<section class="container-fluid mt-3">
    <form class="mt-3" method="post" action="/actions/login.php">
        <div class="mb-2 form-floating">
            <input class="form-control" type="email" id="name" placeholder="Электронная почта" id="email" name="email" required/>
            <label for="email">Электронная почта</label>
        </div>
        <div class="mb-2 form-floating">
            <input class="form-control" type="password" id="name" placeholder="Пароль" id="password" name="password" required/>
            <label for="password">Пароль</label>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-4">Войти</button>
    </form>  
</section>
<?php require_once '../templates/footer.php'; ?>