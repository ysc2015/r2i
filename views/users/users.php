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
                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>profile</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>email</th>
                        <th class="text-center" style="width: 10%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

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
                                $profil = new Profil();
                                $profils = $profil->getAllProfils();
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
<?php if($action == "mod"): ?>
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
                                        $user = new User();
                                        $actuser = $user->getUserById($_GET['id']);
                                        $profil = new Profil();
                                        $profils = $profil->getAllProfils();
                                        foreach($profils as $key => $value) {
                                            echo '<option value="'.$value['profil_id'].'" '.($value['profil_id']==$actuser['profil_id'] ? "selected" : "").'>'.$value['profil_title'].' ('.$value['profil_abbrev'].')</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $actuser['user_id']?>">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user_firstname">Prénom <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="user_firstname" name="user_firstname" value="<?php echo $actuser['user_firstname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user_lastname">Nom <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="user_lastname" name="user_lastname" value="<?php echo $actuser['user_lastname']?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" id="email" name="email" value="<?php echo $actuser['email']?>">
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

<!-- success Modal -->
<div class="modal" id="successalert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <!-- Success Alert -->
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="font-w300 push-15">R2I</h3>
                    <p id="successmsg"></p>
                </div>
                <!-- END Success Alert -->
            </div>
        </div>
    </div>
</div>
<!-- END success Modal -->

<!-- error Modal -->
<div class="modal" id="erroralert" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <!-- Success Alert -->
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="font-w300 push-15">R2I</h3>
                    <p id="errormsg"></p>
                </div>
                <!-- END Success Alert -->
            </div>
        </div>
    </div>
</div>
<!-- END error Modal -->
