<?php
$title = 'Категории';
require_once '../templates/header.php';
$name_p = ($_SESSION['cat_fields']['name'])?"value='{$_SESSION['cat_fields']['name']}'":'';
$name_err = ($_SESSION['cat_err']['name'])?"is-invalid":'';
$name_label = ($_SESSION['cat_err']['name'])?$_SESSION['cat_err']['name']:'Название категории';
$name_err = ($_SESSION['cat_err']['name'])?"is-invalid":'Название категории';
$description_p = ($_SESSION['cat_fields']['description'])?$_SESSION['cat_fields']['description']:'';
$html = "<section class='container-fluid mt-3'>
<form action='/actions/admin/add_category.php' method='POST'>
<div class='mb-2 form-floating'>
    <input class='form-control $name_err' type='text' id='name' placeholder='$name_label' name='name' $name_p />
    <label for='name'>$name_label</label>
</div>
<div class='mb-2 form-floating'>
    <textarea class='form-control' id='description' name='description' placeholder='Описание категории'>$description_p</textarea>
    <label for='discription'>Описание категории</label>
</div>
<button type='submit' class='btn btn-success w-100 mt-4'>Создать категорию</button>
</form>
<table class='table table-striped mt-5'>
    <thead class='thead-inverse'>
        <tr>
            <th>ID</th>
            <th>Название категории</th>
            <th>Описание</th>
            <th></th>
        </tr>
    </thead>
    <tbody>";

$sql = "SELECT * FROM categories";
$ctegories = $pdo->query($sql)->fetchAll();

$cat = '';
if($ctegories){
    foreach ($ctegories as $category){
        extract($category, EXTR_OVERWRITE);
        $cat .= "<tr>
                    <td scope='row'>$id</td>
                    <td>$name</td>
                    <td>$description</td>
                    <td>
                        <div class='btn-group' role='group'>
                            <form action='/actions/admin/del_category.php' method='POST'>
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