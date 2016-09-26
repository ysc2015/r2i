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

    case "entreprise":
        return json_decode(json_encode(array("header"=>"Entreprises STT",
            "subheader"=>"Liste des entrprises STT",
            "navigator"=>"<li>entreprises STT</li>")));
        break;

    case "sousprojet":
        return json_decode(json_encode(array("header"=>"Sous projet",
            "subheader"=>"Avancements",
            "navigator"=>"<li><a class=\"link-effect\" href=\"?page=projet\">Projets</a></li><li>Avancements</li>")));
        break;

    case "ot":
        return json_decode(json_encode(array("header"=>"Ordre de travail",
            "subheader"=>"infos/chambres/synoptique/cp",
            "navigator"=>"<li><a class=\"link-effect\" href=\"?page=projet\">Projets</a></li><li><a class=\"link-effect\" href=\"?page=sousprojet&idsousprojet=$idsousprojet\">Sous-projet</a></li><li>OT</li>")));
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

    default:
        return json_decode(json_encode(array("header"=>"header",
            "subheader"=>"subheader",
            "navigator"=>"<li>navigator</li>")));
        break;


}

?>
