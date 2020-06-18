// ========================banner mobile===========================
jQuery(window).load(function() {

    if (jQuery(this).width() < 600) {
        var img_mobile = jQuery('.banner-page').find('img').attr('src');
        jQuery('.banner-page').css({
            'background-image': 'url(' + img_mobile + ')',
            'background-size': 'cover',
            'background-repeat': 'no-repeat',
            'background-position': 'center center',
            'min-height': '150px'
        });
        jQuery('.banner-page').find('img').css('display', 'none')
    }
});
// --------------button menu----------
jQuery(document).ready(function() {
    jQuery(".button-sticky").click(function() {
        jQuery("#header-page .sticky .wrap-header-top .wrap-header-menu .navbar-menu-mobile").toggleClass("active");
        jQuery("#header-page .sticky .wrap-header-top .wrap-header-menu .navbar-menu-mobile .navbar-sticky").toggleClass("active");
        jQuery("body").toggleClass("show-scroll");
    });
    jQuery(document).mouseup(function(e) {
        if (!jQuery(".button-sticky").is(e.target) && jQuery(".button-sticky").has(e.target).length === 0) {
            jQuery("#header-page .sticky .wrap-header-top .wrap-header-menu .navbar-menu-mobile").removeClass("active");
            jQuery("#header-page .sticky .wrap-header-top .wrap-header-menu .navbar-menu-mobile .navbar-sticky").removeClass("active");
            jQuery('body').removeClass('show-scroll');
        }
    });
});

// -----------------------------Fancybox menu

// -------load more

// jQuery(function() {
//     var width = jQuery(window).width();
//     if (width > 600) {
//         jQuery(".more").slice(0, 16).show();
//         jQuery("#loadMore").on('click', function(e) {
//             e.preventDefault();
//             jQuery(".more:hidden").slice(0, 8).slideDown();
//             if (jQuery(".more:hidden").length == 0) {
//                 jQuery("#load").fadeOut('slow');
//             }
//             jQuery('html,body').animate({
//                 scrollTop: jQuery(this).offset().top
//             }, 1500);
//         });
//     } else {
//         jQuery(".more").slice(0, 8).show();
//         jQuery("#loadMore").on('click', function(e) {
//             e.preventDefault();
//             jQuery(".more:hidden").slice(0, 4).slideDown();
//             if (jQuery(".more:hidden").length == 0) {
//                 jQuery("#load").fadeOut('slow');
//             }
//             jQuery('html,body').animate({
//                 scrollTop: jQuery(this).offset().top
//             }, 1500);
//         });
//     }
// });

// jQuery('a[href=#top]').click(function() {
//     jQuery('body,html').animate({
//         scrollTop: 0
//     }, 600);
//     return false;
// });

