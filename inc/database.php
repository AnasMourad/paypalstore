<?php

	try{

		$db = new PDO("mysql:host=localhost;dbname=shirts4mike;","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//THROUW EXCEPTION WHEN THERE IS ERROR IN A QUERY
		//WHEN error happer other than connecting to database, It won't be cought. the upper line fix this
		$db->exec("SET NAMES 'utf8'"); // Tells the database what charset to use

	} catch(Exception $e){
		echo "Could not connect to the database";
	}

	
?>