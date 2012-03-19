jQuery(document).ready(
        function(){
           
           
           jQuery(function(){
            setInterval(function(){
            jQuery('#banner-container div:last').animate({
        left: '+=1200'
        }, 2000, 'swing', function() {
            jQuery(this).parent().end().prependTo('#banner-container');
            jQuery(this).css({'left': 0});
    });    
 }, 
      3000);
});
           
           
        });