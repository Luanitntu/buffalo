<?php get_header(); ?>
<?php the_post(); ?>
<main>
    <div id="page-menu">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <?php 
	                    $current_category = get_queried_object(); ////getting current category
						$args = array(
					        'post_type' => 'product',// your post type,
					        'orderby' => 'post_date',
					        'order' => 'DESC',
					        'cat' => $current_category->cat_ID // current category ID
						);
						$the_query = new WP_Query($args);
						if($the_query->have_posts()):
						   while($the_query->have_posts()): $the_query->the_post();
						    echo "<h2>".the_title()."</h2>";
						    echo "<p>".the_content()."</p>";
						endwhile;
					endif;
					?>
                    <!-- -------section prev footer---------- -->
                    <div class="prev-footer-home">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                    <div class="img-prev-home">
                                        <div class="img-prev s1 wow zoomIn" data-wow-delay="0.5s">
                                            <img src="<?php echo bloginfo('template_directory');?>/img/footer-menu-1.jpg" alt="">
                                        </div>
                                        <div class="img-prev s2 wow zoomIn" data-wow-delay="1s">
                                            <img src="<?php echo bloginfo('template_directory');?>/img/footer-menu-2.jpg" alt="">
                                        </div>
                                        <div class="img-prev s3 wow zoomIn" data-wow-delay="1.5s">
                                            <img src="<?php echo bloginfo('template_directory');?>/img/footer-menu-3.jpg" alt="">
                                        </div>
                                        <div class="img-prev s4 wow zoomIn" data-wow-delay="2s">
                                            <img src="<?php echo bloginfo('template_directory');?>/img/footer-menu-4.jpg" alt="">
                                        </div>
                                        <div class="img-prev s5 wow zoomIn" data-wow-delay="2.5s">
                                            <img src="<?php echo bloginfo('template_directory');?>/img/footer-menu-5.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- --------------- -->
                </div>
</main>
<?php get_footer(); ?>