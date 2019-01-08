<?php
$posts = new apps_Models_posts();
$user = new apps_libs_UsersIdentity();
$listposts = $posts->buildQueryParams([
    "select" => "posts.id, posts.name, posts.description, posts.created_time, categories.name as cate_name",
    "join" => "inner join categories on categories.id = posts.cate_id"
])->select();
$router = new apps_libs_Router();
?>

<html>
    <body>
        <div>
             <h3>Hi <?= $user->getSESSION("username")?>, Welcome to Demo </h3><a href="<?= $router->createUrl("logout") ?>">Logout</a>
             <h1>List Articles </h1>
            
            <a href="<?= $router->createUrl("posts/detail") ?>">Add new </a>
        </div>
        <div class="show-data">
            <table style="width: 100%" border="1">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Category</td>
                    <td>Description</td>
                    <td>Date</td>
                    <td>Delete</td>
                </tr>
                <?php foreach ($listposts as $data){?>
                <tr>
                    <td><?= $data["id"]?></td>
                    <td><a href="<?= $router->createUrl ("posts/detail", ["id" => $data["id"]])?>"><?= $data['name']?> </a></td>
                    <td><?= $data["cate_name"]?></td>
                    <td><?= $data['description']?></td>
                    <td><?= $data['created_time']?></td>
                    <td><a href="<?= $router->createUrl("posts/delete", ["id" => $data["id"]])?>">Delete</a></td>
                </tr>
                <?php }?>
            </table>
        </div>
    </body>
</html>


