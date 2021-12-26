<?php
$title = 'Категории';
require_once '../templates/header.php';

$html = "<section class='container-fluid mt-3'>
<form action='$r_path/actions/admin/add_category.php' method='POST'>
<input type='text' class='form-control mb-3' name='name' placeholder='Название категории' />
<textarea class='form-control mb-3' name='discription'></textarea>
<button type='submit' class='btn btn-success w-100'>Создать категорию</button>
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

//$sql = "SELECT * FROM categories";

//$ctegories = $pdo->query($sql)->fetchAll();

$cat = '';
if($ctegories){
    foreach ($ctegories as $category){
        $cat .= "<tr>
                    <td scope='row'>$id</td>
                    <td>$name</td>
                    <td>$description</td>
                    <td>
                        <div class='btn-group' role='group'>
                            <form action='$r_path/actions/admin/del_category.php' method='POST'>
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