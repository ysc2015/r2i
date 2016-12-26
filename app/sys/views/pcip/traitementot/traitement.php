<div class="row">
    <div class="col-md-12">
        <button id="validate_start_ot" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Valider démarrage effectif des travaux</button>
    </div>
</div>
<div class='alert alert-success' id='message_ot_statut' role='alert' style="display: none;">
</div>
<br>
<button id="snk_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#snk-show' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-check'>&nbsp;</span> Compléter SNK</button>
<button id="foa_show" class='btn btn-info btn-sm' data-toggle="modal" data-target='#foa-show' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-check'>&nbsp;</span> Compléter FOA</button>
<!-- SNK Modal -->
<div class="modal fade" id="snk-show"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Menu SNK
                </div>
                <div class="block-content">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SNK Modal -->
<!-- FOA Modal -->
<div class="modal fade" id="foa-show"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button id="close-project-add-form" data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Menu FOA</h3>
                </div>
                <div class="block-content">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END FOA Modal -->
<script>
    $(function () {
        // Init page plugins & helpers
    });
    $(document).ready(function() {

        $("#validate_start_ot").click(function() {
            if(ot_dt.row('.selected').data()!== undefined) {
                setOtStatus(ot_dt.row('.selected').data().id_ordre_de_travail,5,'#message_ot_statut',ot_dt);//statut 5 : En cours de Traitement
            }
        });

    } );
</script>