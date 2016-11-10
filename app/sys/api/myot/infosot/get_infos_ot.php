<?php
/**
 * file: get_infos_ot.php
 * User: rabii
 */

extract($_POST);

$pci = "";

$link = "";

$stm = $db->prepare("select * from ordre_de_travail where id_ordre_de_travail=$idot");

$stm->execute();

$row = $stm->fetch(PDO::FETCH_OBJ);

$sousProjet = NULL;

if($row !== NULL) {
    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $row->id_sous_projet)
        )
    );

    if($sousProjet !== NULL) {
        if($sousProjet->{$row->type_entree} !== NULL) {
            $link = $sousProjet->{$row->type_entree}->lien_plans;
        }

        if($sousProjet->projet->nro !== NULL) {
            $nro = Nro::first(
                array('conditions' =>
                    array("id_nro = ?", $sousProjet->projet->nro)
                )
            );

            /*if($nro !== NULL) {
                $userPci = Utilisateur::first(
                    array('conditions' =>
                        array("id_utilisateur = ?", $nro->id_utilisateur2)
                    )
                );

                if($userPci !== NULL) {
                    $pci = $userPci->prenom_utilisateur." ".$userPci->nom_utilisateur;
                }
            }*/
        }

    }
}

echo json_encode(array("pci" =>  $pci,"lien" => $link));

