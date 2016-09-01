<?php
use PHPUnit\Framework\TestCase;
use CassetteExcelParser\Reader;

class ReaderTest extends TestCase
{
  public $fixtures_folder = __DIR__.'/fixtures';
  
  public function setUp(){
    $inputFile = $this->fixtures_folder.'/one-sheet.xlsx';
    $this->reader = new Reader($inputFile);
  }

  public function testGetWorksheetNames()
  {  
  	$worksheetNames = $this->reader->getWorksheetNames();
  	$this->assertEquals(1, count($worksheetNames));
  	$this->assertEquals("Sheet1", $worksheetNames[0]);
  }

  public function testGetCellValue()
  {
  	$this->assertEquals('lol',$this->reader->getCellValue(0, 'a1'));
  }


}
?>