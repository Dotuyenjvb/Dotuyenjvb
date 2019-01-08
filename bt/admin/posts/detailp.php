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
<html>
    <body>
        <div>
            <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
            <h1> <?= !$id ? "Create new" : "Viewing " ?> category: <?= $postsdetail["name"] ?> </h1>
        </div>
        <div class="show-data">
            <form action="<?php echo $router->createUrl('posts/detail', ["id" => $postsdetail["id"]]) ?>" method="POST">
                Title:
                <br>
                <input type="text" name="name" value="<?= $postsdetail["name"] ?>"><br>
                Category: <br>
                <select name="categories">
                    <?php
                    $listcategories = $categories->buildSelecBox();
                    foreach ($listcategories as $key => $value){
                        ?>
                    <option <?= $key == $postsdetail["cate_id"] ? "selected" : "" ?> value="<?= $key ?>"><?= $value?></option>
                    <?php } ?>
                </select><br>
                Description: <br>
                <textarea name="description"><?= $postsdetail["description"] ?></textarea>
                <br>
                Content: <br>
                 <textarea name="content"><?= $postsdetail["content"] ?></textarea>
                <br>
                <input type="submit" name="submit" value="Post">
                <input onclick="window.location.href = '<?= $router->createUrl("posts/index") ?>'" type="button" value="Cancel">   
            </form>
        </div>
    </body>
</html>
