<?php
/**
 * file: upload_recette_chambre_file.php
 * User: rabii
 */

$output_dir = __DIR__."/../../uploads/flag_csv/";
extract($_POST);

$excelCfg = array(
    "highestColumn" => 'G'
);

$ret = array();

$err = 0;
$message = array();
$stm = $db->prepare("insert into ressource (id_sous_projet,type_objet,nom_fichier,nom_fichier_disque,dossier,date_creation) values (:id_sous_projet,'distribution_recette_flag_csv',:nom_fichier,:nom_fichier_disque,'flag_csv',:date_creation)");

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
                $stm = $db->prepare("insert into flag_csv (id_sous_projet,id_ressource,type_entree,ref_flag_csv) values (:id_sous_projet,:id_ressource,'distribution_recette_flag_csv',:ref_flag_csv)");
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
                    $stm->bindValue(':ref_flag_csv','ref to change');
                    //inject values SQL
                    $stm->execute();
                    $id_flag_csv = $db->lastInsertId();
                    //checked value fichier_flag sur la base
                   /*
                    $sousProjet = NULL;
                    if(isset($idsp) && !empty($idsp)){
                        $sousProjet = SousProjet::find($idsp);
                    }
                    if($sousProjet->distributionrecette !== NULL) {
                        $fieldslist ="id_modificateur = :id_modificateur,fichier_flag = :fichier_flag,id_sous_projet=:id_sous_projet";

                        $stm_coche_param = $db->prepare("update sous_projet_distribution_recette set $fieldslist where id_sous_projet=:id_sous_projet");
                        $id_modificateur = intval($connectedProfil->profil->id_utilisateur);
                        $stm_coche_param->bindParam(':id_modificateur',$id_modificateur);
                        $stm_coche_param->bindValue(':fichier_flag',1);
                        $stm_coche_param->bindParam(':id_sous_projet',$idsp);
                        $stm_coche_param->execute();

                    }else{
                        $fieldslist ="id_sous_projet,date_insertion,id_createur,fichier_flag";
                        $valueslist =":id_sous_projet,:date_insertion,:id_createur,:fichier_flag";
                        $stm_coche_param = $db->prepare("insert into sous_projet_distribution_recette ($fieldslist) values ($valueslist)");
                        $date_insertion =  date('Y-m-d G:i:s');
                        $stm_coche_param->bindParam(':date_insertion',$date_insertion);
                        $id_createur = intval($connectedProfil->profil->id_utilisateur);
                        $stm_coche_param->bindParam(':id_createur',$id_createur);
                        $stm_coche_param->bindValue(':fichier_flag',1);
                        $stm_coche_param->bindParam(':id_sous_projet',$idsp);
                        $stm_coche_param->execute();

                    }
                    */
                $stm_fichier_certification = $db->prepare("select * from fichier_certification fc,ressource r where fc.id_sous_projet = :id_sous_projet  and r.id_ressource = fc.id_ressource order by date_creation desc limit 1 ");
                $stm_fichier_certification->bindParam(":id_sous_projet",$idsp);
                $stm_fichier_certification->execute();

                if($stm_fichier_certification->rowCount()>0){

                    //envoi de mail quand deux fichiers (fichier_flag & fichier certification )sont upload
                    $sousProjet = NULL;
                    if(isset($idsp) && !empty($idsp)){
                        $sousProjet = SousProjet::find($idsp);
                    }
                    $row = $stm_fichier_certification->fetch(PDO::FETCH_OBJ);
                    $file_fichier_certification = __DIR__."/../uploads/fichier_certification/" .$row->nom_fichier_disque;
                    $file_fichier_flag = __DIR__."/../uploads/distribution_recette_flag_csv/" .$fileName;
                    $tabfile_to_send =[];
                    $tabfile_to_send[0]['dossier'] = "fichier_certification";
                    $tabfile_to_send[0]['nom_fichier_disque'] = $row->nom_fichier_disque;

                    $tabfile_to_send[1]['dossier'] = "distribution_recette_flag_csv";
                    $tabfile_to_send[1]['nom_fichier_disque'] = $fileName;

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
                            $stm_update_flag_csv->bindParam(":id_flag_fichier",$id_flag_csv);
                            $stm_update_flag_csv->execute();

                            $stm_update_fichier_certification = $db->prepare("update fichier_certification set mail_sent = :mail_sent  where id_fichier_certification = :id_fichier_certification");
                            $stm_update_fichier_certification->bindValue(":mail_sent",1);
                            $stm_update_fichier_certification->bindParam(":id_fichier_certification",$row->id_fichier_certification);
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