<!DOCTYPE html>
<html>

	<head>
		
		<title>Libra | Deals </title>
		<link rel="stylesheet" type="text/css" href="css/deals.css">
		<link rel="stylesheet" type="text/css" href="css/hover.css">
		<link rel="stylesheet" type="text/css" href="css/ihover.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/deals.js"></script>	
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
					<li><a href="#0" class="hvr-float hvr-underline-from-center header_buttons">Deals</a></li>
					<li><a href="categories.php" class="hvr-float hvr-underline-from-center header_buttons">Categories</a></li>
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
		          			<label for="search"><i class="material-icons">search</i><input style="visibility:hidden" type="submit" value="Search" name="search"></label>
		          			<i class="material-icons">close</i>
		        		</div>
		      		</form>
		    	</div>
		  	</nav>

		</div>

		<div id="dotd">

	  		<center><h4>Top deals of the day by flipkart</h4></center>

	  		<div id="dotdcards" class="row">

		  		<?php

		  			$link = "https://affiliate-api.flipkart.net/affiliate/offers/v1/dotd/json";
					$ch = curl_init();
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					curl_setopt($ch, CURLOPT_URL, "$link");
					curl_setopt(
					    $ch, CURLOPT_HTTPHEADER,
					    array(
					        'Fk-Affiliate-Id:shariffaz',
					        'Fk-Affiliate-Token:c569d5da22704c278e90af8226c42174',
					        'Accept:application/json'
					    )
					);
					$response = curl_exec($ch);
					curl_close($ch);
					$temp = json_decode($response,true);
					// echo "<pre>" . print_r($temp,true) . "</pre>";
					$i=0;
					$data = $temp['dotdList'];
					foreach ($data as $value)
					{
						$title = $data[$i]['title']." on ".$data[$i]['description'];
						$produrl = $data[$i]['url'];
						$imgurl = $data[$i]['imageUrls']['0']['url'];

						echo '<div class="col s2">';
							echo '<div class="card medium">';
								echo '<div class="card-image">';
									echo '<img class="responsive-img" src="'.$imgurl.'">';
									echo '<span class="card-title"></span>';
								echo '</div>';
								echo '<div class="card-content">';
									echo '<p>'.$title. '<br><a href="'.$produrl.'"> See this deal... </a>' .'</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

						$i++;
					}

		  		?>

	  		</div>

	  	</div>

	  	<div id="amazon">

	  		<center><h4>Top offers from amazon</h4></center>
	  		
	  		<SCRIPT charset="utf-8" type="text/javascript" src="http://ws-in.amazon-adsystem.com/widgets/q?rt=tf_cw&ServiceVersion=20070822&MarketPlace=IN&ID=V20070822%2FIN%2Flibra0c8-21%2F8010%2Feb39c6e4-125c-47e6-8dff-05f61226b918&Operation=GetScriptTemplate"> </SCRIPT> <NOSCRIPT><A rel="nofollow" HREF="http://ws-in.amazon-adsystem.com/widgets/q?rt=tf_cw&ServiceVersion=20070822&MarketPlace=IN&ID=V20070822%2FIN%2Flibra0c8-21%2F8010%2Feb39c6e4-125c-47e6-8dff-05f61226b918&Operation=NoScript">Amazon.in Widgets</A></NOSCRIPT>

	  	</div>

	  	<div id="infibeam">

	  		<center><h4>Top offers from infibeam</h4></center>
	  		
	  		<iframe src="http://www.infibeam.com/Widget.action?site=azharu926&subTrackId=&count=3&widgetType=hot-deals&view=1&title=" width="40%" height="300px" scrolling="no" frameborder="no" onload="resizeIframe(this)"></iframe>

	  		<script language="javascript" type="text/javascript">
			  	function resizeIframe(obj) {
			    	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			  	}
			</script>

	  	</div>

	</body>

</html>