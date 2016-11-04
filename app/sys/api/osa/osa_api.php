<?php

class OsaApi
{
    public static function appel($postBody, $action_){
        $curl = curl_init();
        $token_ = "NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm";
        curl_setopt_array($curl, array(
            //http://sd-83414.dedibox.fr
            CURLOPT_URL => "http://sd-83414.dedibox.fr/osa/api/auth.php",
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
        $res = self::appel("r2i_list_tache=true&id=26", "tache.php");
        extract($_GET);
        if($res === FALSE){
            ///
        }else{ 
             $resultat = json_decode($res) ;


print_r($resultat);

            $tabencours= [];
            $tabtermine= [];
            $i=0;
            $encoure = 0;
            $termine = 0;
             $bddresultat = $db->query("SELECT id_etape,count(*) FROM `sous_projet_taches_osa` where id_osa IN (".implode(',', array_values($resultat->ENCOURS)) .") and id_etape = '".$idetape."' and type_etape = '".$typeetape."'");

            while($resultatconteur= $bddresultat->fetch()){
                  //echo $resultatconteur[1];
                $tabencours [$i]= [$resultatconteur[0],$resultatconteur[1]];
                $encoure = $resultatconteur[1] ;
            }

            $bddresultat = $db->query("SELECT id_etape,count(*) FROM `sous_projet_taches_osa` where id_osa IN (".implode(',', array_values($resultat->TERMINE)) .")  and id_etape = '".$idetape."' and  type_etape = '".$typeetape."'");
            while($resultatconteur= $bddresultat->fetch()){
                 //echo $resultatconteur[1];
                $tabtermine [$i]= [$resultatconteur[0],$resultatconteur[1]];
                $termine = $resultatconteur[1];


            }
            echo $encoure.'#'.$termine;
        }
    }
}

OsaApi::tache($db);


