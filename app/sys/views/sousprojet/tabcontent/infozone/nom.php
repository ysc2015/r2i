<?php $sousprojet = SousProjet::find($idsousprojet);?>
<form class="js-validation-bootstrap form-horizontal" id="sousprojet_form" name="sousprojet_form">
    <input type="hidden" id="id_sous_projet" name="id_sous_projet" value="<?=$sousprojet->id_sous_projet?>">
    <div class="form-group">
        <div class="col-md-3">
            <label for="sp_dep">Département <span class="text-danger">*</span></label>
            <input class="form-control " type="text" id="sp_dep" name="sp_dep" readonly value="<?=$sousprojet->dep?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="sp_ville">Ville <span class="text-danger">*</span></label>
            <input class="form-control " type="text" id="sp_ville" name="sp_ville" readonly value="<?=$sousprojet->ville?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="sp_plaque">Plaque <span class="text-danger">*</span></label>
            <input class="form-control " type="text" id="sp_plaque" name="sp_plaque" readonly value="<?=$sousprojet->plaque?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="sp_zone">Zone <span class="text-danger">*</span></label>
            <input class="form-control " type="text" id="sp_zone" name="sp_zone" value="<?=$sousprojet->zone?>">
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
