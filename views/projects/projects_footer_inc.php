<!-- Page JS Plugins -->
<?php if($action == "list"): ?>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/buttons.colVis.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<?php endif; ?>
<?php if($action == "add"): ?>
    <!-- Page JS Plugins -->
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<?php endif; ?>

<!-- Page JS Code -->
<script src="<?php echo $r2i->assets_folder; ?>/js/pages/r2i.<?php echo ($activePage=="dashboard"?"dashboard":$activePage."_".$action); ?>.js.php"></script>
