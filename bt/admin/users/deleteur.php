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
<html>
    <body>
        <div>
            <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
            <h1>Do you want to delete: <?= $usersdetail["username"] ?> </h1>
        </div>
        <div class="show-data">
            <form action="<?php echo $router->createUrl('users/delete', ["id" =>$id]) ?>" method="POST">
                <input type="submit" name="submit" value="Yes">
                <input onclick="window.location.href = '<?= $router->createUrl("users/index") ?>'" type="button" value="Cancel">   
            </form>
        </div>
    </body>
</html>


