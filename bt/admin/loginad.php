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

<html>
    <body>
        <div>
            <h2>Welcome to Demo <h2>
        </div>
        <form action="" method="POST" >
            Account: <br>
            <input type="text" name="account" placeholder="  username or email"><br>
            Password: <br>
            <input type="password" name="password" placeholder="  fill your password ">
            <br><br>
            <input type="submit" name="submit" value="Login">
        </form>
    </body>
</html>

