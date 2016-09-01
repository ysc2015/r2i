<?php
extract($_GET);
$ot = OrdreDeTravail::first(
    array('conditions' =>
        array("id_ordre_de_travail = ?", $idot)
    )
);
?>
<form class="js-validation-bootstrap form-horizontal" id="update_ot_form">
    <div class="form-group">
        <div class="col-md-3">
            <label for="type_entree_update">Type Ordre de travail <span class="text-danger">*</span></label>
            <select class="form-control" id="type_entree_update" name="type_entree_update" size="1" style="width: 100%;" data-placeholder="Séléctionner type ot..">
                <option value="" selected disabled>Séléctionnez type ot</option>
                <?php
                $typesot = SelectOrdreTravailType::all();
                foreach($typesot as $typeot) {
                    echo "<option value=\"$typeot->id_type_ordre_travail\" ".($ot !== NULL && $ot->type_ot == $typeot->id_type_ordre_travail ? "selected":"").">$typeot->lib_type_ordre_travail</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <label for="commentaire_update">Commentaire <span class="text-danger">*</span></label>
            <textarea class="form-control" id="commentaire_update" name="commentaire_update" rows="6" placeholder="Commentaire.."><?= ($ot !==NULL ? $ot->commentaire : "") ?></textarea>
        </div>
    </div>
    <div class='alert alert-success' id='message_ot_update' role='alert'>
    </div>
    <button class="btn btn-sm btn-primary" id="update_ot" type="button"><i class="fa fa-check"></i> Enregistrer</button>
    <br><br>
</form>