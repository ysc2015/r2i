<!-- Page JS Plugins -->
<?php if($action == "add"): ?>
    <!-- Page JS Plugins -->
<?php endif; ?>

<?php if($action !== "nothing"): ?>
    <!-- Page JS Code -->
    <script src="<?php echo $r2i->assets_folder; ?>/js/pages/r2i.<?php echo ($activePage=="dashboard"?"dashboard":$activePage."_".$action); ?>.js.php"></script>
<?php endif; ?>
