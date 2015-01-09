function creditdeduct(productid, price, variation) {
	// alertify.alert("Message");
	var r = 0;
	var msg = "Booking this bike will deduct " + price + " class from your account. Are you sure you want to book this bike? ";
	alertify.confirm(msg, function (e) {
		if (e) {
			jQuery.ajax({
				type: "post",
				url: params.homeurl+'/wp-content/plugins/simple-credits/ajax.php',
				data: 'action=buy_product&productid=' + productid + '&variationid=' + variation,
				success: function(response) {
					//alert(response);
					if (response == 0) {
						var text = "Sorry, you do not have any class credits to book a bike. Please either <a href='register/'>Register for an account</a> to receive  a free class credit, <a href='/login/'>login</a> or <a href='/pricing/'>purchase classes</a>.";
						alertify.confirm(text, function (e) {
							if (e) {
								location.href = "/pricing";				
							} else {
								location.reload();	
							}
							});
					} else if (response == 1) {
						var text = "Thank you, your bike has been booked. You will receive  an email receipt shortly.";
						alertify.log(text);
						setTimeout(function(){location.reload();}, 4000);
					
					}
				}
			})
		} else {
			
		}
	    
	});
	


}