// jQuery(window).scroll(function() {
//     if (jQuery(this).scrollTop() > 1200) {
//         jQuery('.totop a').fadeIn();
//     } else {
//         jQuery('.totop a').fadeOut();
//     }
// });
jQuery(document).ready(function() {
    // -------------flexslider
    jQuery('.flexslider').flexslider({
        animation: "fade",
        animationLoop: true,
        slideshowSpeed: 4000,
        animationSpeed: 1200,
        start: function(slider) {
            var next = jQuery(".flexslider ul.slides li.flex-active-slide").next().find(".img-flex img").attr("src");
            jQuery(".banner-slider .outside-slider .img-outside").css('background-image', 'url(' + next + ')');
        },
        after: function(slider) {
            if (jQuery(".flexslider ul.slides li.flex-active-slide").is(":last-child")) {
                var next = jQuery(".flexslider ul.slides li:first-child()").find(".img-flex img").attr("src");
                jQuery(".banner-slider .outside-slider .img-outside").css('background-image', 'url(' + next + ')');
            } else {

                var next = jQuery(".flexslider ul.slides li.flex-active-slide").next().find(".img-flex img").attr("src");
                jQuery(".banner-slider .outside-slider .img-outside").css('background-image', 'url(' + next + ')');
            }
        }
        // controlsContainer:jQuery(".flex-control-nav li"),
        // customDirectionNav:jQuery(".flex-control-nav li a")
    });

    // -------button flexsider
    // jQuery(".arrow-prev").on("click", function(event) {
    //     event.preventDefault();
    //     jQuery(".flexslider").flexslider("prev");
    //     return false;
    // })
    // jQuery(".arrow-next").on("click", function(event) {
    //     event.preventDefault();
    //     jQuery(".flexslider").flexslider("next");
    //     return false;
    // })
});
// -----------------slick----------
jQuery(document).ready(function() {
    // ---------page home desktop
    // jQuery('.services-home-right').slick({
    //     autoplay: true,
    //     arrows: false,
    //     dots: true,
    //     slidesToShow: 1,
    //     draggable: false,
    //     infinite: true,
    //     pauseOnHover: false,
    //     swipe: false,
    //     touchMove: false,
    //     speed: 1500,
    //     autoplaySpeed: 5000,
    //     useTransform: true,
    //     cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    //     adaptiveHeight: true,
    //     focusOnSelect: true
    // });
    // --------page home mobile
    jQuery('.slick-mobile').slick({
        autoplay: true,
        arrows: false,
        dots: false,
        slidesToShow: 1,
        draggable: false,
        infinite: true,
        pauseOnHover: false,
        swipe: false,
        touchMove: false,
        speed: 1500,
        autoplaySpeed: 4000,
        useTransform: true,
        cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
        adaptiveHeight: true,
        focusOnSelect: true
    });

    jQuery(".btn-prev").click(function(event) {
        event.preventDefault();
        jQuery(".slick-mobile").slick("slickPrev");
    })
    jQuery(".btn-next").click(function(event) {
        event.preventDefault();
        jQuery(".slick-mobile").slick("slickNext");
    })
    // -------------page gallery
    // jQuery('.img-gallery').slick({
    //     autoplay: true,
    //     arrows: false,
    //     dots: false,
    //     slidesToShow: 1,
    //     draggable: false,
    //     infinite: true,
    //     pauseOnHover: false,
    //     swipe: false,
    //     touchMove: false,
    //     speed: 1500,
    //     autoplaySpeed: 3000,
    //     useTransform: true,
    //     cssEase: 'cubic-bezier(0.645, 0.045, 0.355, 1.000)',
    //     adaptiveHeight: true,
    //     focusOnSelect: true
    // });

    // jQuery(".button-prev").click(function(event) {
    //     event.preventDefault();
    //     jQuery(".img-gallery").slick("slickPrev");
    // })
    // jQuery(".button-next").click(function(event) {
    //     event.preventDefault();
    //     jQuery(".img-gallery").slick("slickNext");
    // })

    // jQuery('.link-slick')
    //     .on('init', function(event, slick) {
    //         jQuery('.link-slick .slick-slide.slick-current').addClass('is-active');
    //     })
    //     .slick({
    //         slidesToShow: 3,
    //         slidesToScroll: 1,
    //         dots: false,
    //         focusOnSelect: false,
    //         infinite: false,
    //     });

    // jQuery('.slick-services').on('afterChange', function(event, slick, currentSlide) {
    //     jQuery('.link-slick').slick('slickGoTo', currentSlide);
    //     var currrentNavSlideElem = '.link-slick .slick-slide[data-slick-index="' + currentSlide + '"]';
    //     jQuery('.link-slick .slick-slide.is-active').removeClass('is-active');
    //     jQuery(currrentNavSlideElem).addClass('is-active');
    // });

    // jQuery('.link-slick').on('click', '.slick-slide', function(event) {
    //     event.preventDefault();
    //     var goToSingleSlide = jQuery(this).data('slick-index');

    //     jQuery('.slick-services').slick('slickGoTo', goToSingleSlide);
    // });
});
// --------------sticky menu--------------
jQuery(document).ready(function() {
    jQuery(function() {
        var width = jQuery(window).width();
        var header = jQuery(".sticky");
        offset = header.offset().top;
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset && width > 992) {
                header.addClass("fixed");
            } else {
                header.removeClass("fixed");
            }
        })
    })
});

jQuery(document).ready(function() {


    jQuery('form.cart').each(function() {
        var current = jQuery(this);

        current.find('.qty_button.plus').click(function() {
            var tmp_plus = current.find('.qty').val();
            var next_tmp = parseInt(tmp_plus) + 1;
            current.find('#custom_product').attr('data-quantity', next_tmp);
        });

        current.find('.qty_button.minus').click(function() {
            var tmp_minus = parseInt(current.find('.qty').val());
            if (tmp_minus >= 1) {
                var prev_tmp = tmp_minus - 1;
            } else {
                var prev_tmp = 0;
            }
            current.find('#custom_product').attr('data-quantity', prev_tmp);
        });
    });

});

