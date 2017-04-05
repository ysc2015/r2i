<?php
/**
 * Created by PhpStorm.
 * User: rabiirahmouni
 * Date: 04/04/2017
 * Time: 10:50
 */

extract($_POST);

$tentree = "";

$err = 0;

$message = array();

$sousProjet = NULL;

if(isset($idsp) && !empty($idsp) && isset($iddevis) && !empty($iddevis) && isset($idtot) && !empty($idtot)) {

    $sousProjet = SousProjet::first(
        array('conditions' =>
            array("id_sous_projet = ?", $idsp)
        )
    );

    if($sousProjet !== NULL) {

        $EFO_06_03_qt = 0;
        $EFO_06_06_qt = 0;
        $TFO_01_01_qt = 0;
        $TFO_01_02_qt = 0;
        $TFO_02_01_qt = 0;
        $TFO_02_02_qt = 0;
        $TFO_02_03_qt = 0;
        $TFO_03_01_qt = 0;
        $TFO_03_02_qt = 0;
        $TFO_04_01_qt = 0;

        switch($idtot) {

            case "1" :
                $tentree = "transportaiguillage";
                break;
            case "2" :
                $tentree = "transporttirage";
                break;
            case "3" :
                //$tentree = "transporttirage";
                $tentree = "transportraccordement";
                break;
            case "4" :
                $tentree = "transporttirage";
                //$tentree = "transportraccordement";
                break;
            case "5" :
                $tentree = "distributionaiguillage";
                break;
            case "6" :
                $tentree = "distributiontirage";
                break;
            case "7" :
                //$tentree = "distributiontirage";
                $tentree = "distributionraccordement";
                break;
            case "8" :
                $tentree = "distributiontirage";
                //$tentree = "distributionraccordement";
                break;
            default :
                break;
        }

        if($tentree !== "" ) {

            switch($tentree) {

                case "transportaiguillage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $EFO_06_03_qt = $sousProjet->{$tentree}->lineaire5 + $sousProjet->{$tentree}->lineaire6 + $sousProjet->{$tentree}->lineaire7 + $sousProjet->{$tentree}->lineaire8;
                        $TFO_01_01_qt = $sousProjet->{$tentree}->lineaire1 + $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3 + $sousProjet->{$tentree}->lineaire4;
                        $TFO_01_02_qt = "";//nbr chambre
                    }
                    break;
                case "distributionaiguillage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $EFO_06_03_qt = $sousProjet->{$tentree}->lineaire5 + $sousProjet->{$tentree}->lineaire6 + $sousProjet->{$tentree}->lineaire7 + $sousProjet->{$tentree}->lineaire8;
                        $TFO_01_01_qt = $sousProjet->{$tentree}->lineaire1 + $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3 + $sousProjet->{$tentree}->lineaire4;
                        $TFO_01_02_qt = "";//nbr chambre
                    }
                    break;

                case "transporttirage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $EFO_06_06_qt = $sousProjet->{$tentree}->lineaire12 / 2;
                        $TFO_02_01_qt = $sousProjet->{$tentree}->lineaire9 + $sousProjet->{$tentree}->lineaire10 + $sousProjet->{$tentree}->lineaire11;
                        $TFO_02_03_qt = $sousProjet->{$tentree}->lineaire12;
                        $TFO_03_01_qt = $sousProjet->{$tentree}->lineaire4;//cables
                        $TFO_03_02_qt = $sousProjet->{$tentree}->lineaire1 + $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3;
                        $TFO_04_01_qt = "";//nbrchambre * 3
                    }
                    break;
                case "distributiontirage" :
                    if($sousProjet->{$tentree} !== NULL) {
                        $EFO_06_06_qt = $sousProjet->{$tentree}->lineaire12 / 2;
                        $TFO_02_01_qt = $sousProjet->{$tentree}->lineaire9 + $sousProjet->{$tentree}->lineaire10;
                        $TFO_02_02_qt = $sousProjet->{$tentree}->lineaire11;
                        $TFO_02_03_qt = $sousProjet->{$tentree}->lineaire12;
                        $TFO_03_01_qt = $sousProjet->{$tentree}->lineaire2 + $sousProjet->{$tentree}->lineaire3 + $sousProjet->{$tentree}->lineaire4;
                        $TFO_03_02_qt = $sousProjet->{$tentree}->lineaire1;
                        $TFO_04_01_qt = "";//nbr chambre * 2
                    }
                    break;
                default :
                    break;
            }
        }

        $update_statment = $db->prepare("UPDATE detaildevis SET EFO_06_03_qt=:EFO_06_03_qt,EFO_06_06_qt=:EFO_06_06_qt,TFO_01_01_qt=:TFO_01_01_qt,TFO_01_02_qt=:TFO_01_02_qt,TFO_02_01_qt=:TFO_02_01_qt,TFO_02_02_qt=:TFO_02_02_qt,TFO_02_03_qt=:TFO_02_03_qt,TFO_03_01_qt=:TFO_03_01_qt,TFO_03_02_qt=:TFO_03_02_qt,TFO_04_01_qt=:TFO_04_01_qt WHERE iddevis=:iddevis");

        $update_statment->bindParam(':EFO_06_03_qt',$EFO_06_03_qt);
        $update_statment->bindParam(':EFO_06_06_qt',$EFO_06_06_qt);
        $update_statment->bindParam(':TFO_01_01_qt',$TFO_01_01_qt);
        $update_statment->bindParam(':TFO_01_02_qt',$TFO_01_02_qt);
        $update_statment->bindParam(':TFO_02_01_qt',$TFO_02_01_qt);
        $update_statment->bindParam(':TFO_02_02_qt',$TFO_02_02_qt);
        $update_statment->bindParam(':TFO_02_03_qt',$TFO_02_03_qt);
        $update_statment->bindParam(':TFO_03_01_qt',$TFO_03_01_qt);
        $update_statment->bindParam(':TFO_03_02_qt',$TFO_03_02_qt);
        $update_statment->bindParam(':TFO_04_01_qt',$TFO_04_01_qt);

        $update_statment->bindParam(':iddevis',$iddevis);

        if($update_statment->execute()) {

            $message [] = "traitement linéaires ok !";

        } else {

            $err ++;
            $message [] = $update_statment->errorInfo();

        }
    } else {

        $err ++;
        $message [] = "erreur récupération sous projet source ou inéxistant !";
    }
} else {

    $err++;
    $message[] = "erreur traitement données linéaires !";
}


echo json_encode(array("error" => $err , "message" => $message));