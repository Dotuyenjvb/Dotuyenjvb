<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
$users = new apps_Models_users();

$id = intval($router->getGET("id")); 
$usersdetail = $users->buildQueryParams([
                "select" => "*",
                "where" => "id=:id",
                "params" => [":id" => $id]
            ])->selectOne();
    if (!$usersdetail) {
        $router->pageNotFound();
    }
    if ($id && $router->getPOST("submit")){
        if ($users->delete('id=:id', [':id' => $id])){
             $router ->redirect('users/index');
        }else{
            $router->pageError("Can not delete this row");
        }
    }
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
    <body style="background-image: url('style/i9.jpg'); background-size: cover;">
        <div style="margin: 120px 650px">
          
            <h2 style="color: red; font-family: tahoma;">Hi <?= $user->getSESSION("username")?>, Welcome to VINID APP 
              <a href="<?= $router->createUrl("logout") ?>" class="btn btn-danger" style="font-size: 20px; float: right">Logout</a>
            </h2><hr><br>
                <h1 style="font-weight: bolder; color: blue">Do you want to delete: <?= $usersdetail["username"] ?> </h1><br>
            <div class="show-data" style="width: 60%">
                <form action="<?php echo $router->createUrl('users/delete', ["id" =>$id]) ?>" method="POST">
                    <input style="float: left" class="list-group-item list-group-item-danger" type="submit" name="submit" value="Yes">
                    <input style="float: left" class="list-group-item list-group-item-success" onclick="window.location.href = '<?= $router->createUrl("users/index") ?>'" type="button" value="Cancel">   
                </form> 
              
            </div>  
        </div>
    </body>
</html>