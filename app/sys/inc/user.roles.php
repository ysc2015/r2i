<?php
/**
 * file: utilisateur.roles.php
 * User: rabii
 */


class baseUser {
    public 	$profil = NULL;

    private $access_denied_message =
        <<<ADM
                    <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <!-- Error Titles -->
                    <h1 class="font-s32 font-w150 text-danger animated bounceInDown">Accés Intérdit</h1>
                    <h2 class="h3 font-w300 push-50 animated fadeInUp">Vous n'avez pas le droit d'accéder à cette page..</h2>
                    <!-- END Error Titles -->
                </div>
            </div>
ADM;

    private $ressource_access_denied_message =
        <<<ADM
                        <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <!-- Error Titles -->
                    <h1 class="font-s32 font-w150 text-danger animated bounceInDown">Error</h1>
                    <h2 class="h3 font-w300 push-50 animated fadeInUp">Vous n'étes pas affectée à cette ressource..</h2>
                    <!-- END Error Titles -->
                </div>
            </div>
ADM;

    private $ressource_notfound_message =
        <<<ADM
                        <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <!-- Error Titles -->
                    <h1 class="font-s32 font-w150 text-danger animated bounceInDown">Accés Intérdit</h1>
                    <h2 class="h3 font-w300 push-50 animated fadeInUp">Ressource introuvable..</h2>
                    <!-- END Error Titles -->
                </div>
            </div>
ADM;

    function __construct($p) {
        $this->profil = $p;
    }

    function __get($name) {
        return $this->profil->$name;
    }

    function ressourceAccessDenied() {
        echo $this->ressource_access_denied_message;
    }

    function ressourceNotFound() {
        echo $this->ressource_notfound_message;
    }

    function defaultpage() {return "projet";}

    function projet() { echo $this->access_denied_message; }

    //sidebar
    function sidebar() { echo "<p>accés intérdit</p>" ;}
    //function sidebar_test() { Page::sidebar_test("test");}

    function __call($a, $b){
        echo $this->access_denied_message;
    }

    public function __toString() {
        return $this->id_utilisateur;
    }
}

class Page {
    static function __callStatic($name, $args){

        $views_folder = __DIR__."/../views/";

        global $connectedProfil;
        global $db;
        global $sousProjet;
        global $lang;

        switch($name) {
            case "sidebar" :
            case "sidebar_test" :
                foreach ($args as $key => $value) {
                    if(file_exists($file = $views_folder."{$name}/{$name}_{$value}.php")) {
                        include $file;
                    } elseif(file_exists($file = $views_folder."{$name}/{$name}_{$value}.html")) {
                        include $file;
                    }
                }
                break;
            default :
                foreach ($args[0] as $key => $value) {
                    include $views_folder."{$name}/{$key}/{$key}_block_begin.php";
                    if($name == "sousprojet" and !in_array("quickaccess",$value)) {
                        $html='<ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">';

                        foreach($value as $tab) {
                            $html .='<li class="'.($value[0]==$tab?"active":"").'">';
                            $html .='<a href="#'.$tab.'_content'.'" data-toggle="tab" id="'.$tab.'_href'.'">'.$lang["$tab"].'</a>';//$lang["$tab"]
                            $html .='</li>';
                        }

                        $html .='</ul>';

                        $html .='<div class="block-content tab-content">';
                        echo $html;
                    }
                    foreach($value as $k => $v) {
                        if(file_exists($file = $views_folder."{$name}/{$key}/{$v}.php")) {
                            include $file;
                        } elseif(file_exists($file = $views_folder."{$name}/{$key}/{$v}.html")) {
                            include $file;
                        }
                    }
                    if($name == "sousprojet"  and !in_array("quickaccess",$value)) {
                        echo "</div>";
                    }
                    include $views_folder."{$name}/{$key}/{$key}_block_end.php";
                }
                break;
        }
    }
}

