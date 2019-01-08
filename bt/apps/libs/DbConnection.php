<?php

class apps_libs_DbConnection {  //class ket noi den database
    protected $username = "root";
    protected $password = "";
    protected $host = "localhost";
    protected $database = "baitap";
    protected $tableName;
    protected $queryparams = [];
    protected static $connectionInstance = null;

    public function __construct() {
        $this->connect();
    }
// tao ket noi den database
    public function connect() {
        if (self::$connectionInstance === null) {
            try {
                self::$connectionInstance = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->username, $this->password);
                self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $ex) {
                echo "error" . $ex->getMessage();
                die();
            }
        }
        return self::$connectionInstance;
    }
    public function buildqueryparams($params = []) {    
        $default = [
            "select" => "*",
            "from" => "",
            "where" => "",
            "others" => "",
            "params" => "",
            "fields" => "",
            "values" => [],
            "join" => ""
        ];
        $this->queryparams = array_merge($default, $params); // gộp mảng
        return $this;
    }
    public function query($sql, $param = []) {
        $q = self::$connectionInstance->prepare($sql);
        if (is_array($param) && $param) {
            $q->execute($param);
        } else {
            $q->execute(); 
        }
        return $q;
    }
    public function buildcondition($condition) {
        if (trim($condition)) {
            return "where " . $condition;
        }
        return "";
    }
    public function select() {
        $sql = "select " . $this->queryparams["select"] . " from " . $this->tableName
            . " " .$this->queryparams["join"] . " " .$this->buildcondition($this->queryparams["where"]) ;
        $query = $this->query($sql, $this->queryparams["params"]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectone() {
        $this->queryparams["others"] = "limit 1";
        $data = $this->select();
        if ($data) {
            return $data[0];
        }
        return[];
    }
    public function insert() {
        $sql = "insert into " . $this->tableName . " " . $this->queryparams["fields"];
        
        $result = $this->query($sql, $this->queryparams["values"]);
        if ($result) {
            return self::$connectionInstance->lastInsertId();
        } else {
            return FALSE;
        }
    }
    public function update() {
        $sql = "update " . $this->tableName . " set " . $this->queryparams["values"] . " " .
                $this->buildcondition($this->queryparams["where"]) . " " . $this->queryparams["others"];
        return $this->query($sql, $this->queryparams["params"]);   
    }
    public function delete() {
        $sql = "delete from " . $this->tableName . " " . $this->buildcondition($this->queryparams["where"]) . " " . $this->queryparams["others"];
        return $this->query($sql, $this->queryparams["params"]);
    }
}
