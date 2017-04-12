<?php


class Personne extends Model {
            
    function __construct($pdo=null, $tableName = '') {
        if(empty($tableName)) $tableName = __CLASS__;
        parent::__construct($pdo, $tableName);
        $this->class = new ReflectionObject($this);
    }   
}

