<!-- Page JS Plugins -->
<?php if($action == "list"): ?>
    <script src="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>
<?php endif; ?>
<!-- Page JS Code -->
<script src="<?php echo $r2i->assets_folder; ?>/js/pages/r2i.<?php echo ($activePage=="dashboard"?"dashboard":$activePage."_".$action); ?>.js.php"></script>
