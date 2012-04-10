jQuery(document).ready(

        function(){
            	jQuery('#faq h4 a').click(function(){
                    
                //console.log('click');
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
                                                x += 4;
                                                if(x >= data){
                                                    jQuery('.goal-status').text('$' + data);
                                                    clearInterval(b);
                                                }
                                            }, 100);
                    });  
                }
            } 
        });