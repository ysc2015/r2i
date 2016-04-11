<?php
$actions = array("list","add","edit");
$action = (isset($_GET['action']) && in_array($_GET['action'],$actions) ? $_GET['action'] : "nothing");
switch($action) {
    case "list" : ;
        break;
    case "add" : ;
        break;
    case "edit" : if(isset($_GET['userid'])) {
        ;//TODO check ressource access here
        $user = UserPDO::getUserById($_GET['userid']);
    } else {
        $action = "nothing";
    }
        break;
    default : $action = "nothing";break;
}
?>
<!-- Page JS Plugins CSS -->
<?php if($action == "list"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.css"></script>
<?php endif; ?>
<?php if($action == "add"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.css"></script>
<?php endif; ?>
<?php if($action == "edit"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.css"></script>
<?php endif; ?>