class adm extends baseUser {
    function dashboard() {
        Page::dashboard(
            array(
                "dashboard1" => array("index"),
                "activitevpi" => array("gestionplans","etat_ot","gestiontrvx","gestionpbcpbt","gestionfinprod"),
                "activitebei" => array("statbei1","designreseau","fin_design_hors_delai","plan_aiguillage_attributions","plan_aiguillage_non_uploades","commande_structurantes_attributions","fin_commande_structurantes_hors_delai","saisie_reference_commande_acces","commandes_refusees","commandes_accepte_pas_intervenant","plans_tirage_non_uploades")/*,
                "productiongenerale" => array("index"),*/
            )
        );
    }

    function projet() {
        Page::projet(
            array(
                "projet" => array("liste_project","add_project","add_sub_project","update_project","delete_project"),
                "sousprojet" => array("liste_sub_project","open_sub_project","delete_sub_project")
            )
        );
    }

    function avancement() {
        Page::avancement(
            array(
                "avancement" => array("avancement_liste")
            )
        );
    }

    function lineaire() {
        Page::lineaire(
            array(
                "lineaire" => array("lineaire_liste")
            )
        );
    }

    function planning() {
        Page::planning(
            array(
                "planning" => array("planning")
            )
        );
    }

    function pbc() {
        Page::pbc(
            array(
                "pbc" => array("pbc_list")
            )
        );
    }

    function entreprise() {
        Page::entreprise(
            array(
                "entreprise" => array("liste","add","add_equipe","update","delete"),
                "equipe" => array("liste","update","delete")
            )
        );
    }

    function sousprojet() {
        Page::sousprojet(
            array(
                "quickaccess" => array("quickaccess"),
                "infoszone" => array("nom","infoplaque","zone","siteorigine"),
                "gestionplaque" => array("phase","traitementetude"),
                "preparationplaque" => array("preparationcarto","positionnementadresses","surveyadressesterrain"),
                "reseautransport" => array("design","aiguillage","commandectr","tirage","raccordements","recette","commandefintravaux"),
                "reseaudistribution" => array("designcdi","daiguillage","commandecdi","dtirage","draccordements","drecette","dcommandefintravaux")
            )
        );
    }

    function ot() {
        Page::ot(
            array(
                "ot" => array("liste","add","update"/*,"open_pblq"*/,"delete","link","link_pb"),
                "planningot" => array("affecter"),
                "deot" => array("deot"),
                "devis" => array("formdevis","delete","convert_bdc"),
                "ebm" => array("formebm"),
                "chambreot" => array("liste","update","pointbloquant"),
                /*"synoptique" => array("synoptique"),*/
                "retourpresta" => array("retourpresta"),
                "fcomp" => array("fcomp"),
                "blq" => array("blq")
            )
        );
    }

    function pointbloquant() {
        Page::pointbloquant(
            array(
                "pointbloquant" => array("liste","update","add_info"/*,"delete"*/),
                "info" => array("liste","update","delete")
            )
        );
    }

    function wiki() {
    	Page::wiki(
    			array(
    					"wiki" => array("wiki")
    			)
    			);
    }

    function sidebar() {
        Page::sidebar("dashboard","projet_titre","projet_liste","avancements_liste","pointbloquant_liste","menu_pbc","planning_titre","planning_view","planning_lineaire","menu_stt_titre","menu_stt_inc","wiki_titre","wiki");
    }

    //admin only menu

    function utilisateur() {
        Page::utilisateur(
            array(
                "free" => array("liste","add","update","delete","nro"),
                "stt" => array("liste","add","update","delete")
            )
        );
    }

    function mail() {
        Page::mail(
            array(
                "projetcreation" => array("liste","add","delete"),
                "edittemplate" => array("editor")
            )
        );
    }

    function nro() {
        Page::nro(
            array(
                "nro" => array("liste","add","update","delete")
            )
        );
    }

    /*function nropci() {
        Page::nropci(
            array(
                "nropci" => array("liste","update")
            )
        );
    }*/

    function typeot() {
        Page::typeot(
            array(
                "typeot" => array("liste","add","update","delete")
            )
        );
    }

    function typeequipe() {
        Page::typeequipe(
            array(
                "typeequipe" => array("liste","add","update","delete")
            )
        );
    }
}

class dov extends baseUser {

