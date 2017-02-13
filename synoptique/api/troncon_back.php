<?php
require_once '../config.php';

class Troncon {
    private $table_name;

    private $pdo;
    private $stmt;

    function __construct(PDO $pdo,$tableName = '')
    {
        parent::__construct($pdo,(empty($tableName) ? strtolower(__CLASS__) : $tableName));
        $this->pdo = $pdo;
        if(empty($tableName)) {
            $this->table_name = strtolower(__CLASS__);
        } else {
            $this->table_name = $tableName;
        }
    }

    function getTronconWithChambre($troncon_id) {
        $fields = ['id_chambre','ref_chambre','type_infra','type_chambre','manchon_prevu','gps'];
        $from = '';
        foreach($fields as $field) {
            $from .= 'src.' . $field . ' ' . $field . '_src,';
            $from .= 'dst.' . $field . ' ' . $field . '_dst,';
        }
        $from = substr($from,0,-1);
        $query = 'SELECT t.*, ' . $from . ' FROM ' . $this->table_name . ' t, syno_chambre src, syno_chambre dst WHERE src.id_chambre=t.chambre_src AND dst.id_chambre=t.chambre_dst AND id_troncon = :id';
        $this->stmt = $this->pdo->prepare($query);
        $this->stmt->bindParam(':id',$troncon_id);
        $this->stmt->execute();
        $line = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $line;
    }

    function ajouterTroncon($data) {
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
        return this;
    }

    function updateTypeInfra($chambre,$infra) {
        $query = 'UPDATE ' . $this->table_name . ' SET `type_infra` = :infra WHERE `id_chambre` = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':infra',$infra);
        $stmt->bindParam(':id',$chambre);
        $stmt->execute();
        $this->stmt = $stmt;
        return this;
    }

    function updateTypeChambre($chambre,$type_chambre) {
        $query = 'UPDATE ' . $this->table_name . ' SET `type_chambre` = :type_chambre WHERE `id_chambre` = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':type_chambre',$type_chambre);
        $stmt->bindParam(':id',$chambre);
        $stmt->execute();
        $this->stmt = $stmt;
        return this;
    }

}

if(!isset($action)) {
    $action = '';
}
switch($action) {
    case 'update_on_change':
        $f = $_POST['f'];
        $v = $_POST['v'];

        header('Content-Type: application/json');
        $tr = new Troncon($pdo,'syno_troncon');
        $tr->update(['id_troncon' => $_POST['id']],[$f => $v]);
        echo json_encode(['err' => 0, 'msg' => 'Mise à jour effectué avec succès',$_POST]);
        break;
    default:
        $troncon = new Troncon($pdo,'syno_troncon');
        header('Content-Type: application/json');
        echo json_encode($troncon->getTronconWithChambre($_POST['id']));
        break;
}

