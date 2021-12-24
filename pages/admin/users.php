<?php
$title = 'Список пользователей';
require_once '../../templates/header.php';
$session_id = $_SESSION['user']['id'];
if ($session_id != 1) exit('<div class="alert alert-danger d-flex align-items-center" role="alert">
<i class="fas fa-skull-crossbones fs-3 me-3"></i>
<div>
  Вами предпринята попытка взолма. Досвидули!
</div>
</div>');
?>

<div class="container-fluid">
        <table class="table table-striped">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>E-MAIL</th>
                    <th>ГОРОД</th>
                    <th>РОЛЬ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $sql = 'SELECT  u.*, 
                                c.name as city,
                                r.name as role 
                            FROM users as u 
                            LEFT JOIN cities as c ON u.city_id = c.id
                            LEFT JOIN roles as r ON u.role_id = r.id';
                    $users = $pdo->query($sql)->fetchAll();

                    $h = '';
                    foreach ($users as $key => $user) {
                        extract($user, EXTR_OVERWRITE);
                        $h .= "<tr>
                        <td scope='row'>$id</td>
                        <td>
                            <a href='edit_user.php?id=$id'>
                                $name
                            </a>
                        </td>
                        <td>$email</td>
                        <td>$city</td>
                        <td>$role</td>
                        <td>
                            <div class='btn-group' role='group'>
                                <form action='../../actions/del_user.php' method='POST'>
                                    <input hidden name='id' value='$id' />
                                    <button type='submit' class='btn btn-danger'>x</button>
                                </form>
                            </div>
                        </td>
                    </tr>";
                    }
                } catch (PDOException $e) {
                    $h = $e->getMessage();
                }
                echo $h;

                ?>
            </tbody>
        </table>
    </div>
<?php require_once '../../templates/footer.php'; ?>