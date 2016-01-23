<!DOCTYPE html>
<html>

	<head>
		
		<title>Libra | Categories </title>
		<link rel="stylesheet" type="text/css" href="css/categories.css">
		<link rel="stylesheet" type="text/css" href="css/hover.css">
		<link rel="stylesheet" type="text/css" href="css/ihover.css">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/categories.js"></script>	
		<script type="text/javascript" src="js/materialize.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" src="js/jquery.fullPage.js"></script>
		<script type="text/javascript" src="js/jquery.animateNumber.js"></script>
		<link rel="stylesheet" href="preloader/css/normalize.css">
		<link rel="stylesheet" href="preloader/css/main.css">
		<script src="preloader/js/vendor/modernizr-2.6.2.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="preloader/js/main.js"></script>
		<link rel="shortcut icon" type="image/png" href="img/libra.png"/>

	</head>

	<body>

		<div id="loader-wrapper">
			<div id="loader"></div>

			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

		</div>

		<div class="intro">

			<div id="header_top">
				<ul id="header_menu">
					<li><a href="aboutus.php" class="hvr-float hvr-underline-from-center header_buttons">About us</a></li>
					<li><a href="deals.php" class="hvr-float hvr-underline-from-center header_buttons">Deals</a></li>
					<li><a href="#0" class="hvr-float hvr-underline-from-center header_buttons">Categories</a></li>
					<li><a href="index.php" class="hvr-float hvr-underline-from-center header_buttons">Home</a></li>
				</ul>
			</div>

		</div>

		<div id="sticky-anchor"></div>
			
		<div id="sticky">
		
			<nav>
		    	<div class="nav-wrapper">
		      		<form id="searchbar" action="search/search.php" method="POST">
		        		<div class="input-field col s8">
		          			<input id="search" type="search" placeholder="What are we looking for today??" name="searchbox" required>
		          			<label for="search"><input style="visibility:hidden" type="submit" value="Search" name="search"></label>
		          			<!-- <i class="material-icons">close</i> -->
		        		</div>
		      		</form>
		    	</div>
		  	</nav>

		</div>

		<div id="categories">

			<center><h4>Choose from a wide range of categories</h4></center>
			
			<?php

				$str = file_get_contents('https://affiliate-api.flipkart.net/affiliate/api/shariffaz.json');
				$json = json_decode($str, true);
				foreach ($json["apiGroups"]["affiliate"]["apiListings"] as $value)
				{
					$catname = $value['availableVariants']['v0.1.0']['resourceName'];
					$link = "category/index.php?resource=".$catname;
					echo '<div class="eachcat"><a href="'.$link.'">'.strtoupper($catname).'</a></div>';
				}

			?>

		</div>

	</body>

</html>