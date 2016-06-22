<?php
/**
 * file: pageinfos.php
 * User: rabii
 */

switch($page)
{

    case "projet":
        return json_decode(json_encode(array("header"=>"Projets",
            "subheader"=>"Liste des projets",
            "navigator"=>"<li>projets</li>")));
        break;

    case "sousprojet":
        return json_decode(json_encode(array("header"=>"Sous projet",
            "subheader"=>"Avancements",
            "navigator"=>"<li><a class=\"link-effect\" href=\"?page=projet\">Projets</a></li><li>Avancements</li>")));
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
