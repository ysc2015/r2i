<?php
$actions = array("list","add");
$action = (isset($_GET['action']) && in_array($_GET['action'],$actions) ? $_GET['action'] : "list");
?>
<!-- Page JS Plugins CSS -->
<?php if($action == "list"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.css"></script>
<?php endif; ?>
<?php if($action == "add"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
<?php endif; ?>
