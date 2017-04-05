<?php

$lang['site_title'] = 'Synoptique SNK | Dashboard';
$lang['copy'] = 'Free &copy; ' . date('Y');
$lang['welcome_message'] = 'Bienvenue Synoptique SNK';

define('EMPTY_MESSAGE', 'Le champ %s est vide !');
define('DELETE_MESSAGE' , 'Mise à jour du %s est effectué avec succès');
define('ADD_MESSAGE' , 'Ajout du %s est effectué avec succès');
define('UPDATE_MESSAGE' , 'Suppression du %s est effectué avec succès');
define('MODAL_TITLE' , 'Gestion %s');
define('MODAL_DESC' , 'Ajouter/Modifier les informations %s');

// SYNO_ALVEOLE_DIAMETRE
include_once __DIR__ . '/syno_alveole_diametre.php';

// SYNO_CHAMBRE
include_once __DIR__ . '/syno_chambre.php';

// SYNO_DIAMETRE
include_once __DIR__ . '/syno_diametre.php';

// SYNO_MASQUE
include_once __DIR__ . '/syno_masque.php';

// SYNO_PASSAGE
include_once __DIR__ . '/syno_passage.php';

// SYNO_PHOTOS
include_once __DIR__ . '/syno_photos.php';

// SYNO_TRONCON
include_once __DIR__ . '/syno_troncon.php';

// SYNO_TYPE_CHAMBRE
include_once __DIR__ . '/syno_type_chambre.php';

// SYNO_TYPE_INFRA
include_once __DIR__ . '/syno_type_infra.php';

// SYNO_TYPE_RESEAU
include_once __DIR__ . '/syno_type_reseau.php';