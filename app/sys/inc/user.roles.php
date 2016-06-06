<?php
/**
 * file: utilisateur.roles.php
 * User: rabii
 */


	class baseUser
    {
        public 	$profil = NULL;

        public $access_denied_message =
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


        function __construct($p) {
            $this->profil = $p;
        }

        function __get($name) {
            return $this->profil->$name;
        }

        function projet() { echo $this->access_denied_message; }
        function sousprojet() { echo $this->access_denied_message; }
        function utilisateur() { echo $this->access_denied_message; }
        //function modal(){ echo $this->access_denied_message; }

        function infozone() {return array();}
        function gestionplaque() {return array();}
        function preparationplaque() {return array();}
        function reseautransport() {return array();}
        function reseaudistribution() {return array();}

        function __call($a, $b){
            echo $this->access_denied_message;
        }

        public function __toString() {
            return $this->id_utilisateur;
        }
    }

	class Action
    {
        static function __callStatic($name, $args){

            if($name=="sousprojet") require_once __DIR__."/../inc/forms.functions.inc.php";

            $views_folder = __DIR__."/../views/";

            global $connectedProfil;

            foreach ($args as $key => $value) {
                if(file_exists($file = $views_folder."{$name}/{$name}_{$value}.html")) {
                    include $file;
                } elseif(file_exists($file = $views_folder."{$name}/{$name}_{$value}.php")) {
                    include $file;
                }
            }
        }
    }

	class Administrateur extends baseUser
    {
        function projet() {
            Action::projet("liste","add","sousprojet_add","update","delete");
        }

        function sousprojet() {
            Action::sousprojet("infozone","gestionplaque","preparationplaque","reseautransport","reseaudistribution");
        }

        function utilisateur() {
            Action::utilisateur("liste");
        }

        //tab contents
        function infozone() {return array("nom","infoplaque","zone","siteorigine");}
        function gestionplaque() {return array("phase","traitementetude");}
        function preparationplaque() {return array("preparationcarto","positionnementadresses","surveyadressesterrain");}
        function reseautransport() {return array("design","aiguillage","commandectr","tirage","raccordements","recette");}
        function reseaudistribution() {return array("designcdi","aiguillage","commandecdi","tirage","raccordements","recette");}
    }

    class CDPUser extends baseUser
    {
    }
    class STTUser extends baseUser
    {
    }