<?php
/**
 * file: content.php
 * User: rabii
 */
ini_set("display_errors", "1");
include_once "inc/config.php";
include_once "language/fr/default.php";

extract($_GET);


switch ($page) {

    case "dashboard":
        /*include_once "dashboard.php";
        break;*/
    case "dashboard":
        $connectedProfil->dashboard();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "projet":
        $connectedProfil->projet();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "sousprojet":
        $connectedProfil->sousprojet();
        break;
    case "user":
        $connectedProfil->utilisateur();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "stt":
        $connectedProfil->stt();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "tablette":
        $connectedProfil->tablette();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "ot":
        $connectedProfil->ot();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "chambre":
        $connectedProfil->chambre();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    case "entreprise":
        $connectedProfil->entreprise();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
    //test purposes
    case "mailcreation":
        $connectedProfil->mailcreation();
        echo "<br><br>";//TODO style row with bottom border color -> footer
        break;
}

?>

<!-- ajouter ot Modal -->
<div class="modal fade" id="add-ot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter ordre de travail</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_ot_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="type_ot">Type Ordre de travail <span class="text-danger">*</span></label>
                                <select class="form-control" id="type_ot" name="type_ot" size="1" style="width: 100%;" data-placeholder="Séléctionner type ot..">
                                    <option value="" selected disabled>Séléctionnez type ot</option>
                                    <?php
                                    $typesot = SelectOrdreTravailType::all();
                                    foreach($typesot as $typeot) {
                                        echo "<option value=\"$typeot->id_type_ordre_travail\">$typeot->lib_type_ordre_travail</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <label for="commentaire">Commentaire <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="commentaire" name="commentaire" rows="6" placeholder="Commentaire.."></textarea>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_ot_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_ot" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter ot Modal -->

<script>
    var data_ot = {
        id_entree : '',
        type_entree : '',
        type_ot : '',
        commentaire : ''
    };
    var show_btn = undefined;
    var create_btn = undefined;
    $(document).ready(function() {
        $("#message_ot_add").hide();
        $("#save_ot").click(function() {
            console.log('add ot');
            data_ot.type_ot = $("#type_ot").val();
            data_ot.commentaire = $("#commentaire").val();
            console.log('data_ot');
            console.log(data_ot);
            $.ajax({
                method: "POST",
                url: 'api/ot/ot_add.php',
                data: data_ot
            }).done(function (msg) {
                console.log(msg);
                var obj = $.parseJSON(msg);
                if(obj.err > 0 && obj.idot > 0) {
                    alert(obj.message);
                    location.reload();
                } else {
                    if(App.showMessage(msg, '#message_ot_add')) {
                        $("#add_ot_form")[0].reset();
                        show_btn.hide();
                        create_btn.after('  <a href=\"?page=ot&idot='+obj.idot+'&idsousprojet=<?= (isset($idsousprojet) ? $idsousprojet : 0) ?>\" class=\"btn btn-info\">ouvrir ordre de travail</a>');
                    }
                }
            });
        })
    } );
</script>