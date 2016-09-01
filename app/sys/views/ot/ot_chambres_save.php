<div class="row">
    <div class="block block-themed">
        <div class="block-header bg-info">
            <ul class="block-options">
                <li>
                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                </li>
                <li>
                    <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                </li>
            </ul>
            <h3 class="block-title">Chambres de l'OT</h3>
        </div>
        <div class="block-content">
            <table id="chambre_table">
            </table>
            <div id="myid"></div>
            <div id="pager"></div>
            <!-- END Table projets -->
            <button style="margin: 10px 0px 10px 0px;" id="update_chambre_show" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> modifier chambre</button>
            <button style="margin: 10px 0px 10px 0px;" id="delete_chambre_show" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> supprimer chambre</button>
            <button style="margin: 10px 0px 10px 0px;" id="infos_terrain_show" class='btn btn-success btn-sm'><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> remontées terrain</button>
            <button style="margin: 10px 0px 10px 0px;" id="inject_file_show" class='btn btn-warning btn-sm' data-toggle="modal" data-target='#inject-file' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-circle-arrow-right'>&nbsp;</span> injecter fichier</button>
        </div>
    </div>
</div>

<!-- injecter fichier Modal -->
<div class="modal fade" id="inject-file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <h3 class="block-title">Injection fichier</h3>
                </div>
                <div class="block-content" id="inject-file-container">
                    <div class='alert alert-danger' id='message_inject_file_warning' role='alert'>
                        <p>Le fichier excel doit comporter 7 colonnes</p>
                        <p>les champs à injecter sont :</p>
                        <p>REF_CHAMBR;VILLET;SOUS-PROJET;REF_NOTE;CODE_CH1;CODE_CH2;GPS
                        </p>
                    </div>
                    <div id="fileuploader"></div>
                    <div id="inject_progress_bar" class="progress active">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Injection de fichier en cours ...</div>
                    </div>
                    <div class='alert alert-success' id='message_inject_file' role='alert'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close_injection_form1" class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-warning" id="inject_file_process" type="button"><i class="fa fa-check"></i> Injecter</button>
            </div>
        </div>
    </div>
</div>
<!-- END injecter fichier Modal -->