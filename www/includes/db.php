<?php
	
	define('DBNAME', 'blog'),
	define('DBUSER', 'root'),
	define('DBPASS', 'damilolo')

	try{

		# prepare a new PDO instance
		$conn = new PDO("mysql:host=localhost;dbname=".DBNAME, DBUSER, DBPASS);

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
	
	}catch (PDOExecption $e){
			echo $e -> getMessage();
	}



?>