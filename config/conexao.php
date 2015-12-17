<?php 
	try {
		$con = new PDO("mysql: host=localhost;dbname=controle_financeiro","root","root");
		
	} catch (PDOException $e) {
		echo $e->getMessage();
		
	}
 ?>