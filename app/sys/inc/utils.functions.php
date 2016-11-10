<?php
/**
 * file: utils.functions.php
 * User: rabii
 */

function getDuree($date_debut,$date_ret) {
    $now = new DateTime();

    $dd = DateTime::createFromFormat('Y-m-d', $date_debut);
    $df = DateTime::createFromFormat('Y-m-d', $date_ret);

    if($dd && $df && $df < $dd) return "erreur";

    if($dd) {
        if($dd > $now) {
            return "plannifié";
        } else {
            if(!$df) {
                return "en cours";
            } else {
                return ($dd->diff($df)->format("%a") + 1);
            }
        }
    } else {
        return "non démarrée";
    }
}

function getObjectNameForEntry($entree) {
    $str = "";
    switch ($entree) {
        case 'transportaiguillage' : $str='Aiguillage CTR';break;
        case 'transporttirage' : $str='Tirage CTR';break;
        case 'transportraccordement' : $str='Raccordement CTR';break;
        case 'distributionaiguillage' : $str='Aiguillage CDI';break;
        case 'distributiontirage' : $str='Tirage CDI';break;
        case 'distributionraccordement' : $str='Raccordement CDI';break;
        default : break;
    }

    return $str;
}

function setSousProjetUsers($sousprojet) {
    $users_list = array();

    if($sousprojet !== NULL) {
        if($sousprojet instanceof SousProjet) {

            if($sousprojet->plaqueetude !== NULL) {

                if($sousprojet->plaqueetude->charge_etude > 0) {
                    if(!in_array($sousprojet->plaqueetude->charge_etude,$users_list)) {
                        $users_list[] = $sousprojet->plaqueetude->charge_etude;
                    }
                }
            }

            if($sousprojet->plaquecarto !== NULL) {

                if($sousprojet->plaquecarto->intervenant_be > 0) {
                    if(!in_array($sousprojet->plaquecarto->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->plaquecarto->intervenant_be;
                    }
                }
            }

            if($sousprojet->plaqueposadr !== NULL) {

                if($sousprojet->plaqueposadr->intervenant_be > 0) {
                    if(!in_array($sousprojet->plaqueposadr->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->plaqueposadr->intervenant_be;
                    }
                }

                if($sousprojet->plaqueposadr->intervenant > 0) {
                    if(!in_array($sousprojet->plaqueposadr->intervenant,$users_list)) {
                        $users_list[] = $sousprojet->plaqueposadr->intervenant;
                    }
                }

            }

            if($sousprojet->plaquesurvadr !== NULL) {

                if($sousprojet->plaquesurvadr->intervenant > 0) {
                    if(!in_array($sousprojet->plaquesurvadr->intervenant,$users_list)) {
                        $users_list[] = $sousprojet->plaquesurvadr->intervenant;
                    }
                }

            }

            if($sousprojet->transportdesign !== NULL) {

                if($sousprojet->transportdesign->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportdesign->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportdesign->intervenant_be;
                    }
                }

                if($sousprojet->transportdesign->valideur_bei > 0) {
                    if(!in_array($sousprojet->transportdesign->valideur_bei,$users_list)) {
                        $users_list[] = $sousprojet->transportdesign->valideur_bei;
                    }
                }

            }

            if($sousprojet->transportaiguillage !== NULL) {

                if($sousprojet->transportaiguillage->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportaiguillage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportaiguillage->intervenant_be;
                    }
                }

            }

            if($sousprojet->transportcmcctr !== NULL) {

                if($sousprojet->transportcmcctr->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportcmcctr->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportcmcctr->intervenant_be;
                    }
                }

            }

            if($sousprojet->transporttirage !== NULL) {

                if($sousprojet->transporttirage->intervenant_be > 0) {
                    if(!in_array($sousprojet->transporttirage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transporttirage->intervenant_be;
                    }
                }

            }

            if($sousprojet->transportraccordement !== NULL) {

                if($sousprojet->transportraccordement->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportraccordement->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportraccordement->intervenant_be;
                    }
                }

                if($sousprojet->transportraccordement->preparation_pds > 0) {
                    if(!in_array($sousprojet->transportraccordement->preparation_pds,$users_list)) {
                        $users_list[] = $sousprojet->transportraccordement->preparation_pds;
                    }
                }

            }

            if($sousprojet->transportrecette !== NULL) {

                if($sousprojet->transportrecette->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportrecette->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->intervenant_be;
                    }
                }

                if($sousprojet->transportrecette->doe > 0) {
                    if(!in_array($sousprojet->transportrecette->doe,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->doe;
                    }
                }

                if($sousprojet->transportrecette->netgeo > 0) {
                    if(!in_array($sousprojet->transportrecette->netgeo,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->netgeo;
                    }
                }

                if($sousprojet->transportrecette->intervenant_free > 0) {
                    if(!in_array($sousprojet->transportrecette->intervenant_free,$users_list)) {
                        $users_list[] = $sousprojet->transportrecette->intervenant_free;
                    }
                }

            }

            if($sousprojet->transportcmdfintravaux !== NULL) {

                if($sousprojet->transportcmdfintravaux->intervenant_be > 0) {
                    if(!in_array($sousprojet->transportcmdfintravaux->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->transportcmdfintravaux->intervenant_be;
                    }
                }

            }

            if($sousprojet->distributiondesign !== NULL) {

                if($sousprojet->distributiondesign->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributiondesign->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributiondesign->intervenant_be;
                    }
                }

                if($sousprojet->distributiondesign->intervenant_bex > 0) {
                    if(!in_array($sousprojet->distributiondesign->intervenant_bex,$users_list)) {
                        $users_list[] = $sousprojet->distributiondesign->intervenant_bex;
                    }
                }

            }

            if($sousprojet->distributionaiguillage !== NULL) {

                if($sousprojet->distributionaiguillage->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributionaiguillage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributionaiguillage->intervenant_be;
                    }
                }

            }

            if($sousprojet->distributioncmdcdi !== NULL) {

                if($sousprojet->distributioncmdcdi->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributioncmdcdi->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributioncmdcdi->intervenant_be;
                    }
                }

            }

            if($sousprojet->distributiontirage !== NULL) {

                if($sousprojet->distributiontirage->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributiontirage->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributiontirage->intervenant_be;
                    }
                }

                if($sousprojet->distributiontirage->prep_plans > 0) {
                    if(!in_array($sousprojet->distributiontirage->prep_plans,$users_list)) {
                        $users_list[] = $sousprojet->distributiontirage->prep_plans;
                    }
                }

            }

            if($sousprojet->distributionraccordement !== NULL) {

                if($sousprojet->distributionraccordement->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributionraccordement->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributionraccordement->intervenant_be;
                    }
                }

                if($sousprojet->distributionraccordement->preparation_pds > 0) {
                    if(!in_array($sousprojet->distributionraccordement->preparation_pds,$users_list)) {
                        $users_list[] = $sousprojet->distributionraccordement->preparation_pds;
                    }
                }

            }

            if($sousprojet->distributionrecette !== NULL) {

                if($sousprojet->distributionrecette->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributionrecette->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->intervenant_be;
                    }
                }

                if($sousprojet->distributionrecette->doe > 0) {
                    if(!in_array($sousprojet->distributionrecette->doe,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->doe;
                    }
                }

                if($sousprojet->distributionrecette->netgeo > 0) {
                    if(!in_array($sousprojet->distributionrecette->netgeo,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->netgeo;
                    }
                }

                if($sousprojet->distributionrecette->intervenant_free > 0) {
                    if(!in_array($sousprojet->distributionrecette->intervenant_free,$users_list)) {
                        $users_list[] = $sousprojet->distributionrecette->intervenant_free;
                    }
                }

            }

            if($sousprojet->distributioncmdfintravaux !== NULL) {

                if($sousprojet->distributioncmdfintravaux->intervenant_be > 0) {
                    if(!in_array($sousprojet->distributioncmdfintravaux->intervenant_be,$users_list)) {
                        $users_list[] = $sousprojet->distributioncmdfintravaux->intervenant_be;
                    }
                }

            }

            if(!empty($users_list)) {
                $sousprojet->users_in = "|".implode("|",$users_list)."|";
            } else {
                $sousprojet->users_in = "";
            }

            $sousprojet->save();
        }
    }
}