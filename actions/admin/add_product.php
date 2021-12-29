<?php
require_once "../../config.php";

extract($_POST, EXTR_OVERWRITE);
$file = $_FILES;

if(!$name) {
    $_SESSION['cat_err']['name'] = "Поле с названием категории не заполнено.";
    $_SESSION['cat_fields'] = $_POST;
} else if(!$name) {
    $_SESSION['cat_err']['price'] = "Поле с названием категории не заполнено.";
    $_SESSION['cat_fields'] = $_POST;
} else {
    $sql = "insert into categories (name,discriprion)
            values (:name,:discription)";
    $res = $pdo->prepare($sql);

    $status = $res->execute([
        ':name' => $name,
        ':discription' => $discription
    ]);
}
header('Location: /pages/admin/pages/categories.php');
