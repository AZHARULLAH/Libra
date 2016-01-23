<!doctype html>
<html lang="en" class="no-js">
<head>

	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<!-- materialize -->
	<script type="text/javascript" src="../js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="../js/materialize.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>
	<!-- <link rel="stylesheet" href="preloader/css/normalize.css"> -->
	<link rel="stylesheet" href="preloader/css/maintop.css">
	<script src="preloader/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="preloader/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="preloader/js/main.js"></script>
  	
	<title>Libra | Category </title>
</head>
<body>

		<div id="loader-wrapper">
			<div id="loader"></div>

			<div class="loader-section section-left"></div>
	        <div class="loader-section section-right"></div>

		</div>

			<div class="row">
		        
				<?php  

					$resource = $_GET['resource'];
					$recbrands = $_GET['brands'];
					$recmaxprice = $_GET['maxprice'];
					$recmethod = $_GET['method'];

					//echo $recbrands;

					$filteredbrands = explode(".", $recbrands);
					$counterr = 0;
					foreach($filteredbrands as $ctr)
					{
						for($ctr2=0; $ctr2<strlen($ctr); $ctr2++)
						{
							if($ctr[$ctr2] == "@")
							{
								$ctr[$ctr2] = " ";	
							}
						}
						$counterr++;
					}

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

								if($recmethod == "relevance")
								{
									if(in_array($prodbrand, $filteredbrands) or $recbrands == "")
									{
										if($prodsp <= $recmaxprice)
										{
											echo '<a class="modal-trigger">';
											echo '<div class="prodbox col s2">';
												echo '<div class="card large">';
													echo '<div class="card-image">';
														echo '<img class="responsive-img" src="'.$prodimgurl.'">';
														echo '<span class="card-title"></span>';
													echo '</div>';
													echo '<div class="card-content">';
														echo '<p>'.$prodtitle.'</p><br>';
														echo '<p>Brand : '.$prodbrand.'</p>';
														echo '<p>Price : '.'<strike>'.$prodmrp.'</strike>&nbsp;'.$prodsp.'</p>';
													echo '</div>';
													echo '<div class="card-action">';
										              	echo '<a id="'.$prodid.'" class="modal-trigger greenc popup">Compare</a>';
										            echo '</div>';
												echo '</div>';
											echo '</div>';
											echo "</a>";
										}
									}
								}

								$i++;
							}

							if($recmethod == "lowtohigh")
							{
								function aasort (&$array, $key) {
								    $sorter=array();
								    $ret=array();
								    reset($array);
								    foreach ($array as $ii => $va) {
								        $sorter[$ii]=$va[$key];
								    }
								    asort($sorter);
								    foreach ($sorter as $ii => $va) {
								        $ret[$ii]=$array[$ii];
								    }
								    $array=$ret;
								}

								aasort($allprods,'6');

								foreach($allprods as $ctr)
								{
									//echo $ctr[6]." ---- ".$ctr[8]."<br>";
									if(in_array($ctr[8], $filteredbrands) or $recbrands == "")
									{
										if($ctr[6] <= $recmaxprice)
										{
											echo '<a class="modal-trigger">';
											echo '<div class="prodbox col s2">';
												echo '<div class="card large">';
													echo '<div class="card-image">';
														echo '<img class="responsive-img" src="'.$ctr[4].'">';
														echo '<span class="card-title"></span>';
													echo '</div>';
													echo '<div class="card-content">';
														echo '<p>'.$ctr[2].'</p><br>';
														echo '<p>Brand : '.$ctr[8].'</p>';
														echo '<p>Price : '.'<strike>'.$ctr[5].'</strike>&nbsp;'.$ctr[6].'</p>';
													echo '</div>';
													echo '<div class="card-action">';
										              	echo '<a id="'.$ctr[0].'" class="modal-trigger greenc popup">Compare</a>';
										            echo '</div>';
												echo '</div>';
											echo '</div>';
											echo "</a>";
										}
									}
								}
							}

							if($recmethod == "hightolow")
							{
								function aasort (&$array, $key) {
								    $sorter=array();
								    $ret=array();
								    reset($array);
								    foreach ($array as $ii => $va) {
								        $sorter[$ii]=$va[$key];
								    }
								    asort($sorter);
								    foreach ($sorter as $ii => $va) {
								        $ret[$ii]=$array[$ii];
								    }
								    $array=$ret;
								}

								aasort($allprods,'6');

								foreach(array_reverse($allprods) as $ctr)
								{
									//echo $ctr[6]." ---- ".$ctr[8]."<br>";
									if(in_array($ctr[8], $filteredbrands) or $recbrands == "")
									{
										if($ctr[6] <= $recmaxprice)
										{
											echo '<a class="modal-trigger">';
											echo '<div class="prodbox col s2">';
												echo '<div class="card large">';
													echo '<div class="card-image">';
														echo '<img class="responsive-img" src="'.$ctr[4].'">';
														echo '<span class="card-title"></span>';
													echo '</div>';
													echo '<div class="card-content">';
														echo '<p>'.$ctr[2].'</p><br>';
														echo '<p>Brand : '.$ctr[8].'</p>';
														echo '<p>Price : '.'<strike>'.$ctr[5].'</strike>&nbsp;'.$ctr[6].'</p>';
													echo '</div>';
													echo '<div class="card-action">';
										              	echo '<a id="'.$ctr[0].'" class="modal-trigger greenc popup">Compare</a>';
										            echo '</div>';
												echo '</div>';
											echo '</div>';
											echo "</a>";
										}
									}
								}
							}

							// $ch = curl_init();
							// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
							// curl_setopt($ch, CURLOPT_URL, "$nxturl");
							// curl_setopt(
			    // 			$ch, CURLOPT_HTTPHEADER,
			    // 			array(
			    //     			'Fk-Affiliate-Id:shariffaz',
			    //     			'Fk-Affiliate-Token:c569d5da22704c278e90af8226c42174',
			    //     			'Accept:application/json'
			    // 				)
							// );

							// $response = curl_exec($ch);
							// curl_close($ch);
							// $data = json_decode($response,true);
							// $nxturl = $data['nextUrl'];
							// $i = 0;
							// foreach ($data['productInfoList'] as $value)
							// {
							// 	$prodid = $value['productBaseInfo']['productIdentifier']['productId'];
							// 	$prodcat = $value['productBaseInfo']['productIdentifier']['categoryPaths']['categoryPath']['0']['0']['title'];
							// 	$prodtitle = $value['productBaseInfo']['productAttributes']['title'];
							// 	$proddesc = $value['productBaseInfo']['productAttributes']['productDescription'];
							// 	if(array_key_exists('275x275',$value['productBaseInfo']['productAttributes']['imageUrls']))
							// 	{
							// 		$prodimgurl = $value['productBaseInfo']['productAttributes']['imageUrls']['275x275'];
							// 	}
							// 	else
							// 	{
							// 		$prodimgurl = "http://defencerealtors.com/picture/notfound.jpg";
							// 	}
							// 	$prodmrp = $value['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
							// 	$prodsp = $value['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
							// 	$produrl = $value['productBaseInfo']['productAttributes']['productUrl'];
							// 	$prodbrand = $value['productBaseInfo']['productAttributes']['productBrand'];

							// 	echo '<div class="prodbox col s2">';
							// 		echo '<div class="card large">';
							// 			echo '<div class="card-image">';
							// 				echo '<img class="responsive-img" src="'.$prodimgurl.'">';
							// 				echo '<span class="card-title"></span>';
							// 			echo '</div>';
							// 			echo '<div class="card-content">';
							// 				echo '<p>'.$prodtitle.'</p><br>';
							// 				echo '<p>Brand : '.$prodbrand.'</p>';
							// 				// echo '<p>Price : '.'<strike> '.$prodmrp.' </strike>&nbsp; '.$prodsp.' </p>';
							// 			echo '</div>';
							// 		echo '</div>';
							// 	echo '</div>';

							// 	$i++;
							// }

							$brandsarray = [];
							$min = 999999999;
							$max = 0;

							$l = 0;

							for($k=0;$k<$i;$k++)
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
						}
					}

		  		?>

	      	</div>

	      	<div id="modal1" class="modal modal-fixed-footer">
			    <div class="modal-content">
		      		<!-- <iframe src="" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe> -->
		    	</div>
		    	<div class="modal-footer">
		      		<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
		    	</div>
		  	</div>

		  	<script language="javascript" type="text/javascript">
			  	function resizeIframe(obj) {
			    	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
			  	}
			</script>

			<style type="text/css">

				body
				{
					font-family: Candara !important;
				}

				.greenc
				{
					color: white !important;
					font-weight: bold !important;
				}

				.card .card-content p
				{
					color: #00695c;
				}

				.card-action
				{
					background-color: #00695c !important;
				}

				.card-action:hover
				{
					cursor: pointer;
				}

				#return-to-top {
				    position: fixed;
				    bottom: 20px;
				    right: 20px;
				    background: rgb(0, 0, 0);
				    background: rgba(0, 0, 0, 0.7);
				    width: 50px;
				    height: 50px;
				    display: block;
				    text-decoration: none;
				    -webkit-border-radius: 35px;
				    -moz-border-radius: 35px;
				    border-radius: 35px;
				    display: none;
				    -webkit-transition: all 0.3s linear;
				    -moz-transition: all 0.3s ease;
				    -ms-transition: all 0.3s ease;
				    -o-transition: all 0.3s ease;
				    transition: all 0.3s ease;
				}
				#return-to-top i {
				    color: #fff;
				    margin: 0;
				    position: relative;
				    left: 16px;
				    top: 13px;
				    font-size: 19px;
				    -webkit-transition: all 0.3s ease;
				    -moz-transition: all 0.3s ease;
				    -ms-transition: all 0.3s ease;
				    -o-transition: all 0.3s ease;
				    transition: all 0.3s ease;
				}
				#return-to-top:hover {
				    background: rgba(0, 0, 0, 0.9);
				}
				#return-to-top:hover i {
				    color: #fff;
				    top: 5px;
				}

			</style>
</body>
</html>