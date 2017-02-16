<?php

// This PHP script demonstrates how to generate XML grid data "on-the-fly"
// To achieve this, here we use our simple "PHP wrapper class" EditableGrid.php, but this is not mandatory.
// The only thing is that the generated XML must have the expected structure .
// Here we get the data from a CSV file; in real life, these data would probably come from a database.


extract($_GET);


$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
$stm->execute();
$row = $stm->fetch(PDO::FETCH_ASSOC);
$i = 0;
$html = "";
$ot = OrdreDeTravail::first(
    array('conditions' =>
        array("id_ordre_de_travail = ?", $row['id_ordre_de_travail'])
    )
);
$select_entreprise = '<select class="form-control" id="ot_entreprise" name="ot_entreprise" style="width: 100%;">
                                            <option value="0" selected="">Tous</option>';

                                            $results = EntrepriseSTT::all();
                                            foreach($results as $result) {
                                                $select_entreprise .=  '<option value="$result->id_entreprise" '.
  ($ot->id_entreprise==$result->id_entreprise ?"selected": "").'>'.$result->nom.'</option>';
                                            }

$select_entreprise .=' </select>';
$html .="<form action='#' name='detail_info_devis' id='detail_info_devis'> <table width='100%'>
<tr>
<td colspan='3' ><div id='message_devis'></div></td>
</tr>
<tr>
<td width='30%'>Coordonnées Entreprise:</td>
<td colspan='2'>".$select_entreprise."</td>
</tr>
 <tr>
<td>Contact :</td>
<td><input  class='form-control' type='text' name='contactdevis' /></td>
</tr>
<tr>
<td>Code Site :</td>
<td><input  class='form-control' type='text' name='codesitedevis' id='codesitedevis' /></td>
</tr>
<tr>
<td>Ref Devis :</td>
<td><input  class='form-control' type='text' name='refdevis' id='refdevis' /></td>
</tr>
<tr>
<td>Date Devis :</td>
<td><input class='form-control' type='date' id='datedevis' name='datedevis' /></td>
</tr>
<tr>
<td>Date Livraison :</td>
<td><input  class='form-control' type='date' name='datelivraisondevis' id='datelivraisondevis'  /></td>
</tr>
<tr>
<td colspan='2' align='center' >Synthèse Devis </td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
</tr>
<tr>
 <td colspan='3'>
 <table border='1' class='table  table-bordered  ' width='100%'>
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
 <table border='1' class='table  table-bordered  ' width='100%'>
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
<tr>
<td></td>
<td></td>
<td><input type='button' name='save_info_devis' id='save_info_devis' class='btn btn-success btn-sm' value='Enregistrer' /> </td>
</tr>
 
</table></form>";

echo json_encode($html);