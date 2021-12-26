<?php 
if ($session_id != 1) {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="fas fa-skull-crossbones fs-3 me-3"></i>
            <div>
            Вами предпринята попытка взолма. Досвидули!
            </div>
            </div>';
    require_once '../../templates/footer.php';
    die();
}
$title = 'Админка';
require_once 'templates/header.php';

?>

<div class='card'>
    <img class='card-img-top' src='holder.js/100x180/' alt=''>
    <div class='card-body'>
        <h4 class='card-title'>Title</h4>
        <p class='card-text'>Text</p>
    </div>
</div>


<?php require_once '../../templates/footer.php';