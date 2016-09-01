<?php namespace CassetteExcelParser;

Class Reader extends \PHPExcel_Reader_Excel2007{

	private $inputFile, $loadedFile;
	
	public function __construct($inputFile)
	{
		$this->inputFile = $inputFile;
	}
	
	public function getWorksheetNames(){
		return $this->listWorksheetNames($this->inputFile);
	}

	public function getLoadedFile(){
		$this->loadedFile = ($this->loadedFile) ? $this->loadedFile : $this->load($this->inputFile) ;	
		return $this->loadedFile;
	}

	public function getCellValue($sheet_id, $cell){
		$excel_file = $this->getLoadedFile();
		$sheet = $excel_file->getSheet($sheet_id);
		return $sheet->getCell($cell)->getValue();
	}

	public function worksheetsInfos(){
		return $this->listWorksheetInfo($this->inputFile);
	}

	public function sheetTotalRows($sheetKey){
		return $this->worksheetsInfos()[$sheetKey]['totalRows'];
	}
 //        //Get worksheet dimensions
	// 	$sheet = $objPHPExcel->getSheet(0); 
	// 	$highestRow = $sheet->getHighestRow(); 
	// 	$highestColumn = $sheet->getHighestColumn();

 //        //Loop through each row of the worksheet in turn
	// 	for ($row = 1; $row <= $highestRow; $row++){ 
 //                //  Read a row of data into an array
	// 		$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
 //                //Insert into database
	// 	}
	// }
	// else{
	// 	echo "Please upload an XLSX or ODS file";
	// }
	//@Hack The excel generated from PyXl lib is name spaced and can't be opened.
	//We have to remove the namespace before reading it see https://github.com/PHPOffice/PHPExcel/issues/571 
  public function securityScan($xml)
  {
      $xml = parent::securityScan($xml);
      return str_replace(['<s:', '</s:'], ['<', '</'], $xml);
  }
}
