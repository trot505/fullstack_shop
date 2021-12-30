<?php
$title = 'Продукты';
require_once '../templates/header.php';

$name_p = ($_SESSION['product_fields']['name'])?"value='{$_SESSION['product_fields']['name']}'":'';
$name_err = ($_SESSION['product_err']['name'])?"is-invalid":'';
$name_label = ($_SESSION['product_err']['name'])?$_SESSION['product_err']['name']:'Название товара';
$price_p = ($_SESSION['product_fields']['price'])?"value='{$_SESSION['product_fields']['price']}'":'';
$price_err = ($_SESSION['product_err']['price'])?"is-invalid":'';
$price_label = ($_SESSION['product_err']['price'])?$_SESSION['product_err']['price']:'Цена товара';
$amount_p = ($_SESSION['product_fields']['amount'])?"value='{$_SESSION['product_fields']['amount']}'":'';
$description_p = ($_SESSION['product_fields']['description'])?$_SESSION['product_fields']['description']:'';
$image_err = ($_SESSION['product_err']['image'])??'';

$category_p = ($_SESSION['product_fields']['category_id'])??false;
$category_err = ($_SESSION['product_err']['category_id'])?"is-invalid":'';
$category_label = ($_SESSION['product_err']['category_id'])?$_SESSION['product_err']['category_id']:'Категория';

$sql = 'SELECT id, name FROM categories';
$categories = $pdo->query($sql)->fetchAll();

$def_selected = (!$category_p)?'selected':'';
$select_category = "<div class='mb-2 form-floating'><select class='form-select $category_err' id='category_id' name='category_id' ><option $def_selected disabled>--Выберите категорию--</option>";
$arr_categories = [];
foreach ($categories as $category){
    extract($category, EXTR_OVERWRITE);
    $arr_categories[$id] = $name;
    $selected_item = ($category_p == $id)?'selected':'';
    $select_category .= "<option $selected_item value='$id'>$name</option>";
}
$select_category .= "</select><label for='category_id'>$category_label</label></div>";

$html = "<section class='container-fluid mt-3'>
    <form action='/actions/admin/add_product.php' enctype='multipart/form-data' method='POST'>
        <div class='mb-2 form-floating'>
            <input class='form-control $name_err' type='text' id='name' placeholder='$name_label' name='name' $name_p />
            <label for='name'>$name_label</label>
        </div>
        $select_category
        <div class='mb-2 form-floating'>
            <input class='form-control $price_err' type='text' id='name' placeholder='$price_label' id='price' name='price' $price_p />
            <label for='price'>$price_label</label>
        </div>
        <div class='mb-2 form-floating'>
            <input class='form-control' type='text' id='name' placeholder='Количество товара' id='amount' name='amount' $amount_p/>
            <label for='amount'>Количество товара</label>
        </div>
        <input type='file' class='form-control mb-2 $image_err' name='image_path' />
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
                <th>Категория</th>
                <th>Цена</th>
                <th>Количество</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

$sql = "SELECT * FROM products";
$products = $pdo->query($sql)->fetchAll();
$products_tabel = '';
if($products){
    foreach ($products as $product){
        extract($product, EXTR_OVERWRITE);
        $products_tabel .= "<tr>
                    <td>
                        <img src='{$DIR_IMG_PRODUCTS_PATH}/{$product['image_name']}' alt='{$product['name']}'>
                    </td>
                    <td scope='row'>{$product['id']}</td>
                    <td>{$product['name']}</td>
                    <td scope='row'>{$arr_categories[$product['category_id']]}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['amount']}</td>
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
} else $products_tabel .= "<tr><td colspan='7' class='text-center fs-5 fst-italic'>Список товаров пуст</td></tr>";

echo "$html $products_tabel </tbody></table></section>";

require_once '../templates/footer.php';

