<?php


	
	include("../inc/config.php");
	include(ROOT_PATH.'inc/products.php');
	$products = get_products_all();
	
	if(isset($_GET["id"])){

		$product_id = intval($_GET["id"]);
		$product = get_product_single($product_id);

	}
	if(empty($product)){//INSTEAD OF == FALSE we use empty()
		header("Location: ".URL_BASE. "shirts/");
		exit;
	}

	

	$pageName="Selection of Shirts";
	$section="shirts";
	
	include(ROOT_PATH.'inc/header.php');
?>
	<div class="section page">
		
		<div class="wrapper">

			<div class="breadcrumb"><a href="<?php echo URL_BASE; ?>shirts/">Tshirts</a>&gt;<?php echo $product["name"]?> </div>
			<div class="shirt-picture">
			
				<span>
					<img src="<?php echo URL_BASE.$product["img"]; ?> " alt="">
				</span>
			</div>
				<div class="shirt-details">
					<h1> <span class="price"> $<?php echo $product["price"]; ?> </span> <?php echo $product["name"] ?> </h1>
					<?php
					echo payPalMe($product); ?>

			</div>
			</div>
		</div>
	
	</div>
	<?php include(ROOT_PATH.'inc/footer.php'); ?>
	
