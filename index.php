<!doctype html>
<html lang="ru">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
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
                    $pdo = new PDO('mysql:dbname=fullstack;host=127.0.0.1', 'mois', 'mois');

                    $sql = 'SELECT  u.*, c.name as city FROM users as u LEFT JOIN cities as c ON u.city_id = c.id';
                    $users = $pdo->query($sql)->fetchAll();
                    $cities = $pdo->query("SELECT id as c_id, name as c_city FROM cities")->fetchAll();

                    $h = '';
                    foreach ($users as $key => $user) {
                        extract($user, EXTR_OVERWRITE);
                        $h .= "<tr>
                        <td scope='row'>$id</td>
                        <td>
                            <a href='pages/user.php?id=$id'>
                                $name
                            </a>
                        </td>
                        <td>$email</td>
                        <td>$city</td>
                        <td>
                            <div class='btn-group' role='group'>
                                <form action='actions/del_user.php' method='POST'>
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
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>