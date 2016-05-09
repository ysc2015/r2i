<?php if($action == "edit"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Synoptique
                </h1>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
                <ol class="breadcrumb push-10-t">
                    <li>UI Elements</li>
                    <li><a class="link-effect" href="">Buttons</a></li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END Page Header -->
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="block block-opt-hidden block-themed block-rounded" id="my-block">
                    <div class="block-header bg-primary">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                            </li>
                        </ul>
                        <h3 class="block-title">Edition</h3>
                    </div>
                    <div class="block-content">
                        <button class="btn btn-block btn-success push-10" type="button"><i class="fa fa-plus pull-left"></i> ajouter synoptique</button>
                        <button class="btn btn-block btn-default push-10" type="button"><i class="fa fa-pencil pull-left"></i> modifier synoptique</button>
                        <button class="btn btn-block btn-danger push-10" type="button"><i class="fa fa-times pull-left"></i> supprimer synoptique</button>
                    </div>
                </div>
            </div>
        </div>
        <iframe src="<?php echo $r2i->synops_folder."PDB_NULL_02001-BPI_NULL_02022.html"?>"
                style="height:100%;width:100%;border:2px dashed #000;margin-top: 50px;">
        </iframe>
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
