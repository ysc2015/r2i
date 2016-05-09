<?php if($action == "list"): ?>
    <div class="content">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-8">
                    <h1 class="page-heading">
                        Liste des chambres <small>desc here</small>
                    </h1>
                </div>
                <div class="col-sm-4 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li><a class="link-effect" href="">Buttons</a></li>
                        <li>UI Elements</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                <table class="table table-bordered table-striped js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th>Nom fichier</th>
                        <th class="hidden-xs">Nom serveur</th>
                        <th class="hidden-xs">Date injection</th>
                        <th class="text-center" style="width: 10%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
<?php endif; ?>
<?php if($action == "nothing"): ?>
    <?php echo "page error request"?>
<?php endif; ?>

<!-- loader Modal -->
<div class="modal" id="loader" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="progress active" style="height: 100px;line-height: 90px;">
                    <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                        <span id="progressbar" style="margin-top: 40px;display: inline-block;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END loader Modal -->

<div id="alertbox" title="info" style="display: none;">
    <p></p>
</div>
