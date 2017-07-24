<?php
/**
 * file: update_pb_files_list.php
 * User: rabii
 */
//sleep(2);
extract($_POST);

$insert = false;
$err = 0;
$message = array();

$stm = $db->prepare("update ressource set id_ordre_de_travail=NULL where id_ordre_de_travail=:id_ordre_de_travail and type_objet=:type_objet");

if(isset($idot) && !empty($idot)){
    if($stm->execute(array(':id_ordre_de_travail' => $idot , ':type_objet' => $objtype))) {
        if(isset($idf) && !empty($idf)) {
            $stm = $db->prepare("update ressource set id_ordre_de_travail=:id_ordre_de_travail where id_ressource = $idf");
            if($stm->execute(array(':id_ordre_de_travail' => $idot))) {


                //traitement du devis pour l'enregistrement dans la base
                $templateFile = __DIR__."/../../uploads/templates/Bordereaux de Prix FTTH_INT_HRZ_INDA.xlsx";

                $stm = $db->prepare("SELECT * FROM ressource WHERE id_ressource=:id");
                $stm->bindParam(':id',$idf);
                $stm->execute();
                $row = $stm->fetch(PDO::FETCH_OBJ);

                $fileName = $row->nom_fichier;

                if($row->type_objet == "transport_racoord_pboite") {
                    loadExcelDEF_BPE_EBM_CTR($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$idf);
                } else if($row->type_objet == "distribution_racoord_pboite") {
                    $stm_debut_traitement_devis = $db->prepare("insert into etat_traitement_devis (id_ressource,id_ordre_traivail,id_user,nom_fichier) values (:id_ressource,:id_ordre_traivail,:id_user,:nom_fichier)");
                    $stm_debut_traitement_devis->bindParam(":id_ressource",$idf);
                    $stm_debut_traitement_devis->bindParam(":id_ordre_traivail",$idot);
                    $stm_debut_traitement_devis->bindParam(":id_user",$connectedProfil->profil->id_utilisateur);
                    $stm_debut_traitement_devis->bindValue(":nom_fichier","".__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque);
                    $stm_debut_traitement_devis->execute();

                   // loadExcelDEF_CABLE($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$idf,$idot,$connectedProfil);
                   // loadExcelDEF_BPE_EBM($db,__DIR__."/../../uploads/". $row->dossier . "/" .$row->nom_fichier_disque,$idf);
                }

                
                $message[] = "Fichier Affecté !";
            } else {
                $err++;
                $message [] = $stm->errorInfo();
            }
        } else {
            $message[] = "Fichier Affecté !";
        }
    } else {
        $err++;
        $message [] = $stm->errorInfo();
    }
}

echo json_encode(array("error" => $err , "message" => $message));