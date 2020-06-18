<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php wp_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo bloginfo('template_directory');?>/images/fav-icon.png">
    <!-- --------------------------------lib-------------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/bootstrap/nomalize.css">
    <!-- -fancy box- -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/fancybox/dist/jquery.fancybox.min.css">
    <!-- flexsilder -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/flexslider/flexslider.css">
    <!-- font -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/fontawesome/css/all.css">
    <!-- scroll bar -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/slick/disk/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/slick/disk/slick-theme.css" />
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/lib/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/customer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/style_v3.css?v=<?php echo time(); ?>">
    <?php wp_head(); ?>
</head>

<body <?php echo body_class( '' ); ?>>
    <header>
        <div id="header-page">
            <div class="sticky">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="wrap-menu">
                                <div class="navbar-button">
                                    <button type="button" class="button-sticky">
                                        <span class="icon-bar top-bar"></span>
                                        <span class="icon-bar  middle-bar"></span>
                                        <span class="icon-bar bottom-bar"></span>
                                    </button>
                                </div>
                                <div class="logo">
                                    <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo bloginfo('template_directory');?>/images/logo-buffalo.jpg" alt=""></a>
                                </div>
                                <div class="wrap-header-top">
                                    <div class="wrap-header-menu">
                                        <div class="navbar-collapse navbar-menu-mobile" id="myNavbar">
                                            <div class="navbar-sticky">
                                                <?php
                                                    $args = array(
                                                    'theme_location' => 'top-menu',
                                                    'container' => '',
                                                    'menu_id' => 'nav-scrollbar',
                                                    'menu_class' => 'nav navbar-nav'
                                                    );
                                                    wp_nav_menu( $args );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-desktop">
                                    <ul>
                                        <li><a class="phone-1" href="tel:+13038607777">303.860.7777 <i class="fas fa-sort-down"></i></a>
                                            <ul class="phone-2">
                                                <li><a href="tel:+13033937777">303.393.7777</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="phone-mobile">
                                    <a href="tel:+13038607777"><i class="fas fa-phone"></i></a>
                                </div>
                                <div class="wrap-mini-cart">
                                    <a href="<?php echo WC_Cart::get_cart_url(); ?>" class="mini-cart">
                                        <img src="<?php echo bloginfo('template_directory');?>/images/minicart.png" alt="">
                                        <span class="amount-shop"></span>
                                        <div class="cart-mini" id="cart-mini">
                                            <div class="outer-cart">
                                                <div class="main-cart-mini">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (is_front_page() || is_home()){ ?>
            <div class="banner-slide">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <div class="img-slide wow fadeInLeft">
                                <img src="<?php echo bloginfo('template_directory');?>/images/buffalo-banner-1.jpg" alt="">
                            </div>
                            <div class="text-slide wow fadeInRight">
                                <p>Fight for</p>
                                <p>the</p>
                                <p>last piece.</p>
                            </div>
                        </li>
                        <li>
                            <div class="img-slide">
                                <img src="<?php echo bloginfo('template_directory');?>/images/buffalo-banner-2.jpg" alt="">
                            </div>
                            <div class="text-slide wow fadeInRight">
                                <p>Fight for</p>
                                <p>the</p>
                                <p>last piece.</p>
                            </div>
                        </li>
                        <li>
                            <div class="img-slide">
                                <img src="<?php echo bloginfo('template_directory');?>/images/buffalo-banner-3.jpg" alt="">
                            </div>
                            <div class="text-slide wow fadeInRight">
                                <p>Fight for</p>
                                <p>the</p>
                                <p>last piece.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php }else{ ?>
            <div class="banner-page <?php if ( is_page_template('templates/gallery.php' )){
                echo (' banner-gallery');
            }?>">
                <img src="<?php the_post_thumbnail_url(); ?>">
            </div>
            <?php } ?>
        </div>
    </header>