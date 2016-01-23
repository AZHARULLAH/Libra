<!DOCTYPE html>
<html>

	<head>
		
		<title>Libra | home </title>
		<meta property="og:title" content="LIBRA" /> 
		<meta property="og:type" content="Website" /> 
		<meta property="og:url" content="http://librav2.herokuapp.com"/> 
		<meta property="og:image" content="http://librav2.herokuapp.com/img/libra.png" /> 
		<meta property="og:description" content="Libra is an online product comparision site" />
		<meta name="author" content="AZHAR" />
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" type="text/css" href="css/hover.css">
		<link rel="stylesheet" type="text/css" href="css/ihover.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
		<script type="text/javascript" src="js/home.js"></script>	
		<script type="text/javascript" src="js/materialize.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" src="js/jquery.fullPage.js"></script>
		<script type="text/javascript" src="js/jquery.animateNumber.js"></script>
		<!-- <link rel="stylesheet" href="preloader/css/normalize.css"> -->
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

		<div id="toppage">

			<div class="intro">

				<div id="header_top">
					<ul id="header_menu">
						<li><a href="aboutus.php" class="hvr-float hvr-underline-from-center header_buttons">About us</a></li>
						<li><a href="deals.php" class="hvr-float hvr-underline-from-center header_buttons">Deals</a></li>
						<li><a href="categories.php" class="hvr-float hvr-underline-from-center header_buttons">Categories</a></li>
						<li><a href="#0" class="hvr-float hvr-underline-from-center header_buttons">Home</a></li>
					</ul>
				</div>

			</div>

			<div id="title">
				
				<p> <img src="img/libra.png"> Libra </p>

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

			<div id="extrainfo">
				
				<p><i>( Search for a product or category... )</i></p>

			</div>

		</div>

		<div class="clear" id="whydiv">
			
			<div id="whyhead">
				
				<center><img src="img/2.gif"></center>

			</div>

			<div id="whybody">
				
				<div id="whybody1">
					<img src="img/5.gif" width="200px">
					<center><p>2 Sites at 1 click <br> Compare & buy</p></center>
				</div>
				<div id="whybody2">
					<img src="img/1.gif" width="200px">
					<center><p>No cross-site navigation required</p></center>
				</div>
				<div id="whybody3">
					<img src="img/4.gif" width="200px">
					<center><p>Top deals of the day</p></center>
				</div>

			</div>

		</div> <br>

		<div class="clear" id="howdiv">
			
			<div id="howhead">
				
				<center><img src="img/8.gif"></center>

			</div>

			<div id="howbody">
				
				<div id="howbody1" width="200px">
					<img src="img/3.gif">
					<center><p>Use search box to find out the product</p></center>
				</div>
				<div id="howbody2" width="200px">
					<img src="img/7.gif">
					<center><p>Hit 'compare' for the desired product</p></center>
				</div>
				<div id="howbody3" width="200px">
					<img src="img/6.gif">
					<center><p>Opt for the best deal!</p></center>
				</div>

			</div>

		</div><br><br>

		<div class="clear" id="contact">
			 
			<center><h1>Contact us</h1></center>
			<div class="row">
			    <form class="col s10 offset-s1">
			      	<div class="row">
			        	<div class="input-field col s6">
			        	  	<input id="name" type="text" class="validate">
			          		<label for="name">Name</label>
			        	</div>
			        	<div class="input-field col s6">
			        	  	<input id="Email" type="email" class="validate">
			          		<label for="Email">Email id</label>
			        	</div>
			      	</div>
			      	<div class="row">
			      		<div class="input-field col s12">
				          	<textarea id="message" class="materialize-textarea" maxlength="150"></textarea>
				          	<label for="message">Message</label>
				        </div>
			      	</div>
			      	<button style="float:right" class="btn waves-effect waves-light" type="submit" name="action">Send
					    <i class="material-icons right">send</i>
					</button>
			    </form>
			</div>

		</div>

		<a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>

	</body>

</html>