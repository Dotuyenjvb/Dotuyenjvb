<?php
$router = new apps_libs_Router;

$account = trim($router->getPOST('account'));
$password = trim($router->getPOST('password'));
$identity = new apps_libs_UsersIdentity;
if ($identity->isLogin()) {
    $router->homePage();
}
if ($router->getPOST("submit") && $account && $password) {
    $identity->username = $account;
    $identity->password = $password;
    if ($identity->Login()) {
        $router->homePage();
    } else {
        echo "Username or Password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Charm|Indie+Flower|Josefin+Sans:100i,300i,400,400i,600,600i,700,700i|Open+Sans:300i,400,400i,600,600i,700,800|Pacifico|Sedgwick+Ave&amp;subset=vietnamese" rel="stylesheet">
<title>VinID - Chương trình khách hàng thân thiết</title>
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
          background-color: #ff6666;
        }
        .container {
          padding: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
          .cancelbtn {
             width: 100%;
          }
        }
        p{
            font-size: 30px; font-style: initial; text-align: center; padding-top: 30px; font-family: 'Josefin Sans', sans-serif;
            font-weight: bolder; color: red;

        }
        .nut{
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: solid 0.5px;
            cursor: pointer;
            width: 100%;
        }
        .nut:hover {
          opacity: 0.8;
        }
    </style>
    </head>
    <body style="background-image: url('style/i2.jpg');
            background-size: cover;">
        <div class="all">
        <p>CẢM ƠN QUÝ KHÁCH ĐÃ TIN TƯỞNG VÀ SỬ DỤNG VINID</p>
        <div class="container" style="width:22%; background-color: #ffcccc; margin-top:-110px; border: double">
            <div style=" text-align: center; text-transform: uppercase">
                <h1>Sign in</h1> 
            </div>

                <form action="" method="POST">

                    <div class="container">
                      <label for="account"><b>Account</b></label>
                      <input type="text" placeholder=" Enter Username" name="account" required>

                      <label for="password"><b>Password</b></label>
                      <input type="password" placeholder=" Enter Password" name="password" required>

                      <input type="submit" name="submit" value="Login" class="nut">
                      <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                      </label>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                      <button type="button" class="cancelbtn">Cancel</button>
                      <button type="button" class="cancelbtn" style="float:right">Forgot password?</button>
                    </div>
                </form>
        </div>
        </div>
    </body>
</html>