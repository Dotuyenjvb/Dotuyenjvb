<?php
$router = new apps_libs_Router();
$categories = new apps_Models_categories();
$posts = new apps_Models_posts();
$listcate = $categories->buildqueryparams()->select();
$listposts = $posts->buildqueryparams([
    "where" => $router->getGET("cate_id") ? " cate_id = " . intval($router->getGET("cate_id")) : ""
    ])-> select();
?>
<html>
    <head>
        <style>
            
            .menu{
                width: 100%;
                height: 10%;
                background: #78ff0047;
                text-align: center;
                padding: 20px;    
            }
            
            .menu li{
                float: left;
                margin-left: 15px;
                font-size: 20px;
                list-style:none;
               
            }
            
            .list{
                width: 50%;
            }
            
            h1{
                padding: 25px;
                color: #006666;
            }
              
        </style>  
    </head>
    <body>
        <div>
            <h1>DAN TRI</h1>
        </div>
        <div class = "menu">
            <ul>
                <li ><a href= "<?= $router->createUrl("home")?>">Home</a></li>
                 <?php                 
                 foreach ($listcate as $row){
                     ?>
                 <li><a href= "<?= $router->createUrl("home", ["cate_id" => $row["id"]])?>"><?= $row["name"] ?></a></li>
                 <?php } ?>
            </ul> 
        </div>
        
        <div class = "list">
            <ul>
                 <?php                 
                 foreach ($listposts as $row){
                     ?>
                  <li>
                      <a href ="<?= $router->createUrl("post_detail", ["id" => $row["id"]])?>"><?= $row["name"] ?> </a>
                      <p><?= $row["description"]?></p>
                  </li>
                 <?php } ?>
            </ul> 
        </div>
        
    </body>
</html>

