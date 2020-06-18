    <footer>
        <div id="footer">
           <?php if (is_front_page() || is_home()){ ?>
            <div class="top-footer wow jackInTheBox">
                <img src="<?php echo bloginfo('template_directory');?>/images/footer-top.png" alt="">
            </div>
            <?php } ?>

            <div class="bottom-footer <?php 
            if(!is_front_page()){
                echo ('footer-page');
            }
            if ( is_page_template('templates/gallery.php') || is_page_template('templates/contact.php') ){
                echo (' footer-gallery');
            }
            ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="wrap-bottom">
                                <div class="social wow fadeIn" data-wow-delay="1s">
                                    <ul>
                                        <li><a href="https://www.facebook.com/pages/category/American-Restaurant/Buffalo-Bills-Wings-Things-1500633420212297/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.yelp.com/biz/buffalo-bills-wings-and-things-denver-6" target="_blank"><i class="fab fa-yelp"></i></a></li>
                                        <li><a href="https://www.google.com/maps/place/Buffalo+Bills+Wings+%26+Things/@39.7399753,-104.9037775,15z/data=!4m5!3m4!1s0x0:0x88c848100de4b6c2!8m2!3d39.7399753!4d-104.9037775" target="_blank"><i class="fab fa-google"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fab fa-tripadvisor"></i></a></li>
                                    </ul>
                                </div>
                                <div class="create wow fadeIn" data-wow-delay="1.5s">
                                    <ul>
                                        <li>
                                            <p>Copyright © 2019 Buffalo Bill's Wings & Things. All Rights Reserved.</p>
                                        </li>
                                        <li>
                                            <p>Created by <a href="https://gtgplus.com/" target="_blank">GTG Marketing</a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<?php wp_footer(); ?>
<!-- jquery -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/jquery-migrate-1.4.1.js"></script>
<!-- bootstrap -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/bootstrap/bootstrap.min.js"></script>
<!-- fancy box -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/fancybox/dist/jquery.fancybox.min.js"></script>
<!-- flex-slider -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/flexslider/jquery.flexslider.js"></script>
<!-- slick -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/slick/disk/slick.min.js"></script>
<!-- wow -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/wow.min.js"></script>
<!-- scroll bar -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- lazy js -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/lib/jquery.lazy.min.js"></script>
<!-- main js -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/myscript.js"></script>
<script>
new WOW().init();
</script>
<!-- <script>
    (function($){
        jQuery(window).on("load",function(){
            jQuery(".wrap-content-menu").mCustomScrollbar();
        });
    })(jQuery);
</script> -->
</html>