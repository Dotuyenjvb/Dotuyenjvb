<?php
$user = new apps_libs_UsersIdentity();
$router = new apps_libs_Router();
$categories = new apps_Models_categories();
$posts = new apps_Models_posts();
$listcate = $categories->buildqueryparams()->select();
$listposts = $posts->buildqueryparams([
    "where" => $router->getGET("cate_id") ? " cate_id = " . intval($router->getGET("cate_id")) : ""
    ])-> select();
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VinID - Chương trình khách hàng thân thiết</title>

    <!-- Bootstrap core CSS -->
    <link href="style/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="style/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Charm|Indie+Flower|Josefin+Sans:100i,300i,400,400i,600,600i,700,700i|Open+Sans:300i,400,400i,600,600i,700,800|Pacifico|Sedgwick+Ave&amp;subset=vietnamese" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="style/css/clean-blog.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Charm:400,700|Indie+Flower|Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i|Open+Sans:300i,400,400i,600,600i,700,800|Pacifico|Sedgwick+Ave&amp;subset=vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Charm:400,700|Indie+Flower|Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i|Open+Sans:300i,400,400i,600,600i,700,800|Pacifico|Sedgwick+Ave&amp;subset=vietnamese" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand" href="<?= $router->createUrl("home")?>"><h3>VinID</h3></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto"> 
              <li class="nav-item">
                  <a class="nav-link" href="<?= $router->createUrl("home")?>"><h6>Trang chủ</h6></a>
              </li>
            <?php                 
                 foreach ($listcate as $row){
                     ?>
            <li class="nav-item">
                <a class="nav-link"  href= "<?= $router->createUrl("home", ["cate_id" => $row["id"]])?>"><h6><?= $row["name"] ?></h6></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('style/img/heotd.webp')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <div class="site-heading">
              <h3>Tết cùng VinID</h3><br>
              <h1 style="font-family: 'Josefin Sans', sans-serif">TÍCH ĐIỂM VINID<br>RINH VINFAST VỀ NHÀ</h1>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    
    <div class="container">
        <div class="row"  style="background-color: #ccffcc">
            <div class="col-lg-10 mx-auto">
                <div class="post-preview">
                    <?php                 
                       foreach ($listposts as $row){
                    ?>
                    <a style="text-transform:uppercase; color: blue" href ="<?= $router->createUrl("post_detail", ["id" => $row["id"]])?>"><h3 class="post-title"><?= $row["name"] ?> </h3></a>
                    <a style="text-transform:capitalize; font-family: tahoma; color: orange" href="<?= $router->createUrl("post_detail", ["id" => $row["id"]])?>"> <?= $row["description"]?></a>
                    <p class="post-meta" style="font-family: 'Josefin Sans', sans-serif">Posted by <?= $user->getSESSION("username").". "?>Copyright 2019 by Vingroup</p>
                   <?php }?>
                 </div>
            </div>
        </div>
        <hr>
        <br>
        <a class="btn btn-info float-right" href="https://account.vinid.net/signup">ĐĂNG KÍ VIP</a>
    </div>
          
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
               <ul class="list-inline text-center">
                 <li class="list-inline-item">
                     <a style="color: #66ffff" href="https://twitter.com/">
                     <span class="fa-stack fa-lg">
                       <i class="fas fa-circle fa-stack-2x"></i>
                       <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                     </span>
                   </a>
                 </li>
                 <li class="list-inline-item">
                     <a style="color: #6666ff"href="https://www.facebook.com/">
                     <span class="fa-stack fa-lg">
                       <i class="fas fa-circle fa-stack-2x"></i>
                       <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                     </span>
                   </a>
                 </li>
                 <li class="list-inline-item">
                     <a style="color: #ffcccc" href="https://github.com/">
                     <span class="fa-stack fa-lg">
                       <i class="fas fa-circle fa-stack-2x"></i>
                       <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                     </span>
                   </a>
                 </li>
               </ul>
               <p class="copyright text-muted">Copyright 2019 by Vingroup. All rights reserved.</p>
            </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="style/vendor/jquery/jquery.min.js"></script>
    <script src="style/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="style/js/clean-blog.min.js"></script>

  </body>

</html>