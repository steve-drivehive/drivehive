jQuery(document).ready(
        function(){
            driveHive = {
                getGoalStatus : function(product_id){
                    jQuery.get('/goal_status/' + product_id, function(data) {
                        jQuery('.goal-status').html(data);
                    });
                },
                initialCount : function(product_id){
                                        jQuery.get('/goal_status/' + product_id, function(data) {
                                            var x = 0;
                                            var b = setInterval(function(){
                                                jQuery('.goal-status').text('$' + x);
                                                x += 7;
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
            jQuery('#commerce-cart-add-to-cart-form-2').appendTo('#pledge-button');
            
            
            
            var product_id = jQuery('.event-detail-product-id').html();



driveHive.initialCount(product_id);
            setInterval(function(){
            
//driveHive.getGoalStatus(product_id);

 }, 
      3000);
      
      
      



        }
        );