    function dashboard() {
        Page::dashboard(
            array(
                "dashboard1" => array("index"),
                "activitevpi" => array("gestionplans","etat_ot","gestiontrvx","gestionpbcpbt","gestionfinprod"),
                "activitebei" => array("index")/*,
                "productiongenerale" => array("index"),*/
            )
        );
    }

    function projet() {
        Page::projet(
            array(
                "projet" => array("liste_project","add_project","add_sub_project","update_project","delete_project"),
                "sousprojet" => array("liste_sub_project","open_sub_project","delete_sub_project")
            )
        );
    }

    function avancement() {
        Page::avancement(
            array(
                "avancement" => array("avancement_liste")
            )
        );
    }

    function planning() {
        Page::planning(
            array(
                "planning" => array("planning")
            )
        );
    }

    function entreprise() {
        Page::entreprise(
            array(
                "entreprise" => array("liste","add","add_equipe","update","delete"),
                "equipe" => array("liste","update","delete")
            )
        );
    }

    function sousprojet() {
        Page::sousprojet(
            array(
                "quickaccess" => array("quickaccess"),
                "infoszone" => array("nom","infoplaque","zone","siteorigine"),
                "gestionplaque" => array("phase","traitementetude"),
                "preparationplaque" => array("preparationcarto","positionnementadresses","surveyadressesterrain"),
                "reseautransport" => array("design","aiguillage","commandectr","tirage","raccordements","recette","commandefintravaux"),
                "reseaudistribution" => array("designcdi","daiguillage","commandecdi","dtirage","draccordements","drecette","dcommandefintravaux")
            )
        );
    }

    function ot() {
        Page::ot(
            array(
                "ot" => array("liste","add","update"/*,"open_pblq"*/,"delete","link","link_pb"),
                "deot" => array("deot"),
                "devis" => array("formdevis","delete","convert_bdc"),
                "ebm" => array("formebm"),
                "chambreot" => array("liste","update","pointbloquant"),
                "planningot" => array("affecter"),
                /*"synoptique" => array("synoptique"),*/
                "blq" => array("blq")
            )
        );
    }

    function pointbloquant() {
        Page::pointbloquant(
            array(
                "pointbloquant" => array("liste","update","delete")
            )
        );
    }

    function sidebar() {
        Page::sidebar("dashboard","projet_titre","projet_liste","avancements_liste","planning_titre","planning_view","planning_lineaire","menu_stt_titre","menu_stt_inc");
    }
}
class pov extends baseUser {

    function dashboard() {
        Page::dashboard(
            array(
                "dashboard1" => array("index"),
                "activitevpi" => array("gestionplans","etat_ot","gestiontrvx","gestionpbcpbt","gestionfinprod"),
                "activitebei" => array("index")/*,
                "productiongenerale" => array("index"),*/
            )
        );
    }

    function projet() {
        Page::projet(
            array(
                "projet" => array("liste_project","add_project","add_sub_project","update_project","delete_project"),
                "sousprojet" => array("liste_sub_project","open_sub_project","delete_sub_project")
            )
        );
    }

    function avancement() {
        Page::avancement(
            array(
                "avancement" => array("avancement_liste")
            )
        );
    }

    function planning() {
        Page::planning(
            array(
                "planning" => array("planning")
            )
        );
    }

    function entreprise() {
        Page::entreprise(
            array(
                "entreprise" => array("liste","add","add_equipe","update","delete"),
                "equipe" => array("liste","update","delete")
            )
        );
    }

    function sousprojet() {
        Page::sousprojet(
            array(
                "quickaccess" => array("quickaccess"),
                "infoszone" => array("nom","infoplaque","zone","siteorigine"),
                "gestionplaque" => array("phase","traitementetude"),
                "preparationplaque" => array("preparationcarto","positionnementadresses","surveyadressesterrain"),
                "reseautransport" => array("design","aiguillage","commandectr","tirage","raccordements","recette","commandefintravaux"),
                "reseaudistribution" => array("designcdi","daiguillage","commandecdi","dtirage","draccordements","drecette","dcommandefintravaux")
            )
        );
    }

