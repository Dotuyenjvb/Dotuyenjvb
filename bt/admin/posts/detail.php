<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
$posts = new apps_Models_posts();
$categories = new apps_Models_categories;
$id = $router ->getGET("id");


if ($id) {
    $postsdetail = $posts->buildQueryParams([
                "select" => "*",
                "where" => "id=:id",
                "params" => [":id" => $id]
            ])->selectOne();
    if (!$postsdetail) {
        $router->pageNotFound();
    }
} else {
    $postsdetail = [
        "id" => "",
        "name" => "",
        "content" => "",
        "description" => "",
        "cate_id" => ""
    ];
}
if ($router->getPOST("submit") && $router->getPOST("name") && $router->getPOST("content") && $router->getPOST("categories")) {
    $params = [
         ":name" => $router->getPOST("name"),
         ":cont" => $router->getPOST("content"),
         ":desc" => $router->getPOST("description"),  
         ":cate" => $router->getPOST("categories"),
    ];
    $result = FALSE;
    if ($id) {
        $params[":id"] = $id;
        $result = $posts->buildQueryParams([
                    "values" => "name=:name, content = :cont, description = :desc, cate_id = :cate",
                    "where" => "id=:id",
                    "params" => $params     
                ])->update();
    } else {
        $result = $posts->buildQueryParams([
                    "fields" => "(cate_id, name, description, content, created_by, created_time) VALUES (?,?,?,?,?,now())",
                    "values" => [$params[":cate"], $params[":name"], $params[":desc"], $params[":cont"], $user->getid()]  //created_by???
                ])->insert();
    }

    if ($result) {
        $router->redirect("posts/index");
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
    <body>  
        <div class="table-responsive" style="width: 40%; margin-left: 450px; margin-top: 30px; padding: 20px 20px; border: double; background-color: #a1f5f2">
            <h2 style="color: orange; font-family: tahoma;">Hi <?= $user->getSESSION("username")?>, Welcome to VINID APP 
              <a href="<?= $router->createUrl("logout") ?>" class="btn btn-warning" style="font-size: 20px; float: right">Logout</a>
            </h2><hr><br>
                <h1 style="font-weight: bolder; color: blue"><?= !$id ? "Create new" : "Viewing " ?> category: <?= $postsdetail["name"] ?> </h1><br>
            <div class="show-data">
                <form action="<?php echo $router->createUrl('posts/detail', ["id" => $postsdetail["id"]]) ?>" method="POST">
                    <div style="margin: 20px 30px"> <p style="color: #3300cc; font-family: tahoma; float: left; font-size: 30px">Title:</p>
                    <input style="float: left; margin-left: 30px; font-size: 20px" class="list-group-item list-group-item-success" type="text" name="name" value="<?= $postsdetail["name"] ?>">  <br>
                    </div><br>
                    <div style="margin: 20px 30px"><p style="color:#3300cc; font-family: tahoma; font-size: 30px">Category:</p>
                        <select name="categories" style=" margin-left: 100px; font-size: 20px" class="list-group-item list-group-item-success">
                        <?php
                        $listcategories = $categories->buildSelecBox();
                        foreach ($listcategories as $key => $value){
                            ?>
                        <option <?= $key == $postsdetail["cate_id"] ? "selected" : "" ?> value="<?= $key ?>"><?= $value?></option>
                        <?php } ?>
                        </select>
                    </div><br>
                   
                        <p style="margin-left: 30px; color:#3300cc; font-family: tahoma;  font-size: 30px;">Description:</p>
                        <textarea style=" margin-left: 130px; width: 450px; font-size: 20px" class="list-group-item list-group-item-success" type="text" name="description" value="<?= $postsdetail["description"] ?>"> </textarea>
                    <br>
                   
                    <p style="margin-left: 30px; color:#3300cc; font-family: tahoma;  font-size: 30px;">Content:</p>
                    <textarea style="margin-left: 130px; font-size: 20px; width: 450px" class="list-group-item list-group-item-success" type="text" name="content" value="<?= $postsdetail["content"] ?>"></textarea> <br>
            
                    <br>
             </div>    
                    <input style="float: right" class="list-group-item list-group-item-info" onclick="window.location.href = '<?= $router->createUrl("posts/index") ?>'" type="button" value="Cancel">   
                    <input style="float: right" class="list-group-item list-group-item-danger" type="submit" name="submit" value="Post">
            </form>
            </div>  
   
    </body>
</html>

</html>