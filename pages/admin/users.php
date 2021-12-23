<?php
$title = 'Список пользователей';
require_once '../../templates/header.php';
?>

<div class="container-fluid">
        <table class="table table-striped">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>E-MAIL</th>
                    <th>CITY</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $sql = 'SELECT  u.*, c.name as city FROM users as u LEFT JOIN cities as c ON u.city_id = c.id';
                    $users = $pdo->query($sql)->fetchAll();
                    $cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();

                    $h = '';
                    foreach ($users as $key => $user) {
                        extract($user, EXTR_OVERWRITE);
                        $h .= "<tr>
                        <td scope='row'>$id</td>
                        <td>
                            <a href='user.php?id=$id'>
                                $name
                            </a>
                        </td>
                        <td>$email</td>
                        <td>$city</td>
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

                    $opt = '';
                    foreach ($cities as $k => $c) {
                        extract($c, EXTR_OVERWRITE);
                        $opt .= "<option value='$c_id'>$c_city</option>";
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