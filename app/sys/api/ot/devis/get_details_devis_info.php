<?php

// This PHP script demonstrates how to generate XML grid data "on-the-fly"
// To achieve this, here we use our simple "PHP wrapper class" EditableGrid.php, but this is not mandatory.
// The only thing is that the generated XML must have the expected structure .
// Here we get the data from a CSV file; in real life, these data would probably come from a database.


extract($_GET);


$stm = $db->prepare("select * from detaildevis where detaildevis.iddevis =$iddevis LIMIT 1");
$stm->execute();
$row = $stm->fetch(PDO::FETCH_OBJ);
$i = 0;
$html = "";
$ot = OrdreDeTravail::first(
    array('conditions' =>
        array("id_ordre_de_travail = ?", $row->id_ordre_de_travail)
    )
);
$sousProjet = NULL;
$stm = NULL;

if(isset($ot) && !empty($ot)){
    $sousProjet = SousProjet::find($ot->id_sous_projet);
}

$etat_devis = EtatDevis::all();

$contact_entreprise = "";
$select_entreprise = "";

                                            $results = EntrepriseSTT::all();
                                            foreach($results as $result) {
                                                if($ot->id_entreprise==$result->id_entreprise )$contact_entreprise = $result->contact_nom.' '.$result->contact_prenom;
                                                $select_entreprise =  $result->nom;
                                            }

$sel_etat_devis_html = "";

foreach($etat_devis as $etat_devi) {
    if($row->etat_devis==$etat_devi->id_etat_devis )
    $sel_etat_devis_html .=  $etat_devi->lib_etat_devis ;


}

$html .="<form action='#' name='detail_info_devis' id='detail_info_devis'> <table width='100%'>
<tr>
<td colspan='3' ><div id='message_devis'></div></td>
</tr>
<tr>
<td width='30%'>Coordonnées Entreprise:</td>
<td  align='center'><h4>".$select_entreprise."</h4></td>
</tr>
 <tr>
<td>Contact :</td>
<td><input  class='form-control' disabled  type='text' name='contactdevis' value='".$contact_entreprise."' /></td>
</tr>
<tr>
<td>Code Site :</td>
<td><input  class='form-control' disabled type='text' name='codesitedevis' id='codesitedevis' value='".$sousProjet->projet->nro->lib_nro."-".$sousProjet->zone."' /></td>
</tr>
<tr>
<td>Ref Devis :</td>
<td><input  class='form-control' type='text' disabled name='refdevis' id='refdevis' value='".$row->ref_devis."' /></td>
</tr>
<tr>
<td>Date Devis :</td>
<td><input class='form-control' type='date' disabled id='datedevis' name='datedevis' value='".$row->date_devis."' /></td>
</tr>
<tr>
<td>Date Livraison :</td>
<td><input  class='form-control' type='date' disabled name='datelivraisondevis' id='datelivraisondevis' value='".$row->date_livraison."'  /></td>
</tr>
<tr>
<td>Etat :</td>
<td><strong>".$sel_etat_devis_html."</strong>
</td>
</tr>
<tr>
<td colspan='2' align='center' >&nbsp; </td>
 <td></td>
</tr>
<tr>
<td colspan='2' align='center' ><h3>Synthèse Devis</h3> </td>
 <td></td>
</tr>
<tr>
 <td>&nbsp;</td>
</tr>
<tr>
 <td colspan='3'>
 <table border='1' class='table  table-bordered  ' width='100%'>
 <tr>
<td colspan='3' align='center' bgcolor='#f45f42'>Lot 7- Etudes et Travaux FO</td>
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