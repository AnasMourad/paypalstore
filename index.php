<?php 
	
	
	include("inc/config.php");
	$pageName = "Welcome to Mike's store";
	$section="home";
	include('inc/header.php');
?>

		<div class="section banner">

			<div class="wrapper">

				<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
				<div class="button">
					<a href="<?php echo URL_BASE ?>shirts.php">
						<h2>Hey, I&rsquo;m Mike!</h2>
						<p>Check Out My Shirts</p>
					</a>
				</div>
			</div>

		</div>

		<div class="section shirts latest">

			<div class="wrapper">

				<h2>Mike&rsquo;s Latest Shirts</h2>

				<?php 
				include(ROOT_PATH.'inc/products.php');
				$recent = get_recent_products();
				?>
				<ul class="products">
					
					<?php
						

						$show_list_html="";
						
						foreach ($recent as $product){
							$show_list_html = get_list_view_html($product).$show_list_html;					
						}
						echo $show_list_html;

					?>

			</div>

		</div>
<?php include(ROOT_PATH . 'inc/footer.php') ?>