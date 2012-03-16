jQuery(document).ready(
        function(){
            var banner = jQuery('#banner-container');
            bannerHeight = banner.height();
            bannerWidth = banner.width();
            var bannerOffset = banner.offset();
            doYourPartHeight = jQuery('#doyourpart').height();
            jQuery('#commerce-cart-add-to-cart-form-2').appendTo('#pledge-button');
            jQuery('#banner-container > div').hide().first().show();
            jQuery(function(){
            setInterval(function(){
            jQuery('#banner-container :first').animate({
        left: '+=1200'
        }, 2000, 'swing', function() {
            jQuery(this).parent().end().appendTo('#banner-container');
            jQuery(this).css({'left': 0}).hide();
            jQuery('#banner-container > div').hide().first().fadeIn();
    })
    
    ;

      //jQuery('#banner-container :first').fadeOut()
         //.next('#each_frontpage_slide').fadeIn()
         //.end().appendTo('#banner-container');
     
 }, 
      7000);
});


        }
        );


