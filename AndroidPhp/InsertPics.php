<?php
/* ilham Amara* 2016*/
ini_set('display_errors', 1);
include_once 'config.php';

function storePics(
    $room_pic_id,$room_id,$latitude,
    $longitude,$altitude,$accuracy,
    $altitudeAccuracy,$heading,$speed,
     $timestamp,$imageTabURI,$imageSrvURL,$flag,$db) {
    $result = mysqli_query($db,"INSERT INTO room_pics2(`room_pic_id`,`room_id`,`latitude`,`longitude`,`altitude`,`accuracy`,`altitudeAccuracy`,`heading`,`speed`, `timestamp`,`imageTabURI`,`imageSrvURL`,`flag`) VALUES 
($room_pic_id,$room_id,'$latitude',
'$longitude','$altitude','$accuracy',
'$altitudeAccuracy','$heading','$speed',
'$timestamp','$imageTabURI','$imageSrvURL','YES')");
        if ($result) {
            return true;
        } else {
            if(mysql_errno() == 1062) {
              return true;
            } else {
              return false;
            }
	   }
}

$json = $_POST["OtJSON"];
if (get_magic_quotes_gpc()) {
    $json = stripslashes($json);
}
$data = json_decode(utf8_encode($json));
$a=array();
$b=array();
for($i=0; $i<count($data) ; $i++) {
    $res = storePics($data[$i]->room_pic_id, $data[$i]->room_id, $data[$i]->latitude, $data[$i]->longitude, $data[$i]->altitude,
        $data[$i]->accuracy, $data[$i]->altitudeAccuracy,$data[$i]->heading,$data[$i]->speed, $data[$i]->timestamp, $data[$i]->imageTabURI,
        $data[$i]->imageSrvURL, $data[$i]->flag, $db);
    if($res) {
        $b["room_pic_id"] = $data[$i]->room_pic_id;
        $b["flag"] = 'yes';
	$b["time"] = $data[$i]->timestamp;
        array_push($a,$b);
    } else {
        $b["room_pic_id"] = $data[$i]->room_pic_id;
        $b["flag"] = 'no';
	$b["time"] = $data[$i]->timestamp;
        array_push($a,$b);
    }
}
echo json_encode($a);
var_dump(json_last_error(), json_last_error_msg());
?>
