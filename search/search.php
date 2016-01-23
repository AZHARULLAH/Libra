<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<link rel="stylesheet" type="text/css" href="css/hover.css">
	<link rel="stylesheet" type="text/css" href="css/ihover.css">
	<!-- materialize -->
	<link rel="stylesheet" type="text/css" href="css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- nosliderui -->
	<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
	<link rel="stylesheet" type="text/css" href="css/search.css">
	<!-- materialize -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/materialize.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/nouislider.min.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<!-- <link rel="stylesheet" href="preloader/css/normalize.css"> -->
	<link rel="stylesheet" href="preloader/css/main.css">
	<script src="preloader/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="preloader/js/main.js"></script>
	<link rel="shortcut icon" type="image/png" href="img/libra.png"/>
  	
	<title>Libra | Search</title>
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
				<li><a href="../aboutus.php" class="hvr-float hvr-underline-from-center header_buttons">About us</a></li>
				<li><a href="../deals.php" class="hvr-float hvr-underline-from-center header_buttons">Deals</a></li>
				<li><a href="../categories.php" class="hvr-float hvr-underline-from-center header_buttons">Categories</a></li>
				<li><a href="../index.php" class="hvr-float hvr-underline-from-center header_buttons">Home</a></li>
			</ul>
		</div>

	</div>

	<div id="sticky-anchor"></div>
		
	<div id="sticky">

		<nav>
	    	<div class="nav-wrapper">
	      		<form id="searchbar" action="search.php" method="POST">
	        		<div class="input-field col s8">
	          			<input id="search" type="search" placeholder="What are we looking for today??" name="searchbox" required>
	          			<label for="search"><i class="material-icons">search</i><input style="visibility:hidden" type="submit" value="Search" name="search"></label>
	          			<i class="material-icons">close</i>
	        		</div>
	      		</form>
	    	</div>
	  	</nav>

	</div>

	<!-- <div id="allcats">
  		
  		<ul class="collapsible" data-collapsible="accordion">

		    <li>
		      	<div class="collapsible-header"><i class="large material-icons">reorder</i>See all categories<i class="material-icons" id="rotate">play_arrow</i></div>
			      	<div class="collapsible-body">
			      		
			      		<?php  

			  				$str = file_get_contents('https://affiliate-api.flipkart.net/affiliate/api/shariffaz.json');
			  				$json = json_decode($str, true);
			  				foreach ($json["apiGroups"]["affiliate"]["apiListings"] as $value) 
							{
								$catname = $value['availableVariants']['v0.1.0']['resourceName'];
								$link = "index.php?resource=".$catname;
								echo '<div class="eachcat"><a href="'.$link.'"><i class="material-icons">label</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($catname).'</a></div>';
							}

			  			?>

			      	</div>
		    </li>
		</ul>

  	</div> -->

	<main class="cd-main-content">
		<div class="cd-tab-filter-wrapper">
			<div class="cd-tab-filter">
				<ul class="cd-filters">
					<li class="placeholder"> 
						<a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
					</li> 
					<li class="filter"><a id="relid" class="selected" href="#0" data-type="all"><b>Relevance</b></a></li>
					<li class="filter" data-filter=".color-1"><a id="prltoh" href="#0" data-type="color-1"><b>Price low - high</b></a></li>
					<li class="filter" data-filter=".color-2"><a id="prhtol" href="#0" data-type="color-2"><b>Price high - low</b></a></li>
				</ul> <!-- cd-filters -->
			</div> <!-- cd-tab-filter -->
		</div> <!-- cd-tab-filter-wrapper -->

		<section class="cd-gallery">
	
			<div id="allcards">
		        
				<?php  

					if(isset($_POST['search']))
					{
						if(!empty($_POST['searchbox']))
						{
							$query = $_POST['searchbox'];
							$actquery = $query;
							for($i=0;$i<strlen($query);$i++)
							{
								if($query[$i] == ' ')
								{
									$query[$i] = '+';	
								}
							}
							for($i=0;$i<strlen($actquery);$i++)
							{
								if($actquery[$i] == ' ')
								{
									$actquery[$i] = '$';	
								}
							}
							
							$link = "https://affiliate-api.flipkart.net/affiliate/search/json?query=" . $query . "&resultCount=20";

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

							$data = json_decode($response,true);

							$i = 0;
							$j = 0;
							$allprods = [[]];
							foreach ($data["productInfoList"] as $value)
							{
								$prodcat = $value['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath']['0']['0']['title'];
								$prodid = $value['productBaseInfo']['productIdentifier']['productId'];
								$prodtitle = $value['productBaseInfo']['productAttributes']['title'];
								$prodimgurl = $value['productBaseInfo']['productAttributes']['imageUrls']['275x275'];
								$prodmrp = $value['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
								$prodsp = $value['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
								$produrl = $value['productBaseInfo']['productAttributes']['productUrl'];
								$prodbrand = $value['productBaseInfo']['productAttributes']['productBrand'];

								$allprods[$i] = array($prodid,$prodcat,$prodtitle,$prodimgurl,$prodmrp,$prodsp,$produrl,$prodbrand);

								$i++;
								$j++;
							}

						}
					}
						
							

		  		?>

		  		<?php  

					$brandsarray = [];
					$min = 999999999;
					$max = 0;

					$l = 0;

					for($k=0;$k<$j;$k++)
					{
						if(!in_array($allprods[$k][7],$brandsarray))
						{
							$brandsarray[$l] = $allprods[$k][7];
							$l++;
						}
						if($allprods[$k][5]<$min)
						{
							$min = $allprods[$k][5];
						}
						if($allprods[$k][5]>$max)
						{
							$max = $allprods[$k][5];
						}
					}

					$minprice = $min;
					$maxprice = $max;
		      	?>

		  		<iframe src="grid.php?query=<?php echo $actquery; ?>&brands=&maxprice=<?php echo $maxprice; ?>&method=relevance" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>

	      	</div>

	      	<?php 

	      		echo "<div class='getquery' id='".$actquery."'></div>"; 

	      	?>

	      	<script language="javascript" type="text/javascript">
			  	function resizeIframe(obj) {
			    	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			  	}
			</script>

			<div class="cd-fail-message">No results found</div>
		</section> <!-- cd-gallery -->

		<div class="cd-filter">

	    	<div id="brandsfilter">

	    		<form id="filterform">

	    			<h4><i class="material-icons prefix"> list </i> Brands</h4>	    			
	    			<div id="brandfilter">
			    		<?php  

			    			for($k=0;$k<$l;$k++)
							{
								echo '<p>';
									echo '<input type="checkbox" id="test'.$k.'" />';
									echo '<label id="la'.$k.'" for="test'.$k.'">'.$brandsarray[$k].'</label>';
								echo '</p>';
							}

							echo '<div class="kvalue" id="'.$k.'"></div>';

			    		?>
	    			</div>

	    			<h4><i class="material-icons prefix"> code </i> Price</h4>
	    			<h6>(Select the upper price limit)</h6>
	    			<p class="range-field">
				      	<?php echo '<input type="range" id="test005" min="'.$minprice.'" max="'.$maxprice.'" />' ?>
				    </p>

				    <button class="btn waves-effect waves-light" type="submit" id="action">Submit
					    <i class="material-icons right">send</i>
				  	</button>
	    			
	    		</form>

	    	</div>

	    	<style type="text/css">

	    		#brandfilter
	    		{
	    			height: 300px;
	    			overflow: auto;
	    		}

	    	</style>

	    	<script type="text/javascript">

	    		$('body').on({
				    'mousewheel': function(e) {
				        if (e.target.id != 'brandfilter') return;
				        e.preventDefault();
				        e.stopPropagation();
				    }
					})

	    		$("#filterform").submit(function(e){
				    e.preventDefault();
				  });

	    	</script>

			<a href="#0" class="cd-close">Close</a>
		</div> <!-- cd-filter -->

		<a href="#0" class="cd-filter-trigger">Filters</a>
	</main> <!-- cd-main-content -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mixitup.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>