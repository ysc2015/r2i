<?php

$lang['site_title'] = 'Synoptique SNK | Dashboard';
$lang['copy'] = 'Free &copy; ' . date('Y');
$lang['welcome_message'] = 'Bienvenue Synoptique SNK';

define('EMPTY_MESSAGE', 'Le champ %s est vide !');
define('DELETE_MESSAGE' , 'Mise à jour du %s est effectué avec succès');
define('ADD_MESSAGE' , 'Ajout du %s est effectué avec succès');
define('UPDATE_MESSAGE' , 'Mise à jour du %s est effectué avec succès');
define('MODAL_TITLE' , 'Gestion %s');
define('MODAL_DESC' , 'Ajouter/Modifier les informations %s');

include_once __DIR__ . '/chambre.php';
include_once __DIR__ . '/syno_alveole.php';
include_once __DIR__ . '/syno_alveole_diametre.php';
include_once __DIR__ . '/syno_diametre.php';
include_once __DIR__ . '/syno_masque.php';

include_once __DIR__ . '/syno_passage.php';

include_once __DIR__ . '/syno_photos.php';

include_once __DIR__ . '/syno_troncon.php';

include_once __DIR__ . '/syno_type_chambre.php';

include_once __DIR__ . '/syno_type_reseau.php';

include_once __DIR__ . '/point_bloquant.php';
include_once __DIR__ . '/point_bloquant_moyens_mis_en_oeuvre.php';
include_once __DIR__ . '/point_bloquant_solutions_preconisees.php';
include_once __DIR__ . '/point_bloquant_type_de_blocage.php';