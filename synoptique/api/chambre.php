<?php

class Chambre extends Model {

    function __construct(PDO $pdo,$tableName='')
    {
        if(empty($tableName)) {
            $tableName = strtolower(__CLASS__);
        }
        parent::__construct($pdo,$tableName);
    }

    function ajouterChambre($data)
    {
        $this->add($data);
        return this;
    }

    function updateTypeInfra($chambre,$infra)
    {
        $this->update(['id_chambre' => $chambre], ['type_infra' => $infra]);
        return this;
    }

    function updateTypeChambre($chambre,$type_chambre)
    {
        $this->update(['id_chambre' => $chambre], ['type_chambre' => $type_chambre]);
        return this;
    }
}

switch($action) {
    case 'update_on_change':
        $f = $_POST['f'];
        $v = $_POST['v'];

        header('Content-Type: application/json');
        $ch = new Chambre($pdo,'syno_chambre');
        $ch->update(['id_chambre' => $_POST['id']],[$f => $v]);
        echo json_encode(['err' => 0, 'msg' => 'Mise à jour effectué avec succès',$_POST]);
        break;
}