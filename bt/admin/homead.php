<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
?>
<html>
    <body>
        <div>
            <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
            <h1> ADMIN PAGE</h1>
            
        </div>
        <div class="show-data">
            <ul>
                <li><a href="<?= $router->createUrl('posts/index')?>">Manage Posts</a></li>
                <li><a href="<?= $router->createUrl('categories/index')?>">Manage Category</a></li>
                <li><a href="<?= $router->createUrl('users/index')?>">Manage Users</a></li>


            </ul>
            
        </div>
    </body>
    
</html>

