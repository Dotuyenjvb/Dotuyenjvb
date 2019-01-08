<?php

class apps_Models_categories extends apps_libs_DbConnection{
    protected $tableName= "categories";
    
    public function buildSelecBox() {
        $query = $this->buildqueryparams(["select"=>"id,name"])->select();
        $result = [""=>"-- Select category --"];
        foreach ($query as $row){
            $result[$row["id"]] = $row["name"];
        }
        return $result;
    }
}

