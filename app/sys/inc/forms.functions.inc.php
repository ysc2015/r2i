<?php
/**
 * file: forms.functions.inc.php
 * User: rabii
 */

//functions

function get_bei_users($object,$field_name) {
    $users = Utilisateur::all(
        array('conditions' =>
            array("id_profil_utilisateur = ?", 4)//profil = 4 (bei user)
        )
    );

    $html = "";

    foreach($users as $user) {
        $html .= "<option value=\"{$user->id_utilisateur}\" ".($object !== NULL?($object->$field_name == $user->id_utilisateur?"selected":""):"").">$user->prenom_utilisateur $user->nom_utilisateur</option>";
    }

    return $html;
}


global $form;

$form = array();

//Info Zone de Travaux (sous-projet)

//Nom(sousprojet)
$form["infozone_nom"]["table_key"] = "id_sous_projet";
$form["infozone_nom"]["has_ot"] = false;
$form["infozone_nom"]["fields"] = array(
    array(
        "id" => "dep",
        "field_name" => "dep",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Département",
        "css_class" => "col-md-3",
        "readonly" => "readonly",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ville",
        "field_name" => "ville",
        "input_type" => "text",
        "place_holder" => "",
        "label_for" => "Ville",
        "css_class" => "col-md-3",
        "readonly" => "readonly",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "plaque",
        "field_name" => "plaque",
        "input_type" => "text",
        "place_holder" => "",
        "label_for" => "Plaque",
        "css_class" => "col-md-3",
        "readonly" => "readonly",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "zone",
        "field_name" => "zone",
        "input_type" => "text",
        "place_holder" => "",
        "label_for" => "Zone",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Info Plaque
$form["infozone_plaque"]["table_key"] = "id_sous_projet_plaque";
$form["infozone_plaque"]["has_ot"] = false;
$form["infozone_plaque"]["fields"] = array(
    array(
        "id" => "phase",
        "field_name" => "phase",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une phase",
        "label_for" => "Phase",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectPlaquePhase",
        "ref_select" => "plaque_phase",
        "select_func" => ""
    ),
    array(
        "id" => "type",
        "field_name" => "type",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un type",
        "label_for" => "Type",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectPlaqueType",
        "ref_select" => "plaque_type",
        "select_func" => ""
    )
);

//Info Zone
$form["infozone_zone"]["table_key"] = "id_sous_projet_zone";
$form["infozone_zone"]["has_ot"] = false;
$form["infozone_zone"]["fields"] = array(
    array(
        "id" => "nbr_zone",
        "field_name" => "nbr_zone",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Nbe de Zones de la Plaque",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "lr_sur_pm",
        "field_name" => "lr_sur_pm",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "LR sur PM existant",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "lr",
        "field_name" => "lr",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "LR",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "nbr_de_site",
        "field_name" => "nbr_de_site",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "NB DE SITE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "nb_fo_sur_pm",
        "field_name" => "nb_fo_sur_pm",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "NB FO SUR PM",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "nb_fo_sur_pmz",
        "field_name" => "nb_fo_sur_pmz",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "NB FO SUR PMZ",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Site Origine
$form["infozone_site_origine"]["table_key"] = "id_sous_projet_site_origine";
$form["infozone_site_origine"]["has_ot"] = false;
$form["infozone_site_origine"]["fields"] = array(
    array(
        "id" => "code_site",
        "field_name" => "code_site",
        "input_type" => "text",
        "place_holder" => "",
        "label_for" => "Code Site",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "type_so",
        "field_name" => "type",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un type",
        "label_for" => "Type",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectSiteOrigineType",
        "ref_select" => "site_origine_type",
        "select_func" => ""
    ),
    array(
        "id" => "auto_adduction",
        "field_name" => "auto_adduction",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Auto Adduction",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectSiteOrigineAutoAdduction",
        "ref_select" => "site_origine_auto_adduction",
        "select_func" => ""
    ),
    array(
        "id" => "travaux_adduction",
        "field_name" => "travaux_adduction",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Travaux adduction",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectSiteOrigineTravauxAdduction",
        "ref_select" => "site_origine_travaux_adduction",
        "select_func" => ""
    ),
    array(
        "id" => "recette_adduction",
        "field_name" => "recette_adduction",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Recette Adduction",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectSiteOrigineRecetteAdduction",
        "ref_select" => "site_origine_recette_adduction",
        "select_func" => ""
    )
);

//Gestion plaque

//Phase
$form["gestion_plaque_phase"]["table_key"] = "id_sous_projet_plaque_phase";
$form["gestion_plaque_phase"]["has_ot"] = false;
$form["gestion_plaque_phase"]["fields"] = array(
    array(
        "id" => "instigateur",
        "field_name" => "instigateur",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Instigateur",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectPhaseInstigateur",
        "ref_select" => "phase_instigateur",
        "select_func" => ""
    ),
    /*array(
        "id" => "vague",
        "field_name" => "vague",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Vague",
        "css_class" => "col-md-3",
        "readonly" => "",//was readonly
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),*/
    array(
        "id" => "vague",
        "field_name" => "vague",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une phase",
        "label_for" => "Vague",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectPlaquePhase",
        "ref_select" => "plaque_phase",
        "select_func" => ""
    ),
    array(
        "id" => "date_lancement",
        "field_name" => "date_lancement",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Lancement",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Traitement etude
$form["gestion_plaque_traitement_etude"]["table_key"] = "id_sous_projet_plaque_traitement_etude";
$form["gestion_plaque_traitement_etude"]["has_ot"] = false;
$form["gestion_plaque_traitement_etude"]["fields"] = array(
    array(
        "id" => "tsite",
        "field_name" => "site",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Site",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectTraitementEtudeSite",
        "ref_select" => "traitement_etude_site",
        "select_func" => ""
    ),
    array(
        "id" => "charge_etude",
        "field_name" => "charge_etude",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Chargé d'étude",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    )
);

//Préparation plaque

//Préparation carto
$form["gestion_plaque_carto"]["table_key"] = "id_sous_projet_plaque_carto";
$form["gestion_plaque_carto"]["has_ot"] = false;
$form["gestion_plaque_carto"]["fields"] = array(
    array(
        "id" => "pc_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "pc_date_debut",
        "field_name" => "date_debut",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Début",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "pc_date_ret_prevue",
        "field_name" => "date_ret_prevue",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date ret Prev",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "pc_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Positionnement des Adresses
$form["gestion_plaque_pos_adresse"]["table_key"] = "id_sous_projet_plaque_pos_adresse";
$form["gestion_plaque_pos_adresse"]["has_ot"] = false;
$form["gestion_plaque_pos_adresse"]["fields"] = array(
    array(
        "id" => "pa_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "pa_date_debut",
        "field_name" => "date_debut",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Début",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "pa_date_ret_prevue",
        "field_name" => "date_ret_prevue",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date ret Prev",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "pa_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "pa_intervenant",
        "field_name" => "intervenant",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "pa_bpe_sur_site",
        "field_name" => "bpe_sur_site",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "BPE sur SITE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectBpeSurSite",
        "ref_select" => "bpe_sur_site",
        "select_func" => ""
    )
);

//Survey Adresses Terrain
$form["gestion_plaque_survey_adresse"]["table_key"] = "id_sous_projet_plaque_survey_adresse";
$form["gestion_plaque_survey_adresse"]["has_ot"] = false;
$form["gestion_plaque_survey_adresse"]["fields"] = array(
    array(
        "id" => "sa_volume_adresse",
        "field_name" => "volume_adresse",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Volumes Adresses",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "sa_date_debut",
        "field_name" => "date_debut",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Début",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "sa_date_ret_prevue",
        "field_name" => "date_ret_prevue",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date ret Prev",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "sa_intervenant",
        "field_name" => "intervenant",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),array(
        "id" => "sa_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Réseau de Transport

//Design
$form["transport_design"]["table_key"] = "id_sous_projet_transport_design";
$form["transport_design"]["has_ot"] = false;
$form["transport_design"]["fields"] = array(
    array(
        "id" => "td_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),array(
        "id" => "td_date_debut",
        "field_name" => "date_debut",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Début",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "td_date_ret_prevue",
        "field_name" => "date_ret_prevue",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date ret Prev",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "td_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "td_lineaire_transport",
        "field_name" => "lineaire_transport",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Linéaire Transport",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "td_nb_zones",
        "field_name" => "nb_zones",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Nbe Zones",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Aiguillage
$form["transport_aiguillage"]["table_key"] = "id_sous_projet_transport_aiguillage";
$form["transport_aiguillage"]["has_ot"] = true;
$form["transport_aiguillage"]["fields"] = array(
    array(
        "id" => "ta_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "ta_plans",
        "field_name" => "plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez état plans",
        "label_for" => "Plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatPlan",
        "ref_select" => "etat_plan",
        "select_func" => ""
    ),
    array(
        "id" => "ta_lineaire_reseau",
        "field_name" => "lineaire_reseau",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Linéaire de réseau",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ta_controle_plans",
        "field_name" => "controle_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez type controle",
        "label_for" => "Contrôle des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControlePlan",
        "ref_select" => "controle_plan",
        "select_func" => ""
    ),
    array(
        "id" => "ta_date_transmission_plans",
        "field_name" => "date_transmission_plans",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission Plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ta_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "ta_date_aiguillage",
        "field_name" => "date_aiguillage",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Aiguillage",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ta_date_ret_prevue",
        "field_name" => "date_ret_prevue",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date ret Prev",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ta_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ta_controle_demarrage_effectif",
        "field_name" => "controle_demarrage_effectif",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle démarrage effectif",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControleDemarrageEffectif",
        "ref_select" => "controle_demarrage_effectif",
        "select_func" => ""
    ),
    array(
        "id" => "ta_date_retour",
        "field_name" => "date_retour",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "ta_etat_retour",
        "field_name" => "etat_retour",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRetour",
        "ref_select" => "etat_retour",
        "select_func" => ""
    )
);

//Commande Structurante CTR
$form["transport_commande_ctr"]["table_key"] = "id_sous_projet_transport_commande_ctr";
$form["transport_commande_ctr"]["has_ot"] = false;
$form["transport_commande_ctr"]["fields"] = array(
    array(
        "id" => "cctr_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "cctr_date_butoir",
        "field_name" => "date_butoir",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date butoire traitement retour Aig",
        "css_class" => "col-md-3",
        "readonly" => "",//was readonly
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "cctr_traitement_retour_terrain",
        "field_name" => "traitement_retour_terrain",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Traitement Retours terrain",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "cctr_modification_carto",
        "field_name" => "modification_carto",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Modification Carto",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectModificationCarto",
        "ref_select" => "modification_carto",
        "select_func" => ""
    ),
    array(
        "id" => "cctr_commandes_acces",
        "field_name" => "commandes_acces",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Commande Accès",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectCommandeAcces",
        "ref_select" => "commande_acces",
        "select_func" => ""
    ),
    array(
        "id" => "cctr_date_transmission_ca",
        "field_name" => "date_transmission_ca",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission CA",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "cctr_ref_commande_acces",
        "field_name" => "ref_commande_acces",
        "input_type" => "text",
        "place_holder" => "",
        "label_for" => "Référence Commande Accès",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "cctr_go_ft",
        "field_name" => "go_ft",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "GO FT",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectGoFt",
        "ref_select" => "go_ft",
        "select_func" => ""
    )
);

//Tirage
$form["transport_tirage"]["table_key"] = "id_sous_projet_transport_tirage";
$form["transport_tirage"]["has_ot"] = true;
$form["transport_tirage"]["fields"] = array(
    array(
        "id" => "tt_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "tt_date_previsionnelle",
        "field_name" => "date_previsionnelle",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Previsionnelle",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tt_prep_plans",
        "field_name" => "prep_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Préparation des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "tt_controle_plans",
        "field_name" => "controle_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControlePlan",
        "ref_select" => "controle_plan",
        "select_func" => ""
    ),
    array(
        "id" => "tt_date_transmission_plans",
        "field_name" => "date_transmission_plans",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission Plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tt_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "tt_date_tirage",
        "field_name" => "date_tirage",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Tirage",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tt_date_ret_prevue",
        "field_name" => "date_ret_prevue",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour Prev",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
    "id" => "tt_duree",
    "field_name" => "duree",
    "input_type" => "number",
    "place_holder" => "",
    "label_for" => "Durée",
    "css_class" => "col-md-3",
    "readonly" => "",
    "db_class_for_select" => "",
    "ref_select" => "",
    "select_func" => ""
    ),
    array(
        "id" => "tt_controle_demarrage_effectif",
        "field_name" => "controle_demarrage_effectif",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle démarrage effectif",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControleDemarrageEffectif",
        "ref_select" => "controle_demarrage_effectif",
        "select_func" => ""
    ),
    array(
        "id" => "tt_date_retour",
        "field_name" => "date_retour",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tt_etat_retour",
        "field_name" => "etat_retour",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRetour",
        "ref_select" => "etat_retour",
        "select_func" => ""
    )
);

//Raccordements
$form["transport_raccordements"]["table_key"] = "id_sous_projet_transport_raccordements";
$form["transport_raccordements"]["has_ot"] = false;
$form["transport_raccordements"]["fields"] = array(
    array(
        "id" => "tr_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "tr_preparation_pds",
        "field_name" => "preparation_pds",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Préparation PDS",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "tr_controle_plans",
        "field_name" => "controle_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControlePlan",
        "ref_select" => "controle_plan",
        "select_func" => ""
    ),
    array(
        "id" => "tr_date_transmission_pds",
        "field_name" => "date_transmission_pds",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission PDS",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tr_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "tr_date_racco",
        "field_name" => "date_racco",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Racco",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tr_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tr_controle_demarrage_effectif",
        "field_name" => "controle_demarrage_effectif",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle démarrage effectif",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControleDemarrageEffectif",
        "ref_select" => "controle_demarrage_effectif",
        "select_func" => ""
    ),
    array(
        "id" => "tr_date_retour",
        "field_name" => "date_retour",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "tr_etat_retour",
        "field_name" => "etat_retour",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRetour",
        "ref_select" => "etat_retour",
        "select_func" => ""
    )
);

//Recette
$form["transport_recette"]["table_key"] = "id_sous_projet_transport_recette";
$form["transport_recette"]["has_ot"] = false;
$form["transport_recette"]["fields"] = array(
    array(
        "id" => "trec_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "trec_doe",
        "field_name" => "doe",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "DOE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "trec_netgeo",
        "field_name" => "netgeo",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Netgeo",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "trec_intervenant_free",
        "field_name" => "intervenant_free",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant FREE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "trec_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "trec_date_recette",
        "field_name" => "date_recette",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Recette",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "trec_etat_recette",
        "field_name" => "etat_recette",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Recette",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRecette",
        "ref_select" => "etat_recette",
        "select_func" => ""
    )
);

//Réseau de Distribution

//Design
$form["distribution_design"]["table_key"] = "id_sous_projet_distribution_design";
$form["distribution_design"]["has_ot"] = false;
$form["distribution_design"]["fields"] = array(
    array(
        "id" => "dd_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dd_intervenant_bex",
        "field_name" => "intervenant_bex",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BEX",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dd_date_debut",
        "field_name" => "date_debut",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Début",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dd_date_fin",
        "field_name" => "date_fin",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Fin",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dd_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dd_lineaire_distribution",
        "field_name" => "lineaire_distribution",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Linéaire Distribution",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dd_etat",
        "field_name" => "etat",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatDesign",
        "ref_select" => "etat_design",
        "select_func" => ""
    ),
    array(
        "id" => "dd_date_envoi",
        "field_name" => "date_envoi",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date envoi",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    )
);

//Aiguillage
$form["distribution_aiguillage"]["table_key"] = "id_sous_projet_distribution_aiguillage";
$form["distribution_aiguillage"]["has_ot"] = true;
$form["distribution_aiguillage"]["fields"] = array(
    array(
        "id" => "da_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),array(
        "id" => "da_plans",
        "field_name" => "plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez état plans",
        "label_for" => "Plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatPlan",
        "ref_select" => "etat_plan",
        "select_func" => ""
    ),array(
        "id" => "da_lineaire_reseau",
        "field_name" => "lineaire_reseau",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Linéaire de réseau",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "da_controle_plans",
        "field_name" => "controle_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez type controle",
        "label_for" => "Contrôle des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControlePlan",
        "ref_select" => "controle_plan",
        "select_func" => ""
    ),
    array(
        "id" => "da_date_transmission_plans",
        "field_name" => "date_transmission_plans",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission Plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "da_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "da_date_aiguillage",
        "field_name" => "date_aiguillage",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Aiguillage",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "da_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "da_controle_demarrage_effectif",
        "field_name" => "controle_demarrage_effectif",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle démarrage effectif",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControleDemarrageEffectif",
        "ref_select" => "controle_demarrage_effectif",
        "select_func" => ""
    ),
    array(
        "id" => "da_date_retour",
        "field_name" => "date_retour",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),array(
        "id" => "da_etat_retour",
        "field_name" => "etat_retour",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRetour",
        "ref_select" => "etat_retour",
        "select_func" => ""
    )
);

//Commande Structurante CDI
$form["distribution_commande_cdi"]["table_key"] = "id_sous_projet_distribution_commande_cdi";
$form["distribution_commande_cdi"]["has_ot"] = false;
$form["distribution_commande_cdi"]["fields"] = array(
    array(
        "id" => "dcc_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dcc_date_butoir",
        "field_name" => "date_butoir",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date butoire traitement retour Aig",
        "css_class" => "col-md-3",
        "readonly" => "",//was readonly
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dcc_traitement_retour_terrain",
        "field_name" => "traitement_retour_terrain",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Traitement Retours terrain",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dcc_modification_carto",
        "field_name" => "modification_carto",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Modification Carto",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectModificationCarto",
        "ref_select" => "modification_carto",
        "select_func" => ""
    ),
    array(
        "id" => "dcc_commandes_acces",
        "field_name" => "commandes_acces",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Commande Accès",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectCommandeAcces",
        "ref_select" => "commande_acces",
        "select_func" => ""
    ),
    array(
        "id" => "dcc_date_transmission_ca",
        "field_name" => "date_transmission_ca",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission CA",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dcc_ref_commande_acces",
        "field_name" => "ref_commande_acces",
        "input_type" => "text",
        "place_holder" => "",
        "label_for" => "Référence Commande Accès",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dcc_go_ft",
        "field_name" => "go_ft",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "GO FT",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectGoFt",
        "ref_select" => "go_ft",
        "select_func" => ""
    )
);

//Tirage
$form["distribution_tirage"]["table_key"] = "id_sous_projet_distribution_tirage";
$form["distribution_tirage"]["has_ot"] = true;
$form["distribution_tirage"]["fields"] = array(
    array(
        "id" => "dt_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dt_date_previsionnelle",
        "field_name" => "date_previsionnelle",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Previsionnelle",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dt_prep_plans",
        "field_name" => "prep_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Préparation des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dt_controle_plans",
        "field_name" => "controle_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControlePlan",
        "ref_select" => "controle_plan",
        "select_func" => ""
    ),
    array(
        "id" => "dt_date_transmission_plans",
        "field_name" => "date_transmission_plans",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission Plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dt_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "dt_date_tirage",
        "field_name" => "date_tirage",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Tirage",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dt_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dt_controle_demarrage_effectif",
        "field_name" => "controle_demarrage_effectif",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle démarrage effectif",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControleDemarrageEffectif",
        "ref_select" => "controle_demarrage_effectif",
        "select_func" => ""
    ),
    array(
        "id" => "dt_date_retour",
        "field_name" => "date_retour",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dt_etat_retour",
        "field_name" => "etat_retour",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRetour",
        "ref_select" => "etat_retour",
        "select_func" => ""
    )
);

//Raccordements
$form["distribution_raccordements"]["table_key"] = "id_sous_projet_distribution_raccordements";
$form["distribution_raccordements"]["has_ot"] = false;
$form["distribution_raccordements"]["fields"] = array(
    array(
        "id" => "dr_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dr_preparation_pds",
        "field_name" => "preparation_pds",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Préparation PDS",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "dr_controle_plans",
        "field_name" => "controle_plans",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle des plans",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControlePlan",
        "ref_select" => "controle_plan",
        "select_func" => ""
    ),
    array(
        "id" => "dr_date_transmission_pds",
        "field_name" => "date_transmission_pds",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Transmission PDS",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dr_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "dr_date_racco",
        "field_name" => "date_racco",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Racco",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dr_duree",
        "field_name" => "duree",
        "input_type" => "number",
        "place_holder" => "",
        "label_for" => "Durée",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dr_controle_demarrage_effectif",
        "field_name" => "controle_demarrage_effectif",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Contrôle démarrage effectif",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectControleDemarrageEffectif",
        "ref_select" => "controle_demarrage_effectif",
        "select_func" => ""
    ),
    array(
        "id" => "dr_date_retour",
        "field_name" => "date_retour",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "dr_etat_retour",
        "field_name" => "etat_retour",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Retour",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRetour",
        "ref_select" => "etat_retour",
        "select_func" => ""
    )
);

//Recette
$form["distribution_recette"]["table_key"] = "id_sous_projet_distribution_recette";
$form["distribution_recette"]["has_ot"] = false;
$form["distribution_recette"]["fields"] = array(
    array(
        "id" => "drec_intervenant_be",
        "field_name" => "intervenant_be",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant BE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "drec_doe",
        "field_name" => "doe",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "DOE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "drec_netgeo",
        "field_name" => "netgeo",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Netgeo",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "drec_intervenant_free",
        "field_name" => "intervenant_free",
        "input_type" => "select",
        "place_holder" => "Sélectionnez un utilisateur",
        "label_for" => "Intervenant FREE",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => "get_bei_users"
    ),
    array(
        "id" => "drec_entreprise",
        "field_name" => "id_entreprise",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une entreprise",
        "label_for" => "Entreprise",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEntreprise",
        "ref_select" => "entreprise",
        "select_func" => ""
    ),
    array(
        "id" => "drec_date_recette",
        "field_name" => "date_recette",
        "input_type" => "date",
        "place_holder" => "",
        "label_for" => "Date de Recette",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "",
        "ref_select" => "",
        "select_func" => ""
    ),
    array(
        "id" => "drec_etat_recette",
        "field_name" => "etat_recette",
        "input_type" => "select",
        "place_holder" => "Sélectionnez une valeur",
        "label_for" => "Etat Recette",
        "css_class" => "col-md-3",
        "readonly" => "",
        "db_class_for_select" => "SelectEtatRecette",
        "ref_select" => "etat_recette",
        "select_func" => ""
    )
);

function build_user_form($form_name,$object=NULL) {
    global $form;
    /*var_dump($idsp);
    print("table => ".$form[$form_name]["table"]."--------------<br>");*/

    $html = "";


    $html .= "<form class=\"js-validation-bootstrap form-horizontal\">";

    if($object === NULL) {
        $html .="<div class=\"row\"><div id=\"{$form[$form_name]["table_key"]}_alert\" class=\"col-md-3\"><span class=\"label label-warning\">Aucune entrée crée !</span></div></div>";
        /*$html .="<h3 class=\"font-w300 push-15\">Information</h3>";
        $html .="<p>Aucune entrée crée!</p>";
        $html .="</div>";*/

    }

    if($object !== NULL) $html .= "<input type=\"hidden\" id=\"{$form[$form_name]["table_key"]}\" name=\"{$form[$form_name]["table_key"]}\" value=\"{$object->$form[$form_name]["table_key"]}\">";

    foreach($form[$form_name]["fields"] as $key => $val)  {
        $html .= "<div class=\"form-group\">";
        $html .= "<div class=\"{$val["css_class"]}\">";
        $html .= "<label for=\"{$val["id"]}\">{$val["label_for"]} <span class=\"text-danger\">*</span></label>";
        switch($val["input_type"]) {
            case "text" : {
                $html .="<input class=\"form-control\" type=\"text\" id=\"{$val["id"]}\" name=\"{$val["id"]}\" {$val["readonly"]} ".($object !== NULL?"value=\"{$object->$val["field_name"]}\"":"").">";break;
            }
            case "number" : {
                $html .="<input class=\"form-control\" type=\"number\" id=\"{$val["id"]}\" name=\"{$val["id"]}\" {$val["readonly"]} ".($object !== NULL?"value=\"{$object->$val["field_name"]}\"":"").">";break;
            }
            case "date" : {
                $html .="<input class=\"form-control\" type=\"date\" id=\"{$val["id"]}\" name=\"{$val["id"]}\" {$val["readonly"]} ".($object !== NULL?"value=\"{$object->$val["field_name"]}\"":"").">";break;
            }
            case "textarea" : {
                $html .="<textarea class=\"form-control\" id=\"{$val["id"]}\" name=\"{$val["id"]}\" rows=\"3\" {$val["readonly"]}>".($object !== NULL?$object->$val["field_name"]:"")."</textarea>";
                break;
            }

            case "select" : {
                $html .= "<select class=\"form-control\" id=\"{$val["id"]}\" name=\"{$val["id"]}\" {$val["readonly"]}>";//TODO check readonly attr for selectbox
                $html .="<option value=\"\" selected disabled>{$val["place_holder"]}</option>";
                if($val["select_func"] !== "") {
                    $html .= call_user_func_array($val["select_func"],array($object,$val["field_name"]));
                } else {
                    $results = call_user_func($val["db_class_for_select"] .'::all');
                    //var_dump($results);
                    foreach($results as $result) {
                        $html .= "<option value=\"{$result->{"id_".$val["ref_select"]}}\" ".($object !== NULL?($object->$val["field_name"] == $result->{"id_".$val["ref_select"]}?"selected":""):"").">{$result->{"lib_".$val["ref_select"]}}</option>";
                    }
                }
                $html .= "</select>";
                break;
            }


            case "file" : {
                $html .="";
                break;
            }

        }
        $html .= "</div>";
        $html .= "</div>";
    }

    $html .="<div class='alert alert-success' id='message_$form_name' role='alert'></div>";

    $html .= "<div class=\"form-group\">";
    $html .= "<div class=\"col-md-8\">";
    $html .= "<button id=\"{$form[$form_name]["table_key"]}_btn\" class=\"btn btn-primary\" type=\"button\">Enregistrer</button>";
    if($form[$form_name]["has_ot"] && $object !== NULL) {
        $ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_entree = ? AND type_entree = ?", $object->$form[$form_name]["table_key"],$form_name)
            )
        );
        if($ot !== NULL) {
            $idsp = $_GET['idsousprojet'];
            $html .= "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsp\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
        } else {
            $html .= "  <button id=\"{$form[$form_name]["table_key"]}_create_ot_show\" class=\"btn btn-success\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
        }

    }
    $html .= "</div>";
    $html .= "</div>";

    $html .= "</form>";

    echo $html;
}