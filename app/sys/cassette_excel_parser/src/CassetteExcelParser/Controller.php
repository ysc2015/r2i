<?php namespace CassetteExcelParser;

Class Controller{

	public function get($filePath)
	{
		if(!file_exists($filePath))
		{
			header("HTTP/1.0 404 Not Found");
			return;
		}
		else
		{
			try 
			{
				$parser = new Parser(new Reader($filePath));
				$parsed = $parser->parse($filePath);
				if($parsed)
				{
					header('Content-Type: application/json');
					header("HTTP/1.1 200 OK");
					print json_encode($parsed);
					return;
				}
				else
				{
					header("HTTP/1.0 404 Not Found");
					return;
				}
			} 
			catch (Exception $e)
			{
				header('HTTP/1.1 500'.$e->message());
			}
		}
	}
}