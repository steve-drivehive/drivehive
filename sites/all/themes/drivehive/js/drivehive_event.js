jQuery(document).ready(

        function(){
            var addToCartFormId = jQuery('#doyourpart').parent().parent().attr('id');
            var match = addToCartFormId.match(/commerce-cart-add-to-cart-form-(\d+)(-\d+)?/);;
            jQuery('#' + match[0]).appendTo('#pledge-button');
            var product_id = jQuery('.event-detail-product-id').html();
            
        });