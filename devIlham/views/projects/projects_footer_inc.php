<!-- Page JS Plugins -->
<?php if($action == "list"): ?>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
<?php endif; ?>
<?php if($action == "add"): ?>
    <!-- Page JS Plugins -->
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<?php endif; ?>
<?php if($action == "sdfiles"): ?>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-upload-file/jquery.uploadfile.min.js"></script>
<?php endif; ?>
<?php if($action == "ajouterSousProjet"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.css">
<?php endif; ?>