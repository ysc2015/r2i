<?php
extract($_POST);
?>
<form class="js-validation-bootstrap form-horizontal">
    <input type="hidden" id="id_sous_projet" name="id_sous_projet" value="6">
    <div class="form-group">
        <div class="col-md-3">
            <label for="dep">Département <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="dep" name="dep" readonly="" value="<?=$sousprojet->dep?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ville">Ville <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="ville" name="ville" readonly="" value="<?=$sousprojet->ville?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="plaque">Plaque <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="plaque" name="plaque" readonly="" value="<?=$sousprojet->plaque?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="zone">Zone <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="zone" name="zone" value="<?=$sousprojet->zone?>">
        </div>
    </div>
    <div class="alert alert-success" id="message_infozone_nom" role="alert" style="display: none;">

    </div>
    <div class="form-group">
        <div class="col-md-8">
            <button id="id_sous_projet_btn" class="btn btn-primary" type="button">Enregistrer</button>
        </div>
    </div>
</form>
