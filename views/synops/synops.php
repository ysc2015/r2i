<?php if($action == "edit"): ?>
    <!-- Page Header -->
    <div class="content bg-gray-lighter">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading">
                    Synoptiques <small>Clickable areas that are easy to recognize but perfectly match the overall design.</small>
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
        <div class="row" style="margin-bottom: 20px;margin-left: 0px;">
            <button class="btn btn-minw btn-square btn-primary linked open-upload-syn" type="button">modifier synoptique</button>
            <button class="btn btn-minw btn-square btn-danger open-delete-dialog linked" type="button">supprimer synoptique</button>
        </div>
        <iframe src="<?php echo $r2i->synops_folder."PDB_NULL_02001-BPI_NULL_02022.html"?>"
                style="height:100%;width:100%;border:2px dashed #000">
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
