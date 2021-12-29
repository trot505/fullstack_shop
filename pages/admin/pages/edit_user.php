<?php
$title = 'Редактирование пользователя.';
require_once '../templates/header.php';
$alert = '';
$userid = (int) $_GET['id'];
$session_id = $_SESSION['user']['id'];
if ($session_id != 1 && $session_id != $userid) exit('<div class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fas fa-skull-crossbones fs-3 me-3"></i>
<div>
  Вами предпринята попытка взолма. Досвидули!
</div>
</div>');
if ($userid == null || gettype($userid) != 'integer') {
	exit("Неверные данные");
}
$sql = 'SELECT * FROM users WHERE id = :id';

$res = $pdo->prepare($sql);
$res->execute([
	':id' => $userid
]);
$user = $res->fetch();

if (!$user) exit("Такой пользователь не найден");
extract($user, EXTR_OVERWRITE);

$cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();
$roles = $pdo->query("SELECT id as r_id, name as r_role FROM roles")->fetchAll();

$opt_cities = "";
foreach ($cities as $k => $c) {
	extract($c, EXTR_OVERWRITE);
	$selected = ($city_id && $city_id == $c_id) ? ' selected' : '';
	$opt_cities .= "<option $selected value='$c_id'>$c_city</option>";
}
$opt_cities = (!$city_id) ? "<div class='form-floating mt-2'><select class='form-select' id='city_id' name='city_id' required><option selected disabled>--Выберите город--</option> $opt_cities" : "<div class='form-floating mt-2'><select class='form-select' id='city_id' name='city_id' required>$opt_cities<option value=''>Исключить город</option>";
$opt_cities .= "</select><label for='city_id'>Город</label></div>";

$opt_roles = "<div class='form-floating mt-2'><select class='form-select' id='role_id' name='role_id'>";
foreach ($roles as $l => $r) {
	extract($r, EXTR_OVERWRITE);
	$selected = ($role_id && $role_id == $r_id) ? ' selected' : '';
	$opt_roles .= "<option $selected value='$r_id'>$r_role</option>";
}
$opt_roles .= "</select><label for='role_id'>Роль</label></div>";
if ($_SESSION['error']) {
	$alert = "<div class='alert alert-danger' role='alert'>{$_SESSION['error']}</div>";
	unset($_SESSION['error']);
}
?>
<section class='container-fluid mt-3'>
		<?= $alert ?>
		<form action="/actions/update_user.php" method="POST">
			<input name="id" hidden value="<?= $id ?>">
			<div class="mb-2 form-floating">
                <input class="form-control" type="text" id="name" placeholder="Имя" id="name" name="name" value="<?=$name?>"required/>
                <label for="name">Имя</label>
            </div>
            <div class="mb-2 form-floating">
                <input class="form-control" type="email" id="name" placeholder="Электронная почта" id="email" name="email" value="<?=$email?>" required/>
                <label for="email">Электронная почта</label>
            </div>
            <?= $opt_roles ?>
			<?= $opt_cities ?>
			<button type="submit" class="btn btn-primary w-100 mt-4">Сохранить</button>
		</form>
</section>
	<?php require_once '../templates/footer.php';?>