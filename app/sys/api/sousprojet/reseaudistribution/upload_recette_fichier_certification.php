<?php
/**
 * file: upload_recette_chambre_file.php
 * User: rabii
 */

$output_dir = __DIR__."/../../uploads/fichier_certification/";
extract($_POST);

$excelCfg = array(
    "highestColumn" => 'G'
);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,'distribution_recette_fichier_certification',:nom_fichier,:nom_fichier_disque,'fichier_certification',:date_creation)");

if(isset($idsp) && !empty($idsp)) {
    $stm->bindParam(':id_sous_projet',$idsp);
    if (isset($_FILES["myfile"])) {
        $error = $_FILES["myfile"]["error"];
        if (!is_array($_FILES["myfile"]["name"])) {

            $fileName = time() . "_" . $_FILES["myfile"]["name"];

            $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
            $stm->bindParam(':nom_fichier_disque',$fileName);
            $stm->bindValue(':date_creation',date('Y-m-d H:i:s'));

            if($stm->execute()) {
                $details = array();
                $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                $details['id'] = $db->lastInsertId();

                $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);

                $lastInsertedId = $db->lastInsertId();
                $stm = $db->prepare("insert into fichier_certification (id_sous_projet,id_ressource,type_entree,ref_fichier_certification) values (:id_sous_projet,:id_ressource,'distribution_recette_fichier_certification',:ref_fichier_certification)");
                //  Read your Excel workbook
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($output_dir . $fileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($output_dir . $fileName);
                } catch(Exception $e) {
                    $message[] = 'Error loading file "'.pathinfo($output_dir . $fileName,PATHINFO_BASENAME).'": '.$e->getMessage();
                }

                //  Get worksheet dimensions
                $sheet = $objPHPExcel->getSheet(0);


                    $stm->bindParam(':id_sous_projet',$idsp);
                    $stm->bindParam(':id_ressource',$lastInsertedId);
                    $stm->bindValue(':ref_fichier_certification','ref to change');
                    //inject values SQL
                    $stm->execute();
                $id_fichier_certification = $db->lastInsertId();
                    //checked value fichier_certification sur la base
                    /*

                    if($sousProjet->distributionrecette !== NULL) {
                        $fieldslist ="id_modificateur = :id_modificateur,fichier_certification = :fichier_certification,id_sous_projet=:id_sous_projet";

                        $stm_coche_param = $db->prepare("update sous_projet_distribution_recette set $fieldslist where id_sous_projet=:id_sous_projet");
                        $id_modificateur = intval($connectedProfil->profil->id_utilisateur);
                        $stm_coche_param->bindParam(':id_modificateur',$id_modificateur);
                        $stm_coche_param->bindValue(':fichier_certification',1);
                        $stm_coche_param->bindParam(':id_sous_projet',$idsp);
                        $stm_coche_param->execute();

                    }else{
                        $fieldslist ="id_sous_projet,date_insertion,id_createur,fichier_certification";
                        $valueslist =":id_sous_projet,:date_insertion,:id_createur,:fichier_certification";
                        $stm_coche_param = $db->prepare("insert into sous_projet_distribution_recette ($fieldslist) values ($valueslist)");
                        $date_insertion =  date('Y-m-d G:i:s');
                        $stm_coche_param->bindParam(':date_insertion',$date_insertion);
                        $id_createur = intval($connectedProfil->profil->id_utilisateur);
                        $stm_coche_param->bindParam(':id_createur',$id_createur);
                        $stm_coche_param->bindValue(':fichier_certification',1);
                        $stm_coche_param->bindParam(':id_sous_projet',$idsp);
                        $stm_coche_param->execute();

                    }*/

                    $stm_flag_csv = $db->prepare("select * from flag_csv fc,ressource r where fc.id_sous_projet = :id_sous_projet  and r.id_ressource = fc.id_ressource order by date_creation desc limit 1 ");
                    $stm_flag_csv->bindParam(":id_sous_projet",$idsp);
                    $stm_flag_csv->execute();

                    if($stm_flag_csv->rowCount()>0){

                    //envoi de mail quand deux fichiers (fichier_flag & fichier certification )sont upload
                        $sousProjet = NULL;
                        if(isset($idsp) && !empty($idsp)){
                            $sousProjet = SousProjet::find($idsp);
                        }
                        $row = $stm_flag_csv->fetch(PDO::FETCH_OBJ);
                        $file_fichier_certification = __DIR__."/../uploads/fichier_certification/" .$fileName;
                        $file_fichier_flag = __DIR__."/../uploads/flag_csv/" .$row->nom_fichier_disque;
                        $tabfile_to_send =[];
                        $tabfile_to_send[0]['dossier'] = "fichier_certification";
                        $tabfile_to_send[0]['nom_fichier_disque'] = $fileName;

                        $tabfile_to_send[1]['dossier'] = "flag_csv";
                        $tabfile_to_send[1]['nom_fichier_disque'] = $row->nom_fichier_disque;
                        $mailaction_html = get_content_html_mail_by_type($db,$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone,'CDI','Recette',12,'','','','','','','',$sousProjet->projet->id_chef_projet,$sousProjet->id_sous_projet);
                        $mailaction_object = $mailaction_html[1];
                        $mailaction_html =  $mailaction_html[0];

                        $mailaction_cc =return_list_mail_cc_notif($db,"distributionrecette",12);

                        if(isset($drec_netgeo) && intval($drec_netgeo)  > 0){

                            $mailaction_to =get_email_by_id($db,[$drec_netgeo]);


                            if(@MailNotifier::sendMail($mailaction_object,$mailaction_html,$mailaction_to,$tabfile_to_send,$mailaction_cc,$connectedProfil->email_utilisateur)) {
                                $message[] = "Mail envoyé !";
                                $stm_update_flag_csv = $db->prepare("update flag_csv set mail_sent = :mail_sent  where id_flag_fichier = :id_flag_fichier");
                                $stm_update_flag_csv->bindValue(":mail_sent",1);
                                $stm_update_flag_csv->bindParam(":id_flag_fichier",$row->id_flag_fichier);
                                $stm_update_flag_csv->execute();

                                $stm_update_fichier_certification = $db->prepare("update fichier_certification set mail_sent = :mail_sent  where id_fichier_certification = :id_fichier_certification");
                                $stm_update_fichier_certification->bindValue(":mail_sent",1);
                                $stm_update_fichier_certification->bindParam(":id_fichier_certification",$id_fichier_certification);
                                $stm_update_fichier_certification->execute();
                            } else {
                                $message[] = "Mail non envoyé !";
                                $err++;
                            }

                        }else{
                            $message[] = "Mail non envoyé absence du Netgeo !";
                            $err++;

                        }
                    }else{
                    }



                }

        } else  {
            $fileCount = count($_FILES["myfile"]["name"]);
            for ($i = 0; $i < $fileCount; $i++) {

                $fileName = time() . "_" . $_FILES["myfile"]["name"][$i];

                $stm->bindParam(':nom_fichier',$_FILES["myfile"]["name"]);
                $stm->bindParam(':nom_fichier_disque',$fileName);
                $stm->bindParam(':date_creation',date('Y-m-d H:i:s'));

                if($stm->execute()) {
                    $details = array();
                    $details['name'] = $db->lastInsertId()."_".time() . "_" . $_FILES["myfile"]["name"];
                    $details['id'] = $db->lastInsertId();

                    $ret[] = (move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName)?$details:[]);
                }
            }
        }
    }
}
$ret[]=$message;
echo json_encode($ret);