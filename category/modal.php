<?php  

	// $params = $_GET['params'];
	// $params = 'Moto$G$(3rd$Generation)__Motorola__12999__10999';
	// echo $params."<br>";
	// $paramarray = explode('__', $params);
	// $fliptitle = $paramarray[0];
	// $flipbrand = $paramarray[1];
	// $flipmrp = $paramarray[2];
	// $flipsp = $paramarray[3];

	error_reporting(0);

	$flipid = $_GET['params'];
	//$flipid = "MOBE26K6ZSYBHGRY";	

	$link = "https://affiliate-api.flipkart.net/affiliate/product/json?id=" . $flipid;

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

	// work with $response here:
	$data = json_decode($response,true);

	// echo '<pre>' . print_r($data, true) . '</pre>';

	$fliptitle = $data['productBaseInfo']['productAttributes']['title'];
	$flipdesc = $data['productBaseInfo']['productAttributes']['productDescription'];
	$flipimgurl = $data['productBaseInfo']['productAttributes']['imageUrls']['275x275'];
	$flipmrp = $data['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
	$flipsp = $data['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
	$flipurl = $data['productBaseInfo']['productAttributes']['productUrl'];

	// echo "Title - ".$fliptitle."<br>";
	// echo "Brand - ".$flipdesc."<br>";
	// echo "Image - ".$flipimgurl."<br>";
	// echo "MRP - ".$flipmrp."<br>";
	// echo "SP - ".$flipsp."<br><br><br>";
	// echo "Url - ".$flipurl."<br>";

	$i = 0;  
	$j = 0; 
	$allprods = [[]];
	$pricediff = [];

	for($i=1;$i<6;$i++)
	{
		$aws_access_key_id = "AKIAIVHGCP277VB46DMA";
		$aws_secret_key = "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";
		$endpoint = "webservices.amazon.in";
		$uri = "/onca/xml";
		$params = array(
		    "Service" => "AWSECommerceService",
		    "Operation" => "ItemSearch",
		    "AWSAccessKeyId" => "AKIAIVHGCP277VB46DMA",
		    "AssociateTag" => "libra0c8-21",
		    "SearchIndex" => "All",
		    "ResponseGroup" => "Images,ItemAttributes,Offers,OfferSummary",
		    "Version" => "2011-08-01",
		    "Keywords" => "$fliptitle",
		    "ItemPage" => "$i"
		);
		if (!isset($params["Timestamp"])) {
		    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
		}
		ksort($params);
		$pairs = array();
		foreach ($params as $key => $value) {
		    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
		}
		$canonical_query_string = join("&", $pairs);
		$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
		$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));
		$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

		$xml = simplexml_load_file($request_url);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		//echo '<pre>' . print_r($array, true) . '</pre>';
		
		if(!array_key_exists('Item', $array['Items']))
		{
			//echo "****not exists<br>";
			break;
		}

		foreach($array['Items']['Item'] as $ctr)
		{
		    $produrl = $ctr['DetailPageURL'];
		    $prodimgurl = $ctr['MediumImage']['URL'];
		    $prodbrand = $ctr['ItemAttributes']['Brand'];
		    if(array_key_exists("ListPrice", $ctr['ItemAttributes']))
		    {
		        $prodmrp = $ctr['ItemAttributes']['ListPrice']['Amount'] / 100;
		    }
		    else
		    {
		        $prodmrp = -101;
		    }
		    $prodtitle = $ctr['ItemAttributes']['Title'];
		    $prodsp = $ctr['OfferSummary']['LowestNewPrice']['Amount'] / 100;

		    $allprods[$j] = array($prodimgurl,$prodbrand,$prodmrp,$prodtitle,$prodsp,$produrl);
		    if($prodmrp == -101)
		    {
		    	$pricediff[$j] = abs($prodsp - $flipsp);
		    }
		    else
		    {
		    	$pricediff[$j] = abs($prodmrp - $flipmrp);
		    }

		    // echo "No - ".$j."<br>";
		    // echo "Prod img url - ".$prodimgurl."<br>";
		    // echo '<img src="'.$prodimgurl.'">'."<br>";
		    // echo "Prod brand - ".$prodbrand."<br>";
		    // echo "Prod mrp - ".$prodmrp."<br>";
		    // echo "Prod title - ".$prodtitle."<br>";
		    // echo "Prod sp - ".$prodsp."<br>";
		    // echo "Produrl - ".$produrl."<br>";
		    // echo "*******diff - ".$pricediff[$j]."<br><br><br>";

		    $j++;
		}
	}

	$mindiffkey = array_keys($pricediff,min($pricediff))[0];
	
	// echo "<br><br>";
	$amurl = $allprods[$mindiffkey][5];

