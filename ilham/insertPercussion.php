<?php
include_once 'config.php';

function storePercussion($id_percussion,$photo_nom,$environement,$vue,$releves_metr_profondeur,$releves_metr_largeur,$releves_metr_longeur,$hauteur,$largeur,$db) {
       $result = mysqli_query($db,"INSERT INTO Percussion(`id_percussion`, `photo_nom`, `environement`, `vue`, `releves_metr_profondeur`, `releves_metr_largeur`, `releves_metr_longeur`, `hauteur`, `largeur`, `status`) VALUES ($id_percussion,'$photo_nom','$environement','$vue','$releves_metr_profondeur','$releves_metr_largeur',
'$releves_metr_longeur','$hauteur','$largeur','YES')");
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
$log .= json_last_error_msg() . "\n\n";
$a=array();
$b=array();

for($i=0; $i<count($data) ; $i++) {
    $res = storePercussion($data[$i]->id_percussion,$data[$i]->photo_nom,$data[$i]->environement,$data[$i]->vue,$data[$i]->releves_metr_profondeur,$data[$i]->releves_metr_largeur,$data[$i]->releves_metr_longeur,$data[$i]->hauteur,$data[$i]->largeur,$db);
    //Based on inserttion, create JSON response
    if($res){
        $b["id_percussion"] = $data[$i]->id_percussion;
        $b["status"] = 'yes';
        array_push($a,$b);
    }else{
        $log .= "MYSQLI ERROR : " . mysqli_error($db)."\n\n";
        $b["id_percussion"] = $data[$i]->id_percussion;
        $b["status"] = 'no';
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);
$log .= json_last_error_msg();
file_put_contents("logs.log",$log);
?>