jQuery(window).load(function() {

    jQuery('.fancybox').fancybox({
        baseClass: 'shop-detail'
    });

    jQuery('.popup-content').each(function() {
        var current = jQuery(this);
        current.find('.price').prepend('<span class="price-cusstom-text">Price</span>');
        jQuery(this).find('.variations td.label').text('Option');
    });

    jQuery('.variations_form').each(function() {
        var current = jQuery(this);
        var variation = current.find('input[name=variation_id]').val();
        current.find('#custom_product').attr({ 'href': '/menu-shop/?add-to-cart=' + variation, 'data-product_id': variation });
        // alert(variation);
        current.find('select').change(function() {
            setTimeout(function() {
                var variation = current.find('.variation_id').val();
                current.find('#custom_product').attr({ 'href': '/menu-shop/?add-to-cart=' + variation, 'data-product_id': variation });
            }, 500);

        });
    });

    jQuery('form.cart').each(function() {
        var current = jQuery(this);
        current.find('.qty').change(function() {
            var variation = current.find('.qty').val();
            // alert(variation);
            current.find('#custom_product').attr('data-quantity', variation);
        });


        current.find('#custom_product').click(function(e) {
            if (current.find('input[name=variation_id]').val() == 0 || current.find('input[name=variation_id]').val() == '') {
                alert('Please pick 1 option.');
                return false;
            } else {
                setTimeout(function() {
                    jQuery('.fancybox-close-small').trigger('click');
                }, 1000);
            }
        });

        current.find('#alg_wc_pif_global_1').keyup(function() {
            var variation = current.find('#alg_wc_pif_global_1').val();
            // alert(variation);
            current.find('#custom_product').attr('data-hong_sku', variation);
        });

        //add Extra Product
        (function() {

            var jQuerylist = current.find('.outer-extra');
            var lists = {};
            var jQuerynewLists = jQuery();

            jQuerylist.children().each(function() {
                var city = jQuery(this).data('extra');
                if (!lists[city]) lists[city] = [];
                lists[city].push(this);
            });

            jQuery.each(lists, function(city, items) {
                var jQuerynewList = jQuery('<div class="' + city + ' inner-extra" />').prepend('<div class="group-extra">' + city + '</div>').append(items);
                jQuerynewLists = jQuerynewLists.add(jQuerynewList);
            });
            // console.log(jQuerynewLists);
            jQuerylist.replaceWith(jQuerynewLists);

        }());

        current.find('.outer-custom-extra .inner-extra').each(function() {
            jQuery(this).find('.cfwc-custom-field-wrapper').each(function() {
                // console.log(jQuery(this).find('input').val());
                jQuery(this).find('input').click(function() {
                    if (jQuery(this).is(':checked')) {
                        var name_extra = jQuery(this).attr('data-name');
                        var price_extra = jQuery(this).val();
                        var data_extra = current.find('#custom_product').attr('data-extra_item');
                        if (data_extra == '') {
                            current.find('#custom_product').attr('data-extra_item', name_extra + ',' + price_extra);
                        } else {
                            current.find('#custom_product').attr('data-extra_item', data_extra + '|' + name_extra + ',' + price_extra);
                            // console.log(result);
                        }
                    } else {
                        var name_extra = jQuery(this).attr('data-name');
                        var price_extra = jQuery(this).val();
                        var data_extra = current.find('#custom_product').attr('data-extra_item');
                        var result = data_extra.split('|');
                        // console.log(result);
                        // console.log( jQuery.inArray(name_extra+','+price_extra, result) );
                        var check = jQuery.inArray(name_extra + ',' + price_extra, result);
                        if (check != -1) {
                            var removeItem = name_extra + ',' + price_extra;
                            result = jQuery.grep(result, function(value) {
                                return value != removeItem;
                            });
                            // console.log(y);
                        }
                        var text_result = result.join("|");
                        current.find('#custom_product').attr('data-extra_item', text_result);
                        console.log(text_result);
                    }

                });
            });
        });
        /*==============================================================================================*/
        // add Flavor Product
        (function() {
            var jQuerylist = current.find('.outer-flavor');
            var lists = {};
            var jQuerynewLists = jQuery();

            jQuerylist.children().each(function() {
                var city = jQuery(this).data('flavor');
                if (!lists[city]) lists[city] = [];
                lists[city].push(this);
            });

            jQuery.each(lists, function(city, items) {
                var jQuerynewList = jQuery('<div class="' + city + ' inner-flavor" />').prepend('<div class="group-flavor">' + city + '</div>').append(items);
                jQuerynewLists = jQuerynewLists.add(jQuerynewList);
            });
            // console.log(jQuerynewLists);
            jQuerylist.replaceWith(jQuerynewLists);

        }());
        current.find('.outer-custom-flavor .inner-flavor').each(function() {
            jQuery(this).find('.cfwc-custom-field-wrapper-flavor').each(function() {
                jQuery(this).find('input').click(function() {
                    if (jQuery(this).is(':checked')) {
                        var name_flavor = jQuery(this).attr('data-name');
                        // var price_flavor = jQuery(this).val();
                        var data_flavor = current.find('#custom_product').attr('data-flavor_item');
                        if (data_flavor == '') {
                            current.find('#custom_product').attr('data-flavor_item', name_flavor /*+ ',' + price_flavor*/ );
                        } else {
                            current.find('#custom_product').attr('data-flavor_item', data_flavor + '|' + name_flavor /*+ ',' + price_flavor*/ );
                        }
                    } else {
                        var name_flavor = jQuery(this).attr('data-name');
                        var data_flavor = current.find('#custom_product').attr('data-flavor_item');
                        var result = data_flavor.split('|');
                        var check = jQuery.inArray(name_flavor /*+ ',' + price_flavor*/ , result);
                        if (check != -1) {
                            var removeItem = name_flavor /*+ ',' + price_flavor*/ ;
                            result = jQuery.grep(result, function(value) {
                                return value != removeItem;
                            });
                        }
                        var text_result = result.join("|");
                        current.find('#custom_product').attr('data-flavor_item', text_result);
                        console.log(text_result);
                    }
                });
            });
        });
        // -----------------------------------
    });
});