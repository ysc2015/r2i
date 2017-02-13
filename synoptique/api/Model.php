<?php
class Model {
    protected $table_name;
    protected $pdo;
    protected $stmt;

    function __construct(PDO $pdo,$tableName)
    {
        $this->pdo = $pdo;
        $this->table_name = $tableName;
    }

    function add($data) {
        $query = 'INSERT INTO ' . $this->table_name . '(%s) VALUES (%s)';
        $keys = '';
        $binds = '';
        foreach($data as $k => $v) {
            $keys .= '`' . $k . '`,';
            $binds .= ':' . $k . ',';
        }
        $keys = substr($keys,0,-1);
        $binds = substr($binds,0,-1);
        $query = sprintf($query,$keys,$binds);

        $stmt = $this->pdo->prepare($query);
        foreach($data as $k => $v) {
            $stmt->bindParam(':' . $k,$data[$k]);
        }
        $stmt->execute();
        $this->stmt = $stmt;
        return $this;
    }

    function update($ids,$data) {
        $query = 'UPDATE ' . $this->table_name . ' SET %s WHERE %s';

        $updateString = $this->getUpdateString($data);
        $idString = $this->getUpdateString($ids);

        $query = sprintf($query,$updateString,$idString);

        $stmt = $this->pdo->prepare($query);

        foreach($ids as $k => $v) {
            $stmt->bindParam(':' . $k,$ids[$k]);
        }
        foreach($data as $k => $v) {
            $stmt->bindParam(':' . $k,$data[$k]);
        }

        $stmt->execute();
        $this->stmt = $stmt;
        return $this;
    }

    public function getUpdateString($data)
    {
        $keys = '';
        foreach ($data as $k => $v) {
            $keys .= '`' . $k . '`=' . ':' . $k . ',';
        }
        $keys = substr($keys,0,-1);
        return $keys;
    }
}