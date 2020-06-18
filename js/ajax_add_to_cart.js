jQuery(document).ready(function() { 

    jQuery('#custom_product').on('click', function (e) {
        e.preventDefault();

        var jQuerythisbutton = jQuery(this),
            jQueryform = jQuerythisbutton.closest('form.cart'),
            id = jQuerythisbutton.val(),
            product_qty = jQueryform.find('input[name=quantity]').val() || 1,
            product_id = jQueryform.find('input[name=product_id]').val() || id,
            variation_id = jQueryform.find('input[name=variation_id]').val() || 0;
            if ( jQueryform.find('input[name=variation_id]').length > 0 && variation_id == 0 ) { 
                alert('pick 1 option');
                return false; 
            }
            var data = {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                variation_id: variation_id,
            };
            
            jQuery(document.body).trigger('adding_to_cart', [jQuerythisbutton, data]);

            jQuery.ajax({
                type: 'post',
                url: wc_add_to_cart_params.ajax_url,
                data: data,
                beforeSend: function (response) {
                    jQuerythisbutton.removeClass('added').addClass('loading');
                },
                complete: function (response) {
                    jQuerythisbutton.addClass('added').removeClass('loading');
                    jQuery('.popup-content.fancybox-content').css('display','none');
                },
                success: function (response) {
                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    } else {
                        jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, jQuerythisbutton]);
                    }
                    jQuery('.popup-content.fancybox-content').css('display','none');
                },
            });
             return false;
    });
});