    function ot() {
        Page::ot(
            array(
                "ot" => array("liste","add","update"/*,"open_pblq"*/,"delete","link","link_pb"),
                "deot" => array("deot"),
                "devis" => array("formdevis","delete","convert_bdc"),
                "ebm" => array("formebm"),
                "chambreot" => array("liste","update","pointbloquant"),
                "planningot" => array("affecter"),
                /*"synoptique" => array("synoptique"),*/
                "blq" => array("blq")
            )
        );
    }

    function pointbloquant() {
        Page::pointbloquant(
            array(
                "pointbloquant" => array("liste","update","delete")
            )
        );
    }

    function sidebar() {
        Page::sidebar("dashboard","projet_titre","projet_liste","avancements_liste","planning_titre","planning_view","planning_lineaire","menu_stt_titre","menu_stt_inc");
    }

    //admin only menu

    function utilisateur() {
        Page::utilisateur(
            array(
                "free" => array("liste","nro")
            )
        );
    }

    function nro() {
        Page::nro(
            array(
                "nro" => array("liste","update_vpi")
            )
        );
    }
}
class bei extends baseUser {

    function projet() {
        Page::projet(
            array(
                "projet" => array("liste_project"),
                "sousprojet" => array("liste_sub_project","open_sub_project")
            )
        );
    }

    function avancement() {
        Page::avancement(
            array(
                "avancement" => array("avancement_liste")
            )
        );
    }

    function sousprojet() {
        Page::sousprojet(
            array(
                "quickaccess" => array("quickaccess"),
                "infoszone" => array("nom","infoplaque","zone","siteorigine"),
                "gestionplaque" => array("phase","traitementetude"),
                "preparationplaque" => array("preparationcarto","positionnementadresses","surveyadressesterrain"),
                "reseautransport" => array("design","aiguillage","commandectr","tirage","raccordements","recette","commandefintravaux"),
                "reseaudistribution" => array("designcdi","daiguillage","commandecdi","dtirage","draccordements","drecette","dcommandefintravaux")
            )
        );
    }

    function pointbloquant() {
        Page::pointbloquant(
            array(
                "pointbloquant" => array("liste","update","add_info"/*,"delete"*/),
                "info" => array("liste","update","delete")
            )
        );
    }

    function sidebar() {
        Page::sidebar("projet_titre","projet_liste","avancements_liste","pointbloquant_liste");
    }
}
class cdp extends baseUser {

    function dashboard() {
        Page::dashboard(
            array(
                "dashboard1" => array("index"),
                "activitevpi" => array("gestionplans","etat_ot","gestiontrvx","gestionpbcpbt","gestionfinprod"),
                "activitebei" => array("index")/*,
                "productiongenerale" => array("index"),*/
            )
        );
    }

    function projet() {
        Page::projet(
            array(
                "projet" => array("liste_project","add_project","add_sub_project","update_project","delete_project"),
                "sousprojet" => array("liste_sub_project","open_sub_project","delete_sub_project")
            )
        );
    }

    function sousprojet() {
        Page::sousprojet(
            array(
                "quickaccess" => array("quickaccess"),
                "infoszone" => array("nom","infoplaque","zone","siteorigine"),
                "gestionplaque" => array("phase","traitementetude"),
                "preparationplaque" => array("preparationcarto","positionnementadresses","surveyadressesterrain"),
                "reseautransport" => array("design","aiguillage","commandectr","tirage","raccordements","recette"),
                "reseaudistribution" => array("designcdi","daiguillage","commandecdi","dtirage","draccordements","drecette"),
            )
        );
    }

    function sidebar() {
        Page::sidebar("dashboard","projet_titre","projet_liste");
    }
}
class vpi extends baseUser {

    function dashboard() {
        Page::dashboard(
            array(
                "dashboard1" => array("index"),
                "activitevpi" => array("gestionplans","etat_ot","gestiontrvx","gestionpbcpbt","gestionfinprod"),
                "activitebei" => array("index")/*,
                "productiongenerale" => array("index"),*/
            )
        );
    }

