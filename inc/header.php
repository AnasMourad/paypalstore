<html>
<head>
	<title><?php echo $pageName; ?></title>
	<link rel="stylesheet" href="<?php echo URL_BASE; ?>css/style.css" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700" type="text/css">
	<link rel="shortcut icon" href="<?php echo URL_BASE; ?>favicon.ico">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1 class="branding-title"><a href="<?php echo URL_BASE; ?>">Shirts 4 Mike</a></h1>

			<ul class="nav">
				<li class="shirts <?php if ($section == "shirts") { echo "on"; } ?>"><a href="<?php echo URL_BASE; ?>shirts/">Shirts</a></li>
				<li class="contact <?php if ($section == "contact") { echo "on"; } ?>"><a href="<?php echo URL_BASE; ?>contact/">Contact</a></li>
				<li class="search <?php if ($section == "search") { echo "on"; } ?>"><a href="<?php echo URL_BASE; ?>search/">Search</a></li>
				<li class="cart"><a target="paypal" href="https://www.paypal.com/cgi-bin/webscr?cmd=_cart&amp;business=Q6NFNPFRBWR8S&amp;display=1">Shopping Cart</a></li>
			</ul>

		</div>

	</div>

	<div id="content">