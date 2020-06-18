
<?php get_header(); ?>
<?php the_post(); ?>
<main>
    <div id="page-menu">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <?php
                        $taxonomy = 'product_cat';
                        $term_args = array(
                            'post_type' => "product",
                            'hide_empty' => true,
                            'orderby' => 'term_id',
                            'order' => 'ASC',
                            'taxonomy' => $taxonomy,
                            'parent' => 0,
                            'hide_empty' => 0,
                        );
                        $tax_terms = get_terms($taxonomy, $term_args);

                        foreach ($tax_terms as $key => $value){
                            $description = get_field('description_category_custom', $taxonomy . '_' . $value->term_id);
                            if(($value->category_parent == 0)&&($value->slug != 'uncategorized')) { ?>
                    <div class="title-name-menu wow fadeInDown">
                        <p>
                            <?php echo $value->name ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                    $args_post = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'orderby'=> 'date',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'id',
                                'terms' => $value->term_id,
                                'include_children' => false
                             )
                          )
                        ); 
                 ?>
                <?php $query = new WP_Query( $args_post ); ?>
                <?php if ( $query->have_posts() ): ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php $price = get_post_meta( get_the_ID(), '_regular_price', true); ?>
                <!-- ---------category-------- -->
                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                    <div class="wrap-content-menu wow fadeIn" data-wow-delay="1s">
                        <div class="name-food">
                            <p class="name">
                                <?php the_title(); ?>
                            </p>
                            <p class="price">$<?php echo $price; ?></p>
                        </div>
                        <div class="sub-food">
                            <p><?php echo $product->get_short_description(); ?></p>
                        </div>
                        <div class="desc-food">
                            <p>
                                <?php the_content(); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
                <!-- ------------------- -->
            </div>
        </div>
        <?php } ?>
        <?php } ?>
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