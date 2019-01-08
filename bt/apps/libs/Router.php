<?php

class apps_libs_Router{
    const PARAM_NAME = "a";
    const HOME_PAGE = "home";
    const INDEX_PAGE = "index";


    public static $sourcePath;  //goi den cac trang khac
    
    public function __construct($sourcePath="") {
        if ($sourcePath)
            self::$sourcePath = $sourcePath;  
    }
    
    public function getGET ($name = NULL){ 
        if ($name !==NULL){
            return isset($_GET[$name]) ? $_GET[$name] : NULL;
        }
        return $_GET;
    }  

    public function getPOST ($name = NULL){
        if ($name !== NULL){
            return isset($_POST[$name]) ? $_POST[$name] : NULL;
        }
        return $_POST;
    }
    
    public function router(){  // nhan va doc cac param de biet require den dau
        $url= $this->getGET(self::PARAM_NAME);
        if (!is_string($url) || !$url || $url == self::INDEX_PAGE){
            $url= self::HOME_PAGE;   
        }
       
        $path = self::$sourcePath."/".$url.".php";
        if(file_exists($path)){
            return require_once $path;
        }  else {
            return $this->pageNotFound();
        }
       
    }
    public function pageNotFound(){  //return ra trang 404
        echo " 404 Page Not Found";
        die();
    }
    
    #ham chuyen tao duong link
    public function createUrl($url,$params=[]){
        if ($url) {
            $params[self::PARAM_NAME] = $url;
        }
        return $_SERVER['PHP_SELF'].'?'.  http_build_query($params);
    }
    
        
    public function redirect($url){
        $u = $this->createUrl($url);
        header("Location:$u");     
    }
    
    public function homePage(){
        $this->redirect(self::HOME_PAGE);
    }
    
    public function loginPage(){
        $this->redirect("login");
    }
    public function pageError($error){
        echo $error;
        die();
    }
}

