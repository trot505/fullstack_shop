<?php
$title = 'Продукты';
require_once '../templates/header.php';

$html = "<section class='container-fluid mt-3'>
<form action='$r_path/actions/admin/add_product.php' enctype='multipart/form-data' method='POST'>
<input type='text' class='form-control mb-3' name='name' placeholder='Название товара' />
<input type='text' class='form-control mb-3' name='price' placeholder='Цена' />
<input type='text' class='form-control mb-3' name='price' placeholder='Количество' />
<input type='file' class='form-control mb-3' name='name' placeholder='Выберите файл'/>
<textarea class='form-control mb-3' name='discription' placeholder='Описание'></textarea>
<button type='submit' class='btn btn-success w-100'>Создать категорию</button>
</form>
<table class='table table-striped mt-5'>
    <thead class='thead-inverse'>
        <tr>
            <th>ID</th>
            <th>Название товара</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Фото</th>
            <th></th>
        </tr>
    </thead>
    <tbody>";

$sql = "SELECT * FROM categories";

$products = $pdo->query($sql)->fetchAll();

$cat = '';
if($products){
    foreach ($products as $product){
        $cat .= "<tr>
                    <td scope='row'>{$product['id']}</td>
                    <td>{$product['name']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['amount']}</td>
                    <td></td>
                    <td>
                        <div class='btn-group' role='group'>
                            <form action='$r_path/actions/admin/del_product.php' method='POST'>
                                <input hidden name='id' value='$id' />
                                <button type='submit' class='btn btn-outline-danger'><i class='far fa-trash-alt'></i></button>
                            </form>
                        </div>
                    </td>
                </tr>";
    }
} else $cat .= "<tr><td colspan='4' class='text-center fs-5 fst-italic'>Список категорий пуст</td></tr>";

echo "$html $cat </tbody></table></section>";

require_once '../templates/footer.php';

