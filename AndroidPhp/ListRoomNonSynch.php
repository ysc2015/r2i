<?php
include_once 'config.php';
 
$result = mysqli_query($db,"SELECT * FROM `rooms`");
 while($row=mysqli_fetch_assoc($result)){
foreach($row as $k => $v)
		$row[$k] = utf8_encode($v);
 $output[]=$row;
 }
 
 print(json_encode($output));
 
 mysqli_close($db);
       
?>
