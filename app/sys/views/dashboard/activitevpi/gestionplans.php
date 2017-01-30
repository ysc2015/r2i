<div class="block block-themed" id="gestplansot_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitevpi_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Gestion des Plans – Réalisation des OT</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Réseau de Transport</h3>
                    </div>
                    <div class="block-content bg-amethyst-lighter">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="hidden-xs">Aiguillage</th>
                                <th class="hidden-xs">Tirage</th>
                                <th class="hidden-xs">Raccordement</th>
                                <th class="hidden-xs">Recette</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Sans OT</td>
                                <td class="hidden-xs">
                                    <span id="transportaiguillage1_plan_count" class="label label-warning">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="transporttirage1_plan_count" class="label label-warning">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="transportraccordement1_plan_count" class="label label-warning">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="transportrecette1_plan_count" class="label label-warning">n/d</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Avec OT sans affectation</td>
                                <td class="hidden-xs">
                                    <span id="transportaiguillage2_plan_count" class="label label-success">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="transporttirage2_plan_count" class="label label-success">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="transportraccordement2_plan_count" class="label label-success">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="transportrecette2_plan_count" class="label label-success">n/d</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Réseau de Distribution</h3>
                    </div>
                    <div class="block-content bg-amethyst-lighter">
                        <table class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="hidden-xs">Aiguillage</th>
                                <th class="hidden-xs">Tirage</th>
                                <th class="hidden-xs">Raccordement</th>
                                <th class="hidden-xs">Recette</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Sans OT</td>
                                <td class="hidden-xs">
                                    <span id="distributionaiguillage1_plan_count" class="label label-warning">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="distributiontirage1_plan_count" class="label label-warning">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="distributionraccordement1_plan_count" class="label label-warning">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="distributionrecette1_plan_count" class="label label-warning">n/d</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Avec OT sans affectation</td>
                                <td class="hidden-xs">
                                    <span id="distributionaiguillage2_plan_count" class="label label-success">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="distributiontirage2_plan_count" class="label label-success">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="distributionraccordement2_plan_count" class="label label-success">n/d</span>
                                </td>
                                <td class="hidden-xs">
                                    <span id="distributionrecette2_plan_count" class="label label-success">n/d</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </div>
</div>
<script>
    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {
        getPlansOk();

        $('body').on('click', 'span.clickable', function(e) {
            e.preventDefault();

            console.log($( this).attr('id'));

            sousprojet_dt.ajax.url( 'api/dashboard/activitevpi/sousprojet_liste.php?ide=' + $( this).attr('id')).load();

            $('#liste-subproject').modal({backdrop: 'static', keyboard: false});
        });


    } );
</script>

<?php
include_once "modals/sub_projects_liste.php";
?>