<?php
$menus['plates'] = PlatesEntryPDO::getPlatesLinkByZoneId($_GET['zoneid']);

$menus['platecarto'] = PlateCartoEntryPDO::getPlateCartoLinkByZoneId($_GET['zoneid']);

$menus['plateposadr'] = PlatePosAdrEntryPDO::getPlatePosAdrLinkByZoneId($_GET['zoneid']);

$menus['platesurvadr'] = PlateSurvAdrEntryPDO::getPlateSurvAdrLinkByZoneId($_GET['zoneid']);

$menus['distdesign'] = DistDesignEntryPDO::getDistDesignLinkByZoneId($_GET['zoneid']);

$menus['distswitch'] = DistSwitchEntryPDO::getDistSwitchLinkByZoneId($_GET['zoneid']);

$menus['distcdi'] = DistCDIEntryPDO::getDistCDILinkByZoneId($_GET['zoneid']);

$menus['distprint'] = DistPrintEntryPDO::getDistPrintLinkByZoneId($_GET['zoneid']);

$menus['distconnect'] = DistConnectEntryPDO::getDistConnectLinkByZoneId($_GET['zoneid']);

$menus['distrecipe'] = DistRecipeEntryPDO::getDistRecipeLinkByZoneId($_GET['zoneid']);

$menus['transportdesign'] = TransportDesignEntryPDO::getTransportDesignLinkByZoneId($_GET['zoneid']);

$menus['transportswitch'] = TransportSwitchEntryPDO::getTransportSwitchLinkByZoneId($_GET['zoneid']);

$menus['transportctr'] = TransportCTREntryPDO::getTransportCTRLinkByZoneId($_GET['zoneid']);

$menus['transportprint'] = TransportPrintEntryPDO::getTransportPrintLinkByZoneId($_GET['zoneid']);

$menus['transportconnect'] = TransportConnectEntryPDO::getTransportConnectLinkByZoneId($_GET['zoneid']);

$menus['transportrecipe'] = TransportRecipeEntryPDO::getTransportRecipeLinkByZoneId($_GET['zoneid']);
?>
