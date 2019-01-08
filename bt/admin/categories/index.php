<?php
$categories = new apps_Models_categories();
$user = new apps_libs_UsersIdentity();
$query = $categories->buildQueryParams([])->select();
$router = new apps_libs_Router();
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<body  style="background-image: url('style/i5.png'); background-size: cover;">
    <div class="container" style="width: 50%">
	<div class="row">
            <div class="col-md-12">
               <div style="padding-top: 50px; margin-left: -100px">
                    <h2 style="color: red; font-family: tahoma;">Hi <?= $user->getSESSION("username")?>, Welcome to use VINID App </h2><hr>
                </div><br>
                <h1 style="color: orange; font-family: tahoma; padding-top: 200px">MANAGE CATEGORIES </h1><br>
                <div class="table-responsive" style="border: double">  
                     <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Date</th>
                           <th>Edit</th>
                           <th>Delete</th>
                        </thead>
                       <?php foreach ($query as $row){?>
                        <tr style="color: orange; font-weight: bolder">
                           <td><?= $row['id']?></td>
                           <td><?= $row['name']?></td>
                           <td><?= $row["created_time"]?></td>
                           <td><a href="<?= $router->createUrl("categories/detail", ["id" => $row["id"]])?>"><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-success" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></a></td>
                           <td><a href="<?= $router->createUrl("categories/delete", ["id" => $row["id"]])?>"><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></a></td>
                       </tr>
                       <?php }?>
                    </table>  
                </div>
            </div>
        </div><br>
        <a href="<?= $router->createUrl("categories/detail") ?>" class="btn btn-warning" style="font-size: 20px; float: left">Add new </a>
        <a href="<?= $router->createUrl("logout") ?>" class="btn btn-danger" style="font-size: 20px; float: right">Logout</a>
    </div>
</body>
</html>