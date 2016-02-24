<?php
include_once 'config.php';
function storeManchon($id_manchon,$photo_nom,$environment,$vue,$releves_metr_profondeur,$releves_metr_largeur,$releves_metr_longeur,$hauteur,$largeur,$db) {
  $result = mysqli_query($db,"INSERT INTO manchon(`id_manchon`,`photo_nom`,`environment`,`vue`,`releves_metr_profondeur`,`releves_metr_largeur`,`releves_metr_longeur`,`hauteur`,`largeur`, `status`) VALUES ($id_manchon,'$photo_nom','$environment','$vue','$releves_metr_profondeur','$releves_metr_largeur',
'$releves_metr_longeur','$hauteur','$largeur','YES')");
        if ($result) {
            return true;
        }//if
        else {
            if( mysql_errno() == 1062) 
             {
              return true;
            } //if
else {
              
      return false;
            }//else
	}//else
}//storeOT

$log = "";

$json = $_POST["OtJSON"];
$log = "json : ".$json."\n\n";

if (get_magic_quotes_gpc()){
	$json = stripslashes($json);
}
$data = json_decode(utf8_encode($json));
$log .= json_last_error_msg() . "\n\n";
$a=array();
$b=array();

for($i=0; $i<count($data) ; $i++) {
$res = storeManchon($data[$i]->id_manchon,$data[$i]->photo_nom,$data[$i]->environment,$data[$i]->vue,$data[$i]->releves_metr_profondeur,$data[$i]->releves_metr_largeur,$data[$i]->releves_metr_longeur,$data[$i]->hauteur,$data[$i]->largeur,$db);
    //Based on inserttion, create JSON response
    if($res){
        $b["id_manchon"] = $data[$i]->id_manchon;
        $b["status"] = 'yes';
        array_push($a,$b);
    }else{
	$log .= "MYSQLI ERROR : " . mysqli_error($db)."\n\n";
        $b["id_manchon"] = $data[$i]->id_manchon;
        $b["status"] = 'no';
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
$log .= json_last_error_msg();
file_put_contents("logs.log",$log);
?>
