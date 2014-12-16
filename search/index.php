<?php
	
	echo trim("      hello   "," \t");


	echo strpos("cookie", "oxco");
	require_once("../inc/config.php");
	
	$searchTerm="";
	if( isset($_GET["s"]) ){

		$searchTerm = trim($_GET["s"]);
		if($searchTerm!=""){
			require_once(ROOT_PATH."inc/products.php");
			$products = getProductsSearch($searchTerm);
			

		}
	}


	$pageName = "search";
	$section = "search";
	include(ROOT_PATH."inc/header.php");
	?>
	<div class="section shirts search page">
		<div class="wrapper">
			<h1>Search</h1>
			<form>
				<input type="text" name="s" value="<?php if(isset($searchTerm)) { echo htmlspecialchars($searchTerm); } ?>">
				<input type="submit" value="GO!">
			</form>	
			<?php 
				if($searchTerm!=""){
					if(!empty($products)){
						echo '<ul class="products">';
							foreach($products as $product){
								echo get_list_view_html($product);
							}
						echo '</ul>';
					}else{

						echo "<p> No products called <span style='color:green;'>". $searchTerm ."</span> Found!</p>";

					}
				}
			?>
		</div>
	</div>
	<?php include(ROOT_PATH."inc/footer.php");

?>