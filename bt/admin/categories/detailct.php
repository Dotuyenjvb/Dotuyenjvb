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
<html>
    <body>
        <div>
             <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
            <h1> <?= !$id ? "Create new" : "Viewing " ?> category: <?= $catedetail["name"] ?> </h1>
        </div>
        <div class="show-data">
            <form action="<?php echo $router->createUrl('categories/detail', ["id" => $catedetail["id"]]) ?>" method="POST">
                Title:
                <br>
                <input type="text" name="name" value="<?= $catedetail["name"] ?>"><br>

                <br>
                <input type="submit" name="submit" value="Post">
                <input onclick="window.location.href = '<?= $router->createUrl("categories/index") ?>'" type="button" value="Cancel">   
            </form>
        </div>
    </body>
</html>
