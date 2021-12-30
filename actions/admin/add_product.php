<?php
require_once "../../config.php";
unset($_SESSION['product_err']);
unset($_SESSION['pdoduct_fields']);
extract($_POST, EXTR_OVERWRITE);
$file = $_FILES['image_path'];
$file_type = explode('/',$file['type'])[0];

if(!$name) {
    $_SESSION['product_err']['name'] = "Поле с названием товара не заполнено.";
} 
if(!$price) {
    $_SESSION['product_err']['price'] = "Поле с ценой не заполнено.";
} 
if(!$category_id) {
    $_SESSION['product_err']['category_id'] = "Не выбранна категория.";
} 
if ($file['error'] != 0 ||  $file_type != 'image') {
    $_SESSION['product_err']['image'] = "is-invalid";
} 
if ($_SESSION['product_err']) $_SESSION['product_fields'] = $_POST;
else {
    $image_tmp_path = $file['tmp_name'];
    $image_info = pathinfo($file['name']);
    $image_name = $image_info['filename'].'_'.time().'.'.$image_info['extension'];
    move_uploaded_file($image_tmp_path, "$DIR_IMG_PRODUCTS_PATH/$image_name");

    $sql = "insert into products (name,category_id,price,amount,image_name,description)
            values (:name,:category_id,:price,:amount,:image_name,:description)";
    $res = $pdo->prepare($sql);

    $status = $res->execute([
        ':name' => $name,
        ':category_id' => $category_id,
        ':price' => $price,
        ':amount' => $amount,
        ':image_name' => $image_name,
        ':description' => $description
    ]);
    if($status){
        unset($_SESSION['product_err']);
        unset($_SESSION['product_fields']);
    }
}

header('Location: /pages/admin/pages/products.php');
