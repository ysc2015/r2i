<?php
include_once 'config.php';
 
$result = mysqli_query($db,"SELECT `id_OT`, `nom_OT`, `longitude`, `latitude`, `si_valide` FROM `OT` WHERE STATUS='no'");
 while($row=mysqli_fetch_assoc($result)){
foreach($row as $k => $v)
		$row[$k] = utf8_encode($v);
 $output[]=$row;
 }
 
 print(json_encode($output));
 
 mysqli_close($db);
       
?>
