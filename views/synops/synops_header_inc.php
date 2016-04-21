<?php
$actions = array("edit");
$action = (isset($_GET['action']) && in_array($_GET['action'],$actions) ? $_GET['action'] : "nothing");
switch($action) {
    case "edit" : if(isset($_GET['objtype']) && isset($_GET['objid'])) {
                    ;//TODO check ressource access here
                    //$project = ProjectPDO::getProjectbyid($_GET['projectid']);
                } else {
                    $action = "nothing";
                }
                break;
    default : $action = "nothing";break;
}
?>
<!-- Page JS Plugins CSS -->
<?php if($action == "edit"): ?>

<?php endif; ?>
