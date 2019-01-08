<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>VinID - Chương trình khách hàng thân thiết</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    <body  style="background-image: url('style/i1.png'); background-size: cover;">
        <div class="container" style="margin-top: 100px; margin-left: 200px">
            <h2 style="color: red; font-family: tahoma">Hi <?= $user->getSESSION("username")?>, Welcome to use VINID App </h2><br>
            <h1 style="font-weight: bolder; color: green">ADMIN PAGE</h1>
            <div class="show-data" style="width: 60%">
                <ul class="list-group" style="font-size: 40px">
                   <a class="list-group-item list-group-item-info" href="<?= $router->createUrl('posts/index')?>"><input type="submit" name="submit" value="Manage Posts"></a>
                   <a class="list-group-item list-group-item-danger" href="<?= $router->createUrl('categories/index')?>"><input type="submit" name="submit" value="Manage Category"></a>
                   <a class="list-group-item list-group-item-success" href="<?= $router->createUrl('users/index')?>"><input type="submit" name="submit" value="Manage Users"></a>
                </ul>
                <a href="<?= $router->createUrl("logout") ?>" class="btn btn-danger" style="font-size: 20px; float: right">Logout</a>
            </div>           
        </div>
    </body>
</html>