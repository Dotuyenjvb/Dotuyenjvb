<?php
$users = new apps_Models_users();
$user = new apps_libs_UsersIdentity();
$query = $users->buildQueryParams([
            ]
        )->select();
$router = new apps_libs_Router();
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<body  style="background-image: url('style/i8.jpg'); background-size: cover;">
    <div class="container" style="width: 35%; margin: 50px 100px;">
	<div class="row">
            <div class="col-md-12">
                <h2 style="color: red; font-family: tahoma;">Hi <?= $user->getSESSION("username")?>, Welcome to use VINID App </h2><hr>
                <h1 style="color: blue; font-family: tahoma;">MANAGE USERS </h1><br>
                <div class="table-responsive" style="border: double; background-color: #98fffb; margin-top: 40px">  
                     <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                           <th>ID</th>
                           <th>Username</th>
                           <th>Password</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </thead>
                       <?php foreach ($query as $row){?>
                        <tr style="color: blue; font-weight: bolder">
                           <td><?= $row['id']?></td>
                           <td><?= $row['username']?></td>
                           <td><?= $row["password"]?></td>
                           <td><a href="<?= $router->createUrl("users/detail", ["id" => $row["id"]])?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-success" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></a></td>
                           <td><a href="<?= $router->createUrl("users/delete", ["id" => $row["id"]])?>"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
                       </tr>
                       <?php }?>
                    </table>  
                </div>
            </div>
        </div><br>
        <a href="<?= $router->createUrl("users/detail") ?>" class="btn btn-warning" style="font-size: 20px; float: left">Add new </a>
        <a href="<?= $router->createUrl("logout") ?>" class="btn btn-danger" style="font-size: 20px; float: left; margin-left: 50px">Logout</a>
    </div>
</body>
</html>