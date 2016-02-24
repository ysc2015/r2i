<?php
include_once 'config.php';

function storeOT($id_OT,$nom_OT,$longitude,$latitude,$si_valide,$db) {
       $result = mysqli_query($db,"INSERT INTO OT(id_OT,nom_OT,longitude,latitude,si_valide,status) VALUES ($id_OT,'$nom_OT','$longitude','$latitude','$si_valide','YES')");
        if ($result) {
            return true;
        } else {
            if( mysql_errno() == 1062) {
                // Duplicate key 
                return true;
            } else {
                // For other errors
                return false;
            }
	}
}
 

$json = $_POST["OtJSON"];

if (get_magic_quotes_gpc()){
	$json = stripslashes($json);
}

$data = json_decode(utf8_encode($json));

$a=array();
$b=array();

for($i=0; $i<count($data) ; $i++) {
    $res = storeOT($data[$i]->id_OT,$data[$i]->nom_OT,$data[$i]->longitude,$data[$i]->latitude,$data[$i]->si_valide,$db);
    //Based on inserttion, create JSON response
    if($res){
        $b["id_OT"] = $data[$i]->id_OT;
        $b["status"] = 'yes';
        array_push($a,$b);
    }else{
        $b["id_OT"] = $data[$i]->id_OT;
        $b["status"] = 'no';
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
?>
