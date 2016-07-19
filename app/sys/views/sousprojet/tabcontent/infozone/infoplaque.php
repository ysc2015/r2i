<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_infoplaque !== NULL) {?>
        <input type="hidden" id="id_sous_projet_plaque" name="id_sous_projet_plaque" value="<?=$sousprojet_infoplaque->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_plaque_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée info plaque crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="phase">Phase <span class="text-danger">*</span></label>
            <select class="form-control" id="phase" name="phase">
                <option value="" selected="" disabled="">Sélectionnez une phase</option>
                <?php
                $results = SelectPlaquePhase::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_plaque_phase\" ". ($sousprojet_infoplaque!==NULL && $sousprojet_infoplaque->phase==$result->id_plaque_phase ?"selected": "")." >$result->lib_plaque_phase</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="type">Type <span class="text-danger">*</span></label>
            <select class="form-control" id="type" name="type">
                <option value="" selected="" disabled="">Sélectionnez un type</option>
                <?php
                $results = SelectPlaqueType::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_plaque_type\" ". ($sousprojet_infoplaque!==NULL && $sousprojet_infoplaque->type==$result->id_plaque_type ?"selected": "")." >$result->lib_plaque_type</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_infozone_plaque" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8">
            <button id="id_sous_projet_plaque_btn" class="btn btn-primary" type="button">Enregistrer</button>
        </div>
    </div>
</form>