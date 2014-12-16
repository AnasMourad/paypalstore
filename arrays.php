<?php
	
	include("inc/products.php");
	$reverse = array_reverse($products);
	$removed = array_shift($products);
	var_dump($removed);

?>