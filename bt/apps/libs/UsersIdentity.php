<?php
session_start();
class apps_libs_UsersIdentity {
    public $username;
    public $password;
    protected $id;
    public function __construct($username = "", $password = "") {
        $this->username = $username;
        $this->password = $password;
    }
    public function encryptPassword() { //tranh quan tri he thong co the nhin thay password
        return md5($this->password);
    }
    public function login() {
        $db = new apps_Models_users();
        $query = $db->buildQueryParams([
//                   "select" => "*", 
                    "where" => "username=:username AND password =:password",
                    "params" => [
                    ":username" => trim($this->username),
                    ":password" => $this->encryptPassword(),
                  
                    ]
                ])->selectOne();

        if ($query) {
            echo $_SESSION["userid"];
            $_SESSION["userid"] = $query["id"];
            $_SESSION["username"] = $query["username"];
       
            return TRUE;
        }
        return FALSE;
    }
    public function logout() {
        unset($_SESSION["userid"]);
        unset($_SESSION["username"]);
    }
    public function getSESSION($name) {
        if ($name !== NULL) {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : NULL;
        }
        return $_SESSION;
    }
    public function isLogin() {
        if ($this->getSESSION("userid")) {
            return TRUE;
        }
        return FALSE;
    }
    public function getid() { // ham chuyen lay userid và userName
        return $this->getSESSION("userid");
    }
}
