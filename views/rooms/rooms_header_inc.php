<?php
//possible actions
$actions = array("list");
$action = (isset($_GET['action']) && in_array($_GET['action'],$actions) ? $_GET['action'] : "nothing");
switch($action) {
    case "list" : if(isset($_GET['objtype'])&&isset($_GET['objid'])) {
        ;//TODO check ressource access here
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
<?php endif; ?>