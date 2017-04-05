<?php
/**
 * file: pageinfos.php
 * User: rabii
 */

extract($_GET);

switch($page)
{

    case "projet":
        return json_decode(json_encode(array("header"=>"Projets",
            "subheader"=>"Liste des projets/sous projets",
            "navigator"=>"<li>projets</li>")));
        break;

    case "pointbloquant":
        return json_decode(json_encode(array("header"=>"Points bloquants",
            "subheader"=>"Liste des points bloquants",
            "navigator"=>"<li>points bloquants</li>")));
        break;

    case "myot":
        return json_decode(json_encode(array("header"=>"Ordres de travail",
            "subheader"=>"",
            "navigator"=>"<li>Ordres de travail</li>")));
        break;

    case "pcip":
        return json_decode(json_encode(array("header"=>"Ordres de travail",
            "subheader"=>"",
            "navigator"=>"<li>Ordres de travail</li>")));
        break;

    case "entreprise":
        return json_decode(json_encode(array("header"=>"Entreprises STT",
            "subheader"=>"Liste des entrprises STT",
            "navigator"=>"<li>entreprises STT</li>")));
        break;

    case "typeequipe":
        return json_decode(json_encode(array("header"=>"Types Equipes STT",
            "subheader"=>"Liste des types equipes STT",
            "navigator"=>"<li>Types</li>")));
        break;

    case "sousprojet":
        $nro = "";
        $btn = "";
        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $idsousprojet)
            )
        );
        if($sousProjet !== NULL) {
            if($sousProjet->projet !== NULL) {
                if($sousProjet->projet->nro !== NULL) {
                    $nro = $sousProjet->projet->nro->lib_nro;
                }

                if($connectedProfil->profil->profil->shortlib == "adm" || $connectedProfil->profil->profil->shortlib == "pov") {

                    if($sousProjet->is_master !== 1) {
                        $btn =
                            <<<ADM
                                    <div class="dropdown" style="display: inline-block;">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="open-sub-project" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    sous projet
                                    <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="open-sub-project">
                                        <li style="font-size:10px;"><a class="list-group-item" href="javascript:void(0)" id="set_as_master" >CTR maitre ?</a></li>
                                    </ul>
                                </div>
ADM;
                    } else {
                        $btn =
                            <<<ADM
                                    <div class="dropdown" style="display: inline-block;">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="open-sub-project" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    sous projet
                                    <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="open-sub-project">
                                        <li style="font-size:10px;"><a class="list-group-item disabled" href="javascript:void(0)">CTR maitre ?</a></li>
                                        <li style="font-size:10px;"><a class="list-group-item" href="javascript:void(0)" id="unset_master_ctr">Annuler Maitre CTR</a></li>
                                    </ul>
                                </div>
ADM;
                    }
                } else {
                    $btn = "";
                }
            }
        }

        return json_decode(json_encode(array("header"=>"Sous projet",
            "subheader"=>"Avancements",
            "navigator"=>"<li><a class=\"link-effect\" href=\"?page=projet\">Projets</a></li><li>".($sousProjet !== NULL ? $nro."-".(strlen($sousProjet->zone)==1?"0".$sousProjet->zone:$sousProjet->zone):"")."</li>".($btn!=""?"<li>".$btn."</li>":""))));
        break;

    case "ot":
        $nro = "";
        $sousProjet = SousProjet::first(
            array('conditions' =>
                array("id_sous_projet = ?", $idsousprojet)
            )
        );
        if($sousProjet !== NULL) {
            if($sousProjet->projet !== NULL) {
                if($sousProjet->projet->nro !== NULL) {
                    $nro = $sousProjet->projet->nro->lib_nro;
                }
            }
        }
        return json_decode(json_encode(array("header"=>"Ordres de travail",
            "subheader"=>"Ordres de travail",
            "navigator"=>"<li><a class=\"link-effect\" href=\"?page=projet\">Projets</a></li><li><a class=\"link-effect\" href=\"?page=sousprojet&idsousprojet=$idsousprojet\">".$nro."-".(strlen($sousProjet->zone)==1?"0".$sousProjet->zone:$sousProjet->zone)."</a></li><li>OT</li>")));
        break;

    case "chambre":
        return json_decode(json_encode(array("header"=>"Chambre",
            "subheader"=>"infos/images/masque",
            "navigator"=>"<li><a class=\"link-effect\" href=\"?page=projet\">Projets</a></li><li><a class=\"link-effect\" href=\"?page=sousprojet&idsousprojet=$idsousprojet\">Sous-projet</a></li><li><a class=\"link-effect\" href=\"?page=ot&idot=$idot&idsousprojet=$idsousprojet\">ordre de travail</a></li><li>chambre</li>")));
        break;

    case "user":
        return json_decode(json_encode(array("header"=>"Utilisateurs",
            "subheader"=>"Liste des utilisateurs r2i",
            "navigator"=>"<li>liste</li>")));
        break;

    case "stt":
        return json_decode(json_encode(array("header"=>"Utilisateurs",
            "subheader"=>"Liste des utilisateurs STT",
            "navigator"=>"<li>liste</li>")));
        break;

    case "planning":
        return json_decode(json_encode(array("header"=>"Planning",
            "subheader"=>"Ordres de travail",
            "navigator"=>"<li>planning</li>")));
        break;

    case "avancement":
        return json_decode(json_encode(array("header"=>"Avancement",
            "subheader"=>"Avancement général",
            "navigator"=>"<li>Avancement</li>")));
        break;

    case "lineaire":
        return json_decode(json_encode(array("header"=>"Suivi Linéaires",
            "subheader"=>"Suivi Linéaires",
            "navigator"=>"<li>Suivi</li>")));
        break;

    case "myotplanning":
        return json_decode(json_encode(array("header"=>"Planning",
            "subheader"=>"(".strtoupper($connectedProfil->profil->entreprise->nom).")",
            "navigator"=>"<li>planning</li>")));
        break;

    case "utilisateur":
        return json_decode(json_encode(array("header"=>"Utilisateurs",
            "subheader"=>"Utilisateurs",
            "navigator"=>"<li>liste</li>")));
        break;

    case "nro":
        return json_decode(json_encode(array("header"=>"NRO",
            "subheader"=>"Nro",
            "navigator"=>"<li>liste</li>")));
        break;

    /*case "nropci":
        return json_decode(json_encode(array("header"=>"NRO/PCI",
            "subheader"=>"Nro/PCI",
            "navigator"=>"<li>liste</li>")));
        break;*/

    case "typeot":
        return json_decode(json_encode(array("header"=>"Types OT",
            "subheader"=>"Types OT",
            "navigator"=>"<li>liste</li>")));
        break;

    case "mailcreation":
        return json_decode(json_encode(array("header"=>"Utilisateurs",
            "subheader"=>"Liste d'envoi selon type",
            "navigator"=>"<li>liste</li>")));
        break;

    case "wiki":
        return json_decode(json_encode(array("header"=>"Wiki",
        	"subheader"=>"Liste des sujets",
        	"navigator"=>"<li>liste</li>")));
        break;

    default:
        return json_decode(json_encode(array("header"=>"header",
            "subheader"=>"subheader",
            "navigator"=>"<li>navigator</li>")));
        break;


}

?>