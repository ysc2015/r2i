<!-- Page JS Plugins -->
<?php if($action == "list"): ?>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
<?php endif; ?>
<?php if($action == "add"): ?>
    <!-- Page JS Plugins -->
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/sha512.js"></script>
<?php endif; ?>
<?php if($action == "mod"): ?>
    <!-- Page JS Plugins -->
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<?php endif; ?>

