$(document).ready(function(){

	$("#action").click(function(){
		var brandsstr = ""
		var kval = $(".kvalue").attr('id');
		//alert(kval);
		for(var i=0; i<kval; i++)
		{
			var temp = $("#test"+i).is(":checked");
			if(temp==true)
			{
				var brand = $("#la"+i).text();
				for(var z=0; z< brand.length; z++)
				{
					if(brand[z] == " ")
					{
						brand[z] = "@";
					}
				}
				brandsstr = brandsstr + "." + brand;
			}
		}
		brandsstr = brandsstr.substring(1,brandsstr.length);
		var maxpricerange = $("#test005").val();
		//alert(maxpricerange);
		// var temp = $("#test0").is(":checked");
		// alert(temp);
		var getquery = $(".getquery").attr('id');
		// alert(getquery)
		var postrequrl =  "grid.php?query=" + getquery + "&brands=" + brandsstr + "&maxprice=" + maxpricerange + "&method=relevance";
		// alert(postrequrl)
		$("#allcards").empty();
		// $("#relid").click()
		$("#allcards").append('<iframe src="' + postrequrl + '" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>')
		
	})

	$("#relid").click(function(){
		var brandsstr = ""
		var kval = $(".kvalue").attr('id');
		//alert(kval);
		for(var i=0; i<kval; i++)
		{
			var temp = $("#test"+i).is(":checked");
			if(temp==true)
			{
				var brand = $("#la"+i).text();
				for(var z=0; z< brand.length; z++)
				{
					if(brand[z] == " ")
					{
						brand[z] = "@";
					}
				}
				brandsstr = brandsstr + "." + brand;
			}
		}
		brandsstr = brandsstr.substring(1,brandsstr.length);
		var maxpricerange = $("#test005").val();
		//alert(maxpricerange);
		// var temp = $("#test0").is(":checked");
		// alert(temp);
		var getquery = $(".getquery").attr('id');
		// alert(getquery)
		var postrequrl =  "grid.php?query=" + getquery + "&brands=" + brandsstr + "&maxprice=" + maxpricerange + "&method=relevance";
		// alert(postrequrl)
		$("#allcards").empty();
		$("#allcards").append('<iframe src="' + postrequrl + '" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>')
		
	})

	$("#prltoh").click(function(){
		var brandsstr = ""
		var kval = $(".kvalue").attr('id');
		//alert(kval);
		for(var i=0; i<kval; i++)
		{
			var temp = $("#test"+i).is(":checked");
			if(temp==true)
			{
				var brand = $("#la"+i).text();
				for(var z=0; z< brand.length; z++)
				{
					if(brand[z] == " ")
					{
						brand[z] = "@";
					}
				}
				brandsstr = brandsstr + "." + brand;
			}
		}
		brandsstr = brandsstr.substring(1,brandsstr.length);
		var maxpricerange = $("#test005").val();
		//alert(maxpricerange);
		// var temp = $("#test0").is(":checked");
		// alert(temp);
		var getquery = $(".getquery").attr('id');
		// alert(getquery)
		var postrequrl =  "grid.php?query=" + getquery + "&brands=" + brandsstr + "&maxprice=" + maxpricerange + "&method=lowtohigh";
		// alert(postrequrl)
		$("#allcards").empty();
		$("#allcards").append('<iframe src="' + postrequrl + '" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>')
		
	})

	$("#prhtol").click(function(){
		var brandsstr = ""
		var kval = $(".kvalue").attr('id');
		//alert(kval);
		for(var i=0; i<kval; i++)
		{
			var temp = $("#test"+i).is(":checked");
			if(temp==true)
			{
				var brand = $("#la"+i).text();
				for(var z=0; z< brand.length; z++)
				{
					if(brand[z] == " ")
					{
						brand[z] = "@";
					}
				}
				brandsstr = brandsstr + "." + brand;
			}
		}
		brandsstr = brandsstr.substring(1,brandsstr.length);
		var maxpricerange = $("#test005").val();
		//alert(maxpricerange);
		// var temp = $("#test0").is(":checked");
		// alert(temp);
		var getquery = $(".getquery").attr('id');
		// alert(getquery)
		var postrequrl =  "grid.php?query=" + getquery + "&brands=" + brandsstr + "&maxprice=" + maxpricerange + "&method=hightolow";
		// alert(postrequrl)
		$("#allcards").empty();
		$("#allcards").append('<iframe src="' + postrequrl + '" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>')

	})

	$('.modal-trigger').leanModal();

	$(".modal-trigger").click(function(){
		var params = $(this).attr('id');
		// alert(newparams);
		$(".modal-content").empty();
		$(".modal-content").append('<iframe src="modal.php?params=' + params + '" scrolling="no" frameborder="no" onload="resizeIframe(this)" width="100%"></iframe>')

	})

})