?>

<!doctype html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<!-- <link rel="stylesheet" href="css/style.css"> -->
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
	<!-- <link rel="stylesheet" href="preloader/css/normalize.css"> -->
	<link rel="stylesheet" href="preloader/css/main.css">
	<script src="preloader/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="preloader/js/main.js"></script>
	<title><?php echo "$fliptitle"; ?></title>
	<link rel="shortcut icon" type="image/png" href="img/libra.png"/>

</head>

<body>

	<div id="loader-wrapper">
		<div id="loader"></div>

		<div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

	</div>
	
	<center> <h3 style="font-family: Copperplate, 'Copperplate Gothic Light';font-weight:bold;"><?php echo $fliptitle ?> </h3> </center>

	<div id="desc" class="clear">
		
		<img id="prodimg" src= <?php echo "$flipimgurl"; ?> >
		<div id="proddesc"> <center><h4>Product description</h4></center> <p> <?php

			if($flipdesc != "")
			{
			 	echo $flipdesc; 
			}
			else
			{
				echo "<center>Product description not available...</center>";
			}
		?>

		</p></div>
	
	</div>

  	<div id="deal" class="clear">
  		
  		<center> <h4 style="font-family: Copperplate, 'Copperplate Gothic Light';font-weight:bold;">Deal</h4> </center>

  		<table style="width:100%">
		  	
		  	<tr>
		    	<td><img style="float:right" id="logoleft" src="img/flipkart.png"></td>
		    	<td><img style="float:left" id="logoright" src="img/amazon.png"></td> 
		  	</tr>
		  	
		  	<tr>
		    	<td><p class="pricespec">Rs. <?php echo $flipsp; ?></p></td>
		    	<?php  

		  			if($amurl == "")
		  			{
		  				echo '<td><p class="pricespec">Not available</p></td>';
		  			}
		  			else
		  			{
		  				echo '<td><p class="pricespec">Rs. '. $allprods[$mindiffkey][4] .'</p></td>';
		  			}

		  		?>
		  	</tr>

		  	<tr>
		  		<td><center><a target="_blank" href= <?php echo "$flipurl"; ?> class="waves-effect waves-light btn-large"><i class="material-icons right"><img class="flipimg" src="img/flipkartsm.png"></i>Grab this</a></center></td>
		  		<?php  

		  			if($amurl == "")
		  			{
		  				echo '<td><center><a class="waves-effect waves-light btn-large disabled"><i class="material-icons left"><img class="amazonimg" src="img/amazonsm.png"></i>Grab this</a></center></td>';
		  			}
		  			else
		  			{
		  				echo '<td><center><a target="_blank" href= "'. $amurl .'" class="waves-effect waves-light btn-large"><i class="material-icons left"><img class="amazonimg" src="img/amazonsm.png"></i>Grab this</a></center></td>';
		  			}

		  		?>
			</tr>
		
		</table>

  	</div>

  	<style type="text/css">

  		body
  		{
  			font-family: Candara !important;
  		}

	  	#prodimg
	  	{
	  		margin-top: 5%;
	  		float: left;
	  		margin-left: 5%;
	  	}

	  	#proddesc
	  	{
	  		max-width: 50%;
	  		/*float: right;*/
	  		max-height: 600px;
	  		margin-left: 30%;
	  		margin-top: 5%;
	  		border: 2px soild black;
	  	}

	  	#proddesc p
	  	{
	  		float: left;
	  		font-size: 19px;
	  	}

	  	#logoleft, #logoright
	  	{
	  		width: 300px;
	  	}

	  	#logoleft
	  	{
	  		float: left;
	  	}

	  	#logoright
	  	{
	  		float: right;
	  	}

	  	#deal
	  	{
		    padding: 50px 50px 50px 50px;
	  		max-width: 700px;
	  		margin-left: 25%;
	  		margin-top: 15%;
	  	}

	  	.clear
	  	{
	  		clear: both;
	  	}

	  	table 
	  	{
		    border-collapse: collapse;
		}

		table p
		{
			text-align: center;
		}

	  	a i img.flipimg
	  	{
	  		margin-top: 3px;
	  		height: 50px;
	  		width: 50px;
	  		margin-right: -30px;
	  	}

	  	a i img.amazonimg
	  	{
	  		margin-top: 3px;
	  		height: 50px;
	  		width: 50px;
	  		margin-left: -30px;
	  	}

	  	.pricespec
	  	{
	  		font-size: 40px;
	  		color: #00695c;
	  	}

	  	table td + td 
	  	{ 
	  		border-left:3px solid gray; 
	  	}

  	</style>

</body>

</html>