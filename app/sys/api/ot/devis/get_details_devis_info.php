<?php

// This PHP script demonstrates how to generate XML grid data "on-the-fly"
// To achieve this, here we use our simple "PHP wrapper class" EditableGrid.php, but this is not mandatory.
// The only thing is that the generated XML must have the expected structure .
// Here we get the data from a CSV file; in real life, these data would probably come from a database.


extract($_GET);


$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
$i = 0;
$html = "";

$html .="<table width='100%'>
<tr>
<td>Coordonnées Entreprise:</td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td>Société :</td>
</tr>

<tr>
<td>Contact :</td>
<td></td>
<td></td>
</tr>
<tr>
<td>Code Site :</td>
<td></td>
<td></td>
</tr>
<tr>
<td>Ref Devis :</td>
<td></td>
<td></td>
</tr>
<tr>
<td>Date Devis :</td>
<td></td>
<td></td>
</tr>
<tr>
<td>Date Livraison :</td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan='2' align='center'>Synthèse Devis</td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
</tr>
<tr>
 <td colspan='3'>
 <table border='1' width='100%'>
 <tr>
<td colspan='3' align='center' bgcolor='red'>Lot 7- Etudes et Travaux FO</td>
</tr>
<tr>
 <td width='30%'>&nbsp;</td>
 <td width='40%'>Etudes</td>
 <td width='30%'>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>Tirages</td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>Raccordements</td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>Travaux en immeuble</td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td class='td-total'>Total</td>
 <td>&nbsp;</td>
</tr>
</table>
 
</td>
</tr>
<tr>
 <td>&nbsp;</td>
</tr>
<tr>
 <td colspan='3'>
 <table border='1' width='100%'>
 <tr>
<td colspan='3' align='center' bgcolor='aqua'>Lot 2 - Travaux GC</td>
 <td></td>
</tr>
<tr>
 <td width='30%'>&nbsp;</td>
 <td width='40%'>Etudes et Réalisation Tranchées</td>
 <td width='30%'>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>Etudes et Travaux sur Chambres</td>
 <td>&nbsp;</td>
</tr>
<tr>
 <td>&nbsp;</td>
 <td>Etudes et Travaux Divers GC</td>
 <td>&nbsp;</td>
</tr> 
<tr>
 <td>&nbsp;</td>
 <td class='td-total'>Total</td>
 <td>&nbsp;</td>
</tr>
</table>
 
</td>
</tr>

 
</table>";

echo json_encode($html);