<?php

class DBHelper {

    private static function checkWhere($where) {
        if (!empty($where)) {
            if (strtolower(substr(trim($where), 0, 5)) != 'where') {
                $where = 'WHERE ' . $where;
            }
        }
        return $where;
    }
    
    static function update($tableName,$where, $data = array()) {
        $where = self::checkWhere($where);
        $set = '';
        foreach($data as $k => $v) {
            $set .= $k . ' = :' . $k . ',';
        }
        $set = substr($set, 0,-1);
        
        $stmt = Configuration::$db->prepare('UPDATE ' . $tableName . ' SET ' . $set . ' ' . $where);
        self::bindParams($stmt, $data);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    static function insert($tableName, $data = array()) {
        $into = '';
        $values = '';
        foreach($data as $k => $v) {
            $into .= $k . ',';
            $values .= ':' . $k . ',';
        }
        $into = substr($into, 0,-1);
        $values = substr($values, 0,-1);
        
        $stmt = Configuration::$db->prepare('INSERT INTO ' . $tableName . '(' . $into . ') VALUES (' . $values . ')');
        self::bindParams($stmt, $data);
        if($stmt->execute()) {
            return Configuration::$db->lastInsertId();
        }
        return false;
    }

    static function count($tableName, $where = '', $data = null) {
        $where = self::checkWhere($where);

        $stmt = Configuration::$db->prepare('SELECT COUNT(*) AS NBR FROM ' . $tableName . ' ' . $where);
        if (is_array($data)) {
            self::bindParams($stmt, $data);
        }
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nbr = $row['NBR'];
        return $nbr;
    }

    private static function bindParams(PDOStatement $stmt, $data) {
        foreach ($data as $key => $value) {
            if ($key[0] == ':') {
                $stmt->bindParam($key, $data[$key]);
            } else {
                $stmt->bindParam(':' . $key, $data[$key]);
            }
        }
    }

    static function delete($tableName, $where = '', $data = null) {
        $where = self::checkWhere($where);
        $query = 'DELETE FROM ' . $tableName . ' ' . $where;
        $stmt = Configuration::$db->prepare($query);
        if (is_array($data)) {
            self::bindParams($stmt, $data);
        }
        return $stmt->execute();
    }

}
