<?php
require_once "../../config.php";
unset($_SESSION['cat_err']);
unset($_SESSION['cat_fields']);
extract($_POST, EXTR_OVERWRITE);

if(!$name) {
    $_SESSION['cat_err']['name'] = "Поле с названием категории не заполнено.";
    $_SESSION['cat_fields'] = $_POST;
} else {
    $sql = "insert into categories (name,description)
            values (:name,:description)";
    $res = $pdo->prepare($sql);

    $status = $res->execute([
        ':name' => $name,
        ':description' => $description
    ]);
    
    if($status){
        unset($_SESSION['cat_err']);
        unset($_SESSION['cat_fields']);
    }
}
header('Location: /pages/admin/pages/categories.php');
