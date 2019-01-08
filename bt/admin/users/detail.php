<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
$users = new apps_Models_users();

$id = intval($router->getGET("id")); //intval: ép kiểu về số

if ($id) {
    $usersdetail = $users->buildQueryParams([
                "select" => "*",
                "where" => "id=:id",
                "params" => [":id" => $id]
            ])->selectOne();
    if (!$usersdetail) {
        $router->pageNotFound();
    }
} else {
    $usersdetail = [
        "id" => "",
        "username" => "",
        "password" => "",
       
    ];
}
if ($router->getPOST("submit") && $router->getPOST("name")) {
    $params = [
        ":username" => $router->getPOST("username"),
    ];
    $result = FALSE;
    if ($id) {
        $params[":id"] = $id;
        $result = $users->buildQueryParams([
                    "values" => "username=:username",    
                    "where" => "id=:id",
                    "params" => $params     
                ])->update();
    } else {
        $result = $users->buildQueryParams([
                    "fields" => "(username,password,created_time) VALUES (?,?,now())",
                    "values" => [$params[":username"], $user->getid()]
                ])->insert();
    }
    if ($result) {
        $router->redirect("users/index");
    } else {
        $router->pageError("Can not update database");
    }
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Charm|Indie+Flower|Josefin+Sans:100i,300i,400,400i,600,600i,700,700i|Open+Sans:300i,400,400i,600,600i,700,800|Pacifico|Sedgwick+Ave&amp;subset=vietnamese" rel="stylesheet">
<title>VinID - Chương trình khách hàng thân thiết</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }

        button {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: solid 0.5px;
          cursor: pointer;
          width: 100%;
        }

        button:hover {
          opacity: 0.8;
        }

        .cancelbtn {
          width: auto;
          padding: 10px 18px;
          background-color: #beeae8;
        }    
         </style>
    </head>
    <body style="background-image: url('style/j1.jpg'); background-size: cover">
        <div class="table-responsive" style="width: 35%; margin: 10px 620px; padding: 30px 10px; border: double #a531e1; background-color: #ffe8bf">
            <div>
                    <h2 style="color: blue; font-family: tahoma;">Hi <?= $user->getSESSION("username")?>, Welcome to use VINID 
                    </h2>
                    <h1 style="color: red; font-family: tahoma;"> Create New Account: </h1>
            </div>
            <div class="show-data">
            <form action="<?php echo $router->createUrl('users/detail', ["id" => $usersdetail["id"]]) ?>" method="POST">
            </div>
           <div class="container" style="width: 50%; background-color: #beeae8; margin-top:50px; border: solid #58dfd9">
                <label for="account"><b>Account</b></label>
                <input type="text" placeholder=" New Username" name="account" required>
                <label><b>Phone number or Email</b></label>
                <input type="text" placeholder=" Your Phone or Email">
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder=" Password" name="password" required>
                 <input style="float: left" class="list-group-item list-group-item-danger" type="submit" name="submit" value="Create">
                <input style="float: left" class="list-group-item list-group-item-success" onclick="window.location.href = '<?= $router->createUrl("users/index") ?>'" type="button" value="Cancel">   
            </div>
           <a href="<?= $router->createUrl("logout") ?>" class="btn btn-warning" style="font-size: 20px; float: right">Logout</a>
        </div>
    </body>
</html>
