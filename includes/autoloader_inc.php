<?php
	spl_autoload_register('myAutoLoader'); // automaticky loadne classu kterou hodláme vytvořit funkcí myAutoLoader
	function myAutoLoader($className)		// určí classu která se má načíst 
	{
		$path = "classes/";
		$ext = "_class.php";
		$fullPath =$path.$className.$ext;

		if(!file_exists($fullPath)) // pokud se přepíšu a vytvořím objekt s classou která neexistuje: vrátí mi chybovou hlášku
		{
			return false;
		}	
		 
		include_once $fullPath;
	}
?>