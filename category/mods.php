<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<!-- materialize -->
	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- nosliderui -->
	<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
	<!-- materialize -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../js/materialize.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript" src="js/nouislider.min.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>
  	
	<title>Content Filters | CodyHouse</title>
</head>
<body>
	<header class="cd-header">
		<h1>Content Filters</h1>
	</header>

	<main class="cd-main-content">
		<div class="cd-tab-filter-wrapper">
			<div class="cd-tab-filter">
				<ul class="cd-filters">
					<li class="placeholder"> 
						<a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
					</li> 
					<li class="filter"><a id="relid" class="selected" href="#0" data-type="all">Relevance</a></li>
					<li class="filter" data-filter=".color-1"><a id="prltoh" href="#0" data-type="color-1">Price low - high</a></li>
					<li class="filter" data-filter=".color-2"><a id="prhtol" href="#0" data-type="color-2">Price high - low</a></li>
				</ul> <!-- cd-filters -->
			</div> <!-- cd-tab-filter -->
		</div> <!-- cd-tab-filter-wrapper -->

		<section class="cd-gallery">

			<?php

				$resource = $_GET['resource'];
				echo '<div class="getres" id="'.$resource.'"></div>';

			?>
	
			<div id="allcards">
		        
				<?php  

					$str = file_get_contents('https://affiliate-api.flipkart.net/affiliate/api/shariffaz.json');
					$json = json_decode($str, true);
					foreach ($json["apiGroups"]["affiliate"]["apiListings"] as $value) 
					{
						$catname = $value['availableVariants']['v0.1.0']['resourceName'];
						$link = $value['availableVariants']['v0.1.0']['get'];
						if($catname == $resource)
						{
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
							$nxturl = $data['nextUrl'];
							$i = 0;
							$j = 0;
							$allprods = [[]];
							foreach ($data['productInfoList'] as $value)
							{
								$prodid = $value['productBaseInfo']['productIdentifier']['productId'];
								$prodcat = $value['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath']['0']['0']['title'];
								$prodtitle = $value['productBaseInfo']['productAttributes']['title'];
								$proddesc = $value['productBaseInfo']['productAttributes']['productDescription'];
								if(array_key_exists('275x275',$value['productBaseInfo']['productAttributes']['imageUrls']))
								{
									$prodimgurl = $value['productBaseInfo']['productAttributes']['imageUrls']['275x275'];
								}
								else
								{
									$prodimgurl = "http://defencerealtors.com/picture/notfound.jpg";
								}
								$prodmrp = $value['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
								$prodsp = $value['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
								$produrl = $value['productBaseInfo']['productAttributes']['productUrl'];
								$prodbrand = $value['productBaseInfo']['productAttributes']['productBrand'];

								$allprods[$i] = array($prodid,$prodcat,$prodtitle,$proddesc,$prodimgurl,$prodmrp,$prodsp,$produrl,$prodbrand);

								// echo '<div class="prodbox col s2">';
								// 	echo '<div class="card medium">';
								// 		echo '<div class="card-image">';
								// 			echo '<img class="responsive-img" src="'.$prodimgurl.'">';
								// 			echo '<span class="card-title"></span>';
								// 		echo '</div>';
								// 		echo '<div class="card-content">';
								// 			echo '<p>'.$prodtitle.'</p><br>';
								// 			echo '<p>Brand : '.$prodbrand.'</p>';
								// 			echo '<p>Price : '.'<strike>'.$prodmrp.'</strike>'.$prodsp.'</p>';
								// 		echo '</div>';
								// 	echo '</div>';
								// echo '</div>';

								$i++;
								$j++;
							}


							$ch = curl_init();
							curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
							curl_setopt($ch, CURLOPT_URL, "$nxturl");
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
							$nxturl = $data['nextUrl'];
							$i = 0;
							foreach ($data['productInfoList'] as $value)
							{
								$prodid = $value['productBaseInfo']['productIdentifier']['productId'];
								$prodcat = $value['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath']['0']['0']['title'];
								$prodtitle = $value['productBaseInfo']['productAttributes']['title'];
								$proddesc = $value['productBaseInfo']['productAttributes']['productDescription'];
								if(array_key_exists('275x275',$value['productBaseInfo']['productAttributes']['imageUrls']))
								{
									$prodimgurl = $value['productBaseInfo']['productAttributes']['imageUrls']['275x275'];
								}
								else
								{
									$prodimgurl = "http://defencerealtors.com/picture/notfound.jpg";
								}
								$prodmrp = $value['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
								$prodsp = $value['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
								$produrl = $value['productBaseInfo']['productAttributes']['productUrl'];
								$prodbrand = $value['productBaseInfo']['productAttributes']['productBrand'];

								$allprods[$j] = array($prodid,$prodcat,$prodtitle,$proddesc,$prodimgurl,$prodmrp,$prodsp,$produrl,$prodbrand);

								// echo '<div class="prodbox col s2">';
								// 	echo '<div class="card medium">';
								// 		echo '<div class="card-image">';
								// 			echo '<img class="responsive-img" src="'.$prodimgurl.'">';
								// 			echo '<span class="card-title"></span>';
								// 		echo '</div>';
								// 		echo '<div class="card-content">';
								// 			echo '<p>'.$prodtitle.'</p><br>';
								// 			echo '<p>Brand : '.$prodbrand.'</p>';
								// 			echo '<p>Price : '.'<strike>'.$prodmrp.'</strike>'.$prodsp.'</p>';
								// 		echo '</div>';
								// 	echo '</div>';
								// echo '</div>';

								$i++;
								$j++;
							}
						}
					}

					// echo $i."vfs";

		  		?>

		  		<?php  

	   //    		for($k=0;$k<$j;$k++)
				// {
				// 	for($l=0;$l<9;$l++)
				// 	{
				// 		echo $allprods[$k][$l]."<br>";
				// 	}
				// 	echo "---------------<br>";
				// }

				$brandsarray = [];
				$min = 999999999;
				$max = 0;

				$l = 0;

				for($k=0;$k<$j;$k++)
				{
					if(!in_array($allprods[$k][8],$brandsarray))
					{
						$brandsarray[$l] = $allprods[$k][8];
						$l++;
					}
					if($allprods[$k][6]<$min)
					{
						$min = $allprods[$k][6];
					}
					if($allprods[$k][6]>$max)
					{
						$max = $allprods[$k][6];
					}
				}

				$minprice = $min;
				$maxprice = $max;

				// echo "Max - ".$maxprice."<br>";
				// echo "Min - ".$minprice."<br>";
				// echo "Brands<br>";
				// for($k=0;$k<$l;$k++)
				// {
				// 	echo $brandsarray[$k]."<br>";
				// }

	      	?>

		  		<iframe src="grid.php?resource=<?php echo $resource; ?>&brands=&maxprice=<?php echo $maxprice; ?>&method=relevance" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>

	      	</div>

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