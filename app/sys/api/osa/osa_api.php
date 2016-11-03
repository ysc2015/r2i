<?php

class OsaApi
{
    public static function appel($postBody, $action){
        $curl = curl_init();
        $token = "NjQ1YjM1ZTAzMDVmMTg4YzBjMWMzNTAxY2FmZGI5OTM6Ojk3MGJkNjI3ZjQxNWUwYTEyNzIxMGQyY2VjZjIzMTFm";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://sd-83414.dedibox.fr/osa/rest/auth/$token&param=$action",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postBody . "&post_auth=true&rest=api",
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

    public static function tache(){
        $res = self::appel("r2i_list_tache=true&id=4", "tache.php");
        if($res === FALSE){
            ///
        }else{
            /// decode reponse puis traitement
            echo $res;
        }
    }
}

OsaApi::tache();


