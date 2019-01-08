<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
$categories = new apps_Models_categories();

$id = intval($router->getGET("id")); 
$catedetail = $categories->buildQueryParams([
                "select" => "*",
                "where" => "id=:id",
                "params" => [":id" => $id]
            ])->selectOne();
    if (!$catedetail) {
        $router->pageNotFound();
    }
    if ($id && $router->getPOST("submit")){
        if ($categories->delete('id=:id', [':id' => $id])){
             $router ->redirect('categories/index');
        }else{
            $router->pageError("Can not delete this row");
        }
    }
?>
    
<html>
    <body>
        <div>
            <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
            <h1>Do you want to delete: <?= $catedetail["name"] ?> </h1>
        </div>
        <div class="show-data">
            <form action="<?php echo $router->createUrl('categories/delete', ["id" =>$id]) ?>" method="POST">
                <input type="submit" name="submit" value="Yes">
                <input onclick="window.location.href = '<?= $router->createUrl("categories/index") ?>'" type="button" value="Cancel">   
            </form>
        </div>
    </body>
</html>
