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

