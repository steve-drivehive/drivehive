jQuery(document).ready(
        function(){
            jQuery('#banner-front-container div:last').parent().children().first().show();
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
                homepageSlider : function(){
                    jQuery('#banner-front-container div:last').parent().children().children().first().show();
                    setInterval(function(){    
                        jQuery('#banner-front-container div:last').parent().animate({
                            left: '+=1200'
                        }, 2000, 'swing', function() {            
                            jQuery(this).parent().end().prependTo('#banner-front-container');
                            jQuery(this).css({'left': 0});
                            jQuery(this).children().children().first().hide();
                            jQuery('#banner-front-container div:last').parent().children().children().first().fadeIn('fast');
                            driveHive.swapHomePledgeLink();
                        });    
                    }, 2000);
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
                },
                swapHomePledgeLink : function(){
                             pledgeLink = jQuery('#banner-front-container div:last').parent().children().first().attr('href');
                            jQuery('#donate').attr('href', pledgeLink);
                }
               
            } 
        });