<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
$categories = new apps_Models_categories();

$id = intval($router->getGET("id")); //intval: ép kiểu về số

if ($id) {
    $catedetail = $categories->buildQueryParams([
                "select" => "*",
                "where" => "id=:id",
                "params" => [":id" => $id]
            ])->selectOne();
    if (!$catedetail) {
        $router->pageNotFound();
    }
} else {
    $catedetail = [
        "id" => "",
        "name" => ""
    ];
}
if ($router->getPOST("submit") && $router->getPOST("name")) {
    $params = [
        ":name" => $router->getPOST("name"),
    ];
    $result = FALSE;
    if ($id) {
        $params[":id"] = $id;
        $result = $categories->buildQueryParams([
                    "values" => "name=:name",    
                    "where" => "id=:id",
                    "params" => $params     
                ])->update();
    } else {
        $result = $categories->buildQueryParams([
                    "fields" => "(name,created_by,created_time) VALUES (?,?,now())",
                    "values" => [$params[":name"], $user->getid()]
                ])->insert();
    }
    if ($result) {
        $router->redirect("categories/index");
    } else {
        $router->pageError("Can not update database");
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
    <body style="background-image: url('style/i6.jpg'); background-size: cover;">  
        <div class="table-responsive" style="width: 40%; margin: 50px 500px; padding: 30px 30px; border: double">
            <h2 style="color: orange; font-family: tahoma;">Hi <?= $user->getSESSION("username")?>, Welcome to VINID APP 
              <a href="<?= $router->createUrl("logout") ?>" class="btn btn-warning" style="font-size: 20px; float: right">Logout</a>
            </h2><hr><br>
                <h1 style="font-weight: bolder; color: blue"><?= !$id ? "Create new" : "Viewing " ?> category: <?= $catedetail["name"] ?> </h1><br>
            <div class="show-data">
                <form action="<?php echo $router->createUrl('categories/detail', ["id" => $catedetail["id"]]) ?>" method="POST">
                    <div style="float: left">
                        <p style="color: black; font-family: tahoma; float: left; font-size: 30px">Title:</p>
                    </div>
                    <input style="float: left; margin-left: 30px; font-size: 20px" class="list-group-item list-group-item-success" type="text" name="name" value="<?= $catedetail["name"] ?>">  
                    <input style="float: right" class="list-group-item list-group-item-info" onclick="window.location.href = '<?= $router->createUrl("categories/index") ?>'" type="button" value="Cancel">   
                    <input style="float: right" class="list-group-item list-group-item-danger" type="submit" name="submit" value="Post">
                </form> 
              
            </div>  
        </div>
    </body>
</html>

</html>