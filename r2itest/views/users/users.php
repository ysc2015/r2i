<?php if ($action == "list"): ?>
    <div class="content">
        <div class="block">
            <div class="block-header">
                <button type="button" class="btn btn-minw btn-default push-5-r push-10 open-add-form">
                    <i class="fa fa-plus">
                    </i> Ajouter Utilisateur
                </button>
                <h3 class="block-title">Liste des Utilisateurs</h3>
            </div>
            <div class="block-content">
                <table id="masterTable" class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>profile</th>
                        <th>prénom</th>
                        <th>nom</th>
                        <th>email</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="margin: 20px;">
            <button class="btn btn-minw btn-square btn-default open-add-form" type="button">ajouter utilisateur</button>
            <button class="btn btn-minw btn-square btn-primary linked open-edit-form" type="button" disabled>modifier utilisateur</button>
            <button class="btn btn-minw btn-square btn-danger open-delete-dialog linked" type="button" disabled>supprimer utilisateur</button>
        </div>
    </div>

    <div id="dialog-confirm" title="Supprimer utilisateur?" style="display: none;">
        <p>Etes vous sur de vouloir supprimer l'utilisateur <span class="label label-default" id="user_name"></span> ?</p>
    </div>
<?php endif; ?>
<?php if ($action == "add"): ?>
    <div class="content">
        <h2 class="content-heading">Ajout Utilisateur</h2>
        <div class="block">
            <div class="block-header">
            </div>
            <div class="block-content block-content-narrow">
                <form class="js-validation-bootstrap form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="profil_id">Profile <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <select class="form-control" id="profil_id" name="profil_id">
                                <option value="">Séléctionnez un profil</option>
                                <?php
                                $profils = ProfilPDO::getAllProfils()["data"];
                                foreach($profils as $key => $value) {
                                    echo '<option value="'.$value['profil_id'].'">'.$value['profil_title'].' ('.$value['profil_abbrev'].')</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user_firstname">Prénom <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="user_firstname" name="user_firstname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="user_lastname">Nom <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="user_lastname" name="user_lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="email">Email <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" id="email" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password1">mot de passe <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="password" id="password1" name="password1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="password2">confirmer le mot de passe <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                            <input class="form-control" type="password" id="password2" name="password2">
                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button class="btn btn-sm btn-primary" id="add-user" type="button">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if($action == "edit"): ?>
    <div class="content">
        <h2 class="content-heading">Modification Utilisateur</h2>
        <div class="block">
            <div class="block-header">
            </div>
            <div class="block-content block-content-narrow">
                    <form class="js-validation-bootstrap form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="profil_id">Profile <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <select class="form-control" id="profil_id" name="profil_id">
                                    <option value="">Séléctionnez un profil</option>
                                    <?php
                                        $profils = ProfilPDO::getAllProfils()["data"];
                                        foreach($profils as $key => $value) {
                                            echo '<option value="'.$value['profil_id'].'" '.($value['profil_id']==$user['profil_id'] ? "selected" : "").'>'.$value['profil_title'].' ('.$value['profil_abbrev'].')</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id']?>">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user_firstname">Prénom <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="user_firstname" name="user_firstname" value="<?php echo $user['user_firstname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user_lastname">Nom <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="user_lastname" name="user_lastname" value="<?php echo $user['user_lastname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="email" name="email" value="<?php echo $user['email']?>">
                            </div>
                        </div>
                    </form>
                      <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button class="btn btn-sm btn-primary" id="update-user" type="button">Valider</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if($action == "nothing"): ?>
    <?php echo "page error request"?>
<?php endif; ?>

<div id="alertbox" title="info" style="display: none;">
    <p></p>
</div>
