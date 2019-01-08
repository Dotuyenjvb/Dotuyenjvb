<?php
include '../apps/bootstrap.php';

$router = new apps_libs_Router(__DIR__);
$router->router();

//
//$a=new apps_Models_users ();
//$result = $a->buildQueryParams([
//  "fields"=>"(username,password) values (?,?)" ,
//  "values"=>["tuyen",  md5("admin")]
//])->insert();
//var_dump($result);

