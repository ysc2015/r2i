<?php
require_once __DIR__.'/vendor/autoload.php';
use \CassetteExcelParser\Controller;

$controller = new Controller();
$controller->get('/home/lenovo-f/sites/php/rc2k/cassette_excel_parser/tests/fixtures/pds/pds-NRO.xlsx');
// 
//$controller->get('/home/lenovo-f/sites/php/rc2k/cassette_excel_parser/tests/fixtures/one-sheet.xlsx');