jQuery(document).ready(

        function(){
            	jQuery('#faq h4 a').click(function(){
                    
                console.log('click');
		var clickedPar = jQuery(this).parent().siblings('p');
		if(clickedPar.hasClass('active')){
			clickedPar.slideUp().removeClass('active');
		}else{
			jQuery('p.active').slideUp().removeClass('active');
			//$('#faq p.active').removeClass('active');
			clickedPar.slideDown();
			clickedPar.addClass('active');
		}
		return false;
	});
        
        
            driveHive = {
                getGoalStatus : function(product_id){
                    jQuery.get('/goal_status/' + product_id, function(data) {
                        jQuery('.goal-status').html('$' + data);
                    });
                },
                initialCount : function(product_id){
                                        jQuery.get('/goal_status/' + product_id, function(data) {
                                            var x = 0;
                                            var b = setInterval(function(){
                                                jQuery('.goal-status').text('$' + x);
                                                x += 28;
                                                if(x >= data){
                                                    clearInterval(b);
                                                }
                                            }, 10);

                    });
                    
                }
            }
            
            var banner = jQuery('#banner-container');
            bannerHeight = banner.height();
            bannerWidth = banner.width();
            var bannerOffset = banner.offset();
            doYourPartHeight = jQuery('#doyourpart').height();
            var addToCartFormId = jQuery('#doyourpart').parent().parent().attr('id');
            var match = addToCartFormId.match(/commerce-cart-add-to-cart-form-(\d+)(-\d+)?/);;
            console.log(match);
            jQuery('#' + match[0]).appendTo('#pledge-button');
            var product_id = jQuery('.event-detail-product-id').html();



driveHive.initialCount(product_id);
            setInterval(function(){
            
driveHive.getGoalStatus(product_id);

 }, 
      3000);
      
      
      



        }
        );


