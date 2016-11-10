<!-- modifier type ot Modal -->
<div class="modal fade" id="mod-type-ot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier type ordre de travail</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_type_ot_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="update_lib_type_ot">Lib ordre de travail<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="update_lib_type_ot" name="update_lib_type_ot">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="update_type_entree">Etape <span class="text-danger">*</span></label>
                                <select class="form-control" id="update_type_entree" name="update_type_entree" size="1" style="width: 100%;" data-placeholder="Séléctionner type ot..">
                                    <option value="" selected>Séléctionnez type ot</option>
                                    <option value="transportaiguillage">Transport aiguillage</option>
                                    <option value="transporttirage">Transport tirage</option>
                                    <option value="distributionaiguillage">Distribution aiguillage</option>
                                    <option value="distributiontirage">Distribution tirage</option>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_type_ot_update' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_type_ot_update" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier type ot Modal -->