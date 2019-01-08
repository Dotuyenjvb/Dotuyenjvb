<?php
$users = new apps_Models_users();
$user = new apps_libs_UsersIdentity();
$query = $users->buildQueryParams([
            ]
        )->select();
$router = new apps_libs_Router();
?>

<html>
    <body>
        <div>
             <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
            <h1>MANAGE USER </h1>
            
            <a href="<?= $router->createUrl("users/detail") ?>">Add new </a>
        </div>
        <div class="show-data">
            <table style="width: 50%" border="1">
                <tr>
                    <td>ID</td>
                    <td>Username</td>
                    <td>Password</td>
                    <td>Date</td>
                    <td>Delete</td>
                </tr>
                <?php foreach ($query as $row){?>
                <tr>
                    <td><?= $row['id']?></td>
                    <td><a href="<?= $router->createUrl ("users/detail", ["id" => $row["id"]])?>">
                        <?= $row['username']?>
                        </a>
                    </td>
                     <td><?= $row["password"]?></td>
                    <td><?= $row["created_time"]?></td>
                    <td><a href="<?= $router->createUrl("users/delete", ["id" => $row["id"]])?>">Delete</a></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </body>
</html>
