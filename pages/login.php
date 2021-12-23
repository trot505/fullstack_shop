<?php 
$title = "Страница авторизации";
require_once "../templates/header.php";
?>
    <form method="post" action="/actions/login.php">
        <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="E-mail">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" name="password" placeholder="Пароль">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>  
<?php require_once '../templates/footer.php'; ?>