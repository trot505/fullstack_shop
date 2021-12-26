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

$opt_cities = '';
foreach ($cities as $k => $c) {
	extract($c, EXTR_OVERWRITE);
	$selected = ($city_id && $city_id == $c_id) ? ' selected' : '';
	$opt_cities .= "<option $selected value='$c_id'>$c_city</option>";
}
$opt_cities = (!$city_id) ? "<option selected disabled>Выберите город</option> $opt_cities" : "$opt_cities <option value=''>Исключить город</option>";

$opt_roles = '';
foreach ($roles as $l => $r) {
	extract($r, EXTR_OVERWRITE);
	$selected = ($role_id && $role_id == $r_id) ? ' selected' : '';
	$opt_roles .= "<option $selected value='$r_id'>$r_role</option>";
}
if ($_SESSION['error']) {
	$alert = "<div class='alert alert-danger' role='alert'>{$_SESSION['error']}</div>";
	unset($_SESSION['error']);
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
<section class='container-fluid mt-3'>
		<?= $alert ?>
		<form action="<?=$r_path?>/actions/update_user.php" method="POST">
			<input name="id" hidden value="<?= $id ?>">
			<input type="text" class="form-control mb-3" name="name" aria-describedby="helpId" placeholder="Имя" value="<?= $name ?>">
			<input type="email" class="form-control mb-3" name="email" aria-describedby="emailHelpId" placeholder="Электронная почта" value="<?= $email ?>">
            <select class="form-select mb-3" name="role_id">
				<?= $opt_roles ?>
			</select>
			<select class="form-select mb-3" name="city_id">
				<?= $opt_cities ?>
			</select>
			<button type="submit" class="btn btn-primary w-100">Сохранить</button>
		</form>
</section>
	<?php require_once '../templates/footer.php';?>