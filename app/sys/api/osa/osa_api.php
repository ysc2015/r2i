<?php

class OsaApi
{

    public static function appel($postBody, $action_){
        $curl = curl_init();

        $token_ = $_GET['token'];
        curl_setopt_array($curl, array(
            //http://sd-83414.dedibox.fr
            CURLOPT_URL => OSA_SERVER."osa/api/auth.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postBody . "&token=$token_&param=$action_&post_auth=true&rest=api",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic cnJhaG1vdW5pOktlZXNoaWU3",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 70c07d1c-3361-8440-848e-8f006d8f279a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            return FALSE;
        } else {
            return $response;
        }
    }

    public static function tache($db){
        extract($_GET);
        $res = self::appel("r2i_list_tache=true&id=".$idprojet, "tache.php");

        if($res === FALSE){
            ///
        }else{
            //print_r($res);
            $resultat = json_decode($res) ;


            //var_dump($resultat);

            $tabencours= [];
            $tabtermine= [];
            $i=0;
            $encoure = 0;
            $termine = 0;
            $pasdereponse = '';
             if(!is_null($resultat) ){
                 if(count($resultat->ENCOURS)>0){

                     $bddresultat = $db->query("SELECT id_etape,count(*) FROM `sous_projet_taches_osa` where id_osa IN (".implode(',', array_values($resultat->ENCOURS)) .") and id_etape = '".$idetape."' and type_etape = '".$typeetape."'");

                     while($resultatconteur= $bddresultat->fetch()){

                         $tabencours [$i]= [$resultatconteur[0],$resultatconteur[1]];
                         $encoure = $resultatconteur[1] ;
                     }
                 }

                 if(count($resultat->TERMINE)>0) {
                     $bddresultat = $db->query("SELECT id_etape,count(*) FROM `sous_projet_taches_osa` where id_osa IN (" . implode(',', array_values($resultat->TERMINE)) . ")  and id_etape = '" . $idetape . "' and  type_etape = '" . $typeetape . "'");
                     while ($resultatconteur = $bddresultat->fetch()) {

                         $tabtermine [$i] = [$resultatconteur[0], $resultatconteur[1]];
                         $termine = $resultatconteur[1];


                     }
                 }
                 $pasdereponse = '('. $encoure.'/'.($termine+$encoure).')';
             }else{
                 $pasdereponse = '<span style="color: red">Problème de liaison OSA</span>';
             }

            echo $pasdereponse ;
        }
    }



    public static function tache_liste($db){
        extract($_GET);
        $res = self::appel("r2i_all=&r2i_list_tache=true&id=".$idprojet, "tache.php");

        if($res === FALSE){
            ///
        }else{
            var_dump($res);
            $resultat = json_decode($res) ;



            $tabeidtache = [];

            foreach ($resultat as $tache){
                array_push($tabeidtache,$tache[0]);
            }



            $tablistetachereturn= [];
            $i=0;



            if(count($tabeidtache) >0){
                $bddresultat = $db->query("SELECT id_osa FROM `sous_projet_taches_osa` where id_osa IN (".implode(',', $tabeidtache) .") and id_etape = '".$idetape."' and type_etape = '".$typeetape."'");

                while($resultatconteur= $bddresultat->fetch()){

                    foreach ($resultat as $tache){
                        if($tache[0]==$resultatconteur[0]){
                            //array_push($tablistetachereturn,[$tache[0],$tache[1],$tache[2],'de',$idprojet]);
                            array_push($tablistetachereturn,[$tache[0],$tache[1],$tache[2]]);
                        }
                    }


                }
            }
            //print_r($tablistetachereturn);
           echo json_encode($tablistetachereturn) ;




        }
    }



}
if(isset($_GET['methode']) )
    OsaApi::$_GET['methode']($db);
else
    OsaApi::tache($db);



