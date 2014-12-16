
<?php 
	


	include('../inc/config.php');
	
	include(ROOT_PATH.'inc/products.php');
	/*CONTROLLER*/
	if(empty($_GET["pg"])){
		$current_page = 1;
	}else{
		$current_page = $_GET["pg"];
	}
	$total_products = get_product_count();
	$products_per_page = 8;
	$current_page = intval( $current_page );
	$pages = ceil($total_products/$products_per_page);
	if($current_page > $pages){
		header("Location: ./?pg=".$pages);
	}
	if($current_page < 1){
		header("Location: ./?pg=1");	
	}

	//page 2
	$start = ( ($current_page-1)* $products_per_page) +1; 
	$end = $current_page * $products_per_page;
	if($end > $total_products){
		$end = $total_products;
	}
	$products = get_products_subset($start, $end); 
	//$products = get_products_all(); 
	$pageName="Selection of Shirts";
	$section="shirts";
	include(ROOT_PATH.'inc/header.php'); ?>
	<div class="section shirts page">
		<div class="wrapper">
			<h1> Mike&rsquo;s full catalogue of tshirts</h1>
				<?php include(ROOT_PATH."inc/partial-list-navigation.html.php"); ?>
			
			<ul class="products">
				<?php 
					foreach($products as $product){
							
							echo get_list_view_html($product);					

					}
				?>
			</ul>

				<?php include(ROOT_PATH."inc/partial-list-navigation.html.php"); ?>
		</div>
	</div>
	
<?php include(ROOT_PATH.'inc/footer.php'); ?>