    function projet() {
        Page::projet(
            array(
                "projet" => array("liste_project"),
                "sousprojet" => array("liste_sub_project","open_sub_project")
            )
        );
    }

    function avancement() {
        Page::avancement(
            array(
                "avancement" => array("avancement_liste")
            )
        );
    }

    function planning() {
        Page::planning(
            array(
                "planning" => array("planning")
            )
        );
    }

    function sousprojet() {
        Page::sousprojet(
            array(
                "quickaccess" => array("quickaccess"),
                "infoszone" => array("nom","infoplaque","zone","siteorigine"),
                "gestionplaque" => array("phase","traitementetude"),
                "preparationplaque" => array("preparationcarto","positionnementadresses","surveyadressesterrain"),
                "reseautransport" => array("design","aiguillage","commandectr","tirage","raccordements","recette","commandefintravaux"),
                "reseaudistribution" => array("designcdi","daiguillage","commandecdi","dtirage","draccordements","drecette","dcommandefintravaux")
            )
        );
    }

    function pbc() {
        Page::pbc(
            array(
                "pbc" => array("pbc_list")
            )
        );
    }

    function pointbloquant() {
        Page::pointbloquant(
            array(
                "pointbloquant" => array("liste","update","add_info"/*,"delete"*/),
                "info" => array("liste","update","delete")
            )
        );
    }

    function ot() {
        Page::ot(
            array(
                "ot" => array("liste","add","update"/*,"open_pblq"*/,"delete","link","link_pb"),
                "fcomp" => array("fcomp"),
                "deot" => array("deot"),
                "devis" => array("formdevis","delete","convert_bdc"),
                "ebm" => array("formebm"),
                "retourpresta" => array("retourpresta"),
                "chambreot" => array("liste","update","pointbloquant"),
                "planningot" => array("affecter"),
                /*"synoptique" => array("synoptique"),*/
                "blq" => array("blq")
            )
        );
    }

    function sidebar() {
        Page::sidebar("dashboard","projet_titre","projet_liste","avancements_liste","pointbloquant_liste","menu_pbc","planning_titre","planning_view");
    }
}
class pci extends baseUser {
    function defaultpage() {
        return "pcip";
    }

    /*function dashboard() {
        Page::dashboard(
            array(
                "dashboard1" => array("index"),
                "activitevpi" => array("gestionplans"),
                "activitebei" => array("index"),
                "productiongenerale" => array("index"),
            )
        );
    }*/

    function pcip() {
        Page::pcip(
            array(
                "ot" => array("liste"),
                "fcomp" => array("fcomp"),
                "blq" => array("blq"),
                "deot" => array("deot"),
                "infosot" => array("calendar"),
                "chambreot" => array("liste","update","pointbloquant"),
                /*"synoptique" => array("synoptique"),*/
                "traitementot" => array("traitement")
            )
        );
    }

    function pbc() {
        Page::pbc(
            array(
                "pbc" => array("pbc_list")
            )
        );
    }

    function pointbloquant() {
        Page::pointbloquant(
            array(
                "pointbloquant" => array("liste","update","add_info"/*,"delete"*/),
                "info" => array("liste","update","delete")
            )
        );
    }

    function sidebar() {
        Page::sidebar(/*"dashboard",*/"pci_titre","pci_liste","pointbloquant_liste","menu_pbc");
    }
}
class stt extends baseUser {
    function defaultpage() {
        return "myot";
    }

    function myot() {
        Page::myot(
            array(
                "ot" => array("liste"),
                "deot" => array("deot"),
                "infosot" => array("calendar"),
                "chambreot" => array("liste","update","pointbloquant"),
                /*"synoptique" => array("synoptique"),*/
                "devis" => array("formdevis"),
                "traitementot" => array("traitement"),
                "blq" => array("blq")
            )
        );
    }

    function pbc() {
        Page::pbc(
            array(
                "pbc" => array("pbc_list")
            )
        );
    }

    function myotplanning() {
        Page::myotplanning(
            array(
                "planning" => array("planning")
            )
        );
    }

    function sidebar() {
        Page::sidebar("myot_titre","myot_liste","myot_planning","menu_pbc");
    }
}