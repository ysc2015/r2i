<?php
use PHPUnit\Framework\TestCase;
use CassetteExcelParser\Parser;
use CassetteExcelParser\Reader;

class ParserTest extends TestCase
{
  public $fixtures_folder = __DIR__.'/fixtures';

  protected function setUp()
  {
    $this->reader = new Reader($this->fixtures_folder.'/pds/PDB_PLA67_011_03002.xlsx');
    $this->parser = new Parser($this->reader);
  }

  public function testSheetsToParse(){
    $sheets = $this->parser->sheetsToParse();
    $this->assertEquals(count($sheets), 10);
  }

  public function testCableEnPassageValue(){
  	$this->assertEquals($this->parser->cableEnPassageValue(15), 'NON');
  	$this->assertEquals($this->parser->cableEnPassageValue(6), 'NON');
	}

  public function testCountOfEOfSheet(){
  	$this->assertEquals($this->parser->countOfE(5),19);
  }

}
?>