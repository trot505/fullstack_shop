<?php
$DIR_PATH = $_SERVER['DOCUMENT_ROOT'];
require_once "$DIR_PATH/config.php";

echo "<!doctype html>
<html lang='ru'>
<head>
    <title>$title</title>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <link rel='stylesheet' href='/css/style.css'>
</head>
<body>";

$session_id = $_SESSION['user']['id'];
if ($session_id != 1) {
    $err_html = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-skull-crossbones fs-3 me-3"></i>
            <div>
            Вами предпринята попытка взолма. Досвидули!
            </div>
            </div>';

    echo $err_html;
    require_once '$DIR_PATH/templates/footer.php';
    sleep(4);
    header("Location: /");
} else {
    $user_menu = 
    require_once "$DIR_PATH/pages/admin/routs/index.php";
    
    $menu = '';
    foreach ($routs as $rout){
        $active = $_SERVER['REQUEST_URI'] == $rout['url']?'active':'';
        $menu .= "<li class='nav-item'>
                    <a class='nav-link $active' href='{$rout['url']}'><i class='fas fa-home fs-4 me-2'></i>{$rout['name']}</a>
                </li>";
    }
    echo "<header>
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container'>
                    <a class='navbar-brand' href='/'><i class='fas fa-store fs-2 me-2'></i>LAVKA</a>
                    <div class='collapse navbar-collapse'>
                        <ul class='navbar-nav me-auto mt-2 mt-lg-0'>
                            $menu
                        </ul>
                    </div>";
    require_once "$DIR_PATH/templates/user_menu.php";
    echo "</div></nav></header>";
}    