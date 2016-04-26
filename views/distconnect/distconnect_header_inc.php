<?php
//possible actions
$actions = array("add","edit");
$action = (isset($_GET['action']) && in_array($_GET['action'],$actions) ? $_GET['action'] : "nothing");
switch($action) {
    case "add" : if(isset($_GET['zoneid'])) {
                    ;//TODO check ressource access here
                } else {
                    $action = "nothing";
                }
                break;
    case "edit" : if(isset($_GET[$activePage."id"])) {
                    ;//TODO check ressource access here
                    $distconnect = TransportSwitchEntryPDO::getTransportSwitchById($_GET[$activePage."id"]);
                } else {
                    $action = "nothing";
                }
                break;
    default : $action = "nothing";break;
}
?>
<!-- Page JS Plugins CSS -->
<?php if($action == "add"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.css"></script>
<?php endif; ?>
<?php if($action == "edit"): ?>
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo $r2i->assets_folder; ?>/js/plugins/jquery-ui/jquery-ui.min.css"></script>
<?php endif; ?>
