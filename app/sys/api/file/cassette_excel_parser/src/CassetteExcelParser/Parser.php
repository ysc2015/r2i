<?php namespace CassetteExcelParser;

Class Parser {
	
	function __construct($reader)
	{
		$this->reader = $reader;
	}

	public function sheetsToParse()
	{
		$sheets = $this->reader->getWorksheetNames();
		$sheetsToParse = array_filter($sheets, function($sheet) use($sheets)
		{
			foreach (['CDI_', 'CTR_'] as $value) 
			{
				if(strpos($sheet, $value)  !== false)
				{	
					$key = array_search($sheet, $sheets); 
					return array($key => $sheet);
				}
			}
		});
		return $sheetsToParse;
	}

	public function parse()
	{
		$sheetsToParse = $this->sheetsToParse();
		$array = [];
		foreach ($sheetsToParse as $key => $value) {
			$parsed = new \stdClass;
			$parsed->name = $value;
			$parsed->cable_en_passage = $this->cableEnPassageValue($key);
			$parsed->occurence_e = $this->CountOfE($key);
			$array[] = $parsed;
		}
		return $array;
	}

	public function cableEnPassageValue($sheetKey)
	{
		return $this->reader->getCellValue($sheetKey, 'F3');
	}

	public function CountOfE($sheetKey)
	{
		$countOfE = 0;
		$column = 'H';
		$totalRows = $this->reader->sheetTotalRows($sheetKey);
		$i = 1;
		
		while ($i < $totalRows) 
		{
			$cellValue = $this->reader->getCellValue($sheetKey, $column.$i);
			if($cellValue === 'E')
			{
				$countOfE++;
			}
			$i++;
		}
		return $countOfE;
	}

}