<?php 
$h = '';
if ($_SESSION['user']) {
    $user_name = $_SESSION['user']['name'];
    $user_id = $_SESSION['user']['id'];
    $is_admin = ($_SESSION['user']['role_id'] == 1)?"<a class='dropdown-item' href='/pages/admin/'><i class='fas fa-users me-1'></i>Админка</a></li>":'';
    $h = "<ul class='navbar-nav me-auto mt-2 mt-lg-0 d-flex'>
        <li class='nav-item dropdown'>
            <a class='nav-link dropdown-toggle' href='#' id='navbarScrollingDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <i class='fas fa-user-secret fs-4 me-3'></i>
                $user_name
            </a>
            <ul class='dropdown-menu' aria-labelledby='navbarScrollingDropdown'>
                $is_admin
                <li><a class='dropdown-item' href='/pages/admin/pages/edit_user.php?id=$user_id'><i class='fas fa-user-edit me-1'></i>Личные данные</a></li>
                <li><hr class='dropdown-divider'></li>
                <li><a class='dropdown-item' href='/actions/logout.php'>Выход</a></li>
            </ul>
        </li>
    </ul>";
    echo $h;
} else echo '';