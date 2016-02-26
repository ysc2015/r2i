<?php
include_once 'config.php';
function storePics($room_pic_id,$room_id,$latitude,$longitude,$altitude,$accuracy,$altitudeAccuracy,$heading,$speed,$timestamp,$imageTabURI,$imageSrvURL,$flag,$db) 
{
$result = mysqli_query($db,"INSERT INTO room_pics2  (`room_pic_id`,`room_id`,`latitude`,`longitude`,`altitude`,`accuracy`,`altitudeAccuracy`,`heading`,`speed`, `timestamp`,`imageTabURI`,`imageSrvURL`,`flag`) VALUES 
($room_pic_id,$room_id,'$latitude','$longitude','$altitude','$accuracy','$altitudeAccuracy','$heading','$speed','$timestamp','$imageTabURI','$imageSrvURL','YES')");
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
$data = json_decode(utf8_encode($json));
$a=array();
$b=array();
for($i=0; $i<count($data) ; $i++) {
$res = storePics($data[$i]->room_pic_id,$data[$i]->room_id,$data[$i]->latitude,$data[$i]->longitude,$data[$i]->altitude,$data[$i]->accuracy,$data[$i]->altitudeAccuracy,$data[$i]->speed,$data[$i]->timestamp,,$data[$i]->imageTabURI,$data[$i]->imageSrvURL,$data[$i]->flag,$db);
    //Based on inserttion, create JSON response
    if($res){
        $b["room_pic_id"] = $data[$i]->room_pic_id;
        $b["flag"] = 'yes';
        array_push($a,$b);
    }else{
	$log .= "MYSQLI ERROR : " . mysqli_error($db)."\n\n";
        $b["room_pic_id"] = $data[$i]->room_pic_id;
        $b["flag"] = 'no';
        array_push($a,$b);
    }
}
//Post JSON response back to Android Application
echo json_encode($a);


?>
