<?php
$title = 'Продукты';
require_once '../templates/header.php';

$name_p = ($_SESSION['cat_fields']['name'])?"value='{$_SESSION['fields']['name']}'":'';
$name_err = ($_SESSION['cat_err']['name'])?"is-invalid":'';
$price_p = ($_SESSION['cat_fields']['price'])?"value='{$_SESSION['fields']['price']}'":'';
$price_err = ($_SESSION['cat_err']['price'])?"is-invalid":''; 
$amount_p = ($_SESSION['cat_fields']['amount'])?"value='{$_SESSION['fields']['amount']}'":'';
$description_p = ($_SESSION['cat_fields']['description'])?"value='{$_SESSION['fields']['description']}'":'';

$sql = 'SELECT id, name FROM categories';
$categories = $db->query($sql)->fetchAll();
$select_category = "<div class='form-floating mt-2'><select class='form-select' id='category_id' name='category_id' required><option selected disabled>--Выберите категорию--</option>";
foreach ($categories as $category){
    extract($category, EXTR_OVERWRITE);
    $cat_option .= "<option value='$id'>$name</option>";
}
$select_category .= "</select><label for='category_id'>Категория</label></div>";

$html = "<section class='container-fluid mt-3'>
    <form action='/actions/admin/add_product.php' enctype='multipart/form-data' method='POST'>
        <div class='mb-2 form-floating'>
            <input class='form-control $name_err' type='text' id='name' placeholder='Название товара' name='name' $name_p required/>
            <label for='name'>Название товара</label>
        </div>
        $select_category
        <div class='mb-2 form-floating'>
            <input class='form-control $price_err' type='text' id='name' placeholder='Цена товара' id='price' name='price' $price_p required/>
            <label for='price'>Цена товара</label>
        </div>
        <div class='mb-2 form-floating'>
            <input class='form-control' type='text' id='name' placeholder='Количество товара' id='amount' name='amount' $amount_p/>
            <label for='amount'>Количество товара</label>
        </div>
        <input type='file' class='form-control mb-2' name='image_path' placeholder='Выберите файл'/>
        <div class='mb-2 form-floating'>
            <textarea class='form-control' id='description' name='description' placeholder='Описание товара'>$description_p</textarea>
            <label for='description'>Описание товара</label>
        </div>
        <button type='submit' class='btn btn-success w-100 mt-4'>Создать категорию</button>
    </form>
    <table class='table table-striped mt-5'>
        <thead class='thead-inverse'>
            <tr>
                <th>Фото</th>
                <th>ID</th>
                <th>Название товара</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Фото</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

$sql = "SELECT * FROM products";
$products = $pdo->query($sql)->fetchAll();
$products_tabel = '';
if($products){
    foreach ($products as $product){
        $products_tabel .= "<tr>
                    <td>
                        <img src='{$DIR_IMG_PRODUCTS_PATH}/{$product['image_path']}' alt='{$product['name']}'>
                    </td>
                    <td scope='row'>{$product['id']}</td>
                    <td>{$product['name']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['amount']}</td>
                    <td scope='row'>{$product['category_id']}</td>
                    <td>
                        <div class='btn-group' role='group'>
                            <form action='/actions/admin/del_product.php' method='POST'>
                                <input hidden name='id' value='$id' />
                                <button type='submit' class='btn btn-outline-danger'><i class='far fa-trash-alt'></i></button>
                            </form>
                        </div>
                    </td>
                </tr>";
    }
} else $products_tabel .= "<tr><td colspan='4' class='text-center fs-5 fst-italic'>Список товаров пуст</td></tr>";

echo "$html $products_tabel </tbody></table></section>";

require_once '../templates/footer.php';

