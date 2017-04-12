<?php

class Configuration {
    static $db;
    
    static function getDbConnection() {
        return self::$db;
    }
}
