<?php

class Photos extends Model {

    function __construct(PDO $pdo,$tableName='')
    {
        if(empty($tableName)) {
            $tableName = strtolower(__CLASS__);
        }
        parent::__construct($pdo,$tableName);
    }
}