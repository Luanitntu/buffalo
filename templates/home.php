<?php 
/*
Template Name: Home Template
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
    <main>
        <div id="page-home">
            <!-- -----------section bill-------------- -->
            <div class="wrap-bills">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="bills">
                                <div class="title-bills wow fadeIn">
                                    <p>Buffalo Bill's</p>
                                    <p class="sub-title-bills">Wings & Things</p>
                                </div>
                                <div class="content-bills wow fadeIn">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -----------------section location----------- -->
            <div class="wrap-location">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="content-location">
                                <div class="location-left wow slideInLeft">
                                    <div class="address-location local-1">
                                        <p class="title-location">Capitol Hill Location</p>
                                        <p class="address-street">514 E Colfax Ave, Denver, CO 80203</p>
                                    </div>
                                    <div class="address-location local-2">
                                        <p class="title-location">Lowry Location</p>
                                        <p class="address-street">7236 E Colfax Ave, Denver, CO 80220</p>
                                    </div>
                                </div>
                                <div class="location-right wow slideInRight">
                                    <img class="img-1" src="<?php echo bloginfo('template_directory');?>/images/buffalo-location-1.jpg" alt="">
                                    <img class="img-2" src="<?php echo bloginfo('template_directory');?>/images/buffalo-location-2.jpg" alt="">
                                    <img class="img-3" src="<?php echo bloginfo('template_directory');?>/images/buffalo-location-3.jpg" alt="">
                                    <img class="img-4" src="<?php echo bloginfo('template_directory');?>/images/buffalo-location-mobile.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -------------section our menu-------------- -->
            <div class="wrap-our-menu">
                <div class="title-our-menu wow pulse">
                    <p>OUR MENU</p>
                    <p class="sub-title-our">Making people happy through delicious food.</p>
                </div>
                <div class="our-menu">
                    <!-- -----------------------MENU DESKTOP------------------------ -->
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
                            $img = get_field('image_menu', $taxonomy . '_' . $value->term_id);
                            $img_mask = get_field('image_menu_mask', $taxonomy . '_' . $value->term_id);
                        if(($value->category_parent == 0)&&($value->slug != 'uncategorized')) { 
                            if($value->term_id != 22){?>
                           
                    <div class="item-our-menu">
                        <div class="object">
                            <div class="main-img">
                                <a href="contact.php">
                                    <img src="<?php echo $img['url'];?>" alt="">
                                </a>
                            </div>
                            <div class="text-object">
                                <a href="<?php echo esc_url(home_url('menu')); ?>"><?php echo ($value->name); ?></>
                            </div>
                            <div class="mask-object <?php echo ($value->slug);?>">
                                <a href="<?php echo esc_url(home_url('menu')); ?>">
                                    <img src="<?php echo $img_mask['url'];?>" alt="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php } }?>
                    <?php } ?>
                    <!-- --------------------------------- -->
                </div>
                <!-- ------------------MENU MOBILE SLIDES-------------- -->
                <div class="wrap-slick-mobile">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="slick-mobile">
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
                                            $img = get_field('image_menu', $taxonomy . '_' . $value->term_id);
                                            $img_mask = get_field('image_menu_mask', $taxonomy . '_' . $value->term_id);
                                        if(($value->category_parent == 0)&&($value->slug != 'uncategorized')) { 
                                            if($value->term_id != 22){?>
                                           
                                    <div class="item-slick">
                                        <div class="img-cate">
                                            <a href="<?php echo esc_url(home_url('menu')); ?>"><img src="<?php echo $img['url'];?>" alt=""></a>
                                        </div>
                                        <div class="name-cate">
                                            <p><?php echo ($value->name); ?></p>
                                        </div>
                                    </div>

                                    <?php } }?>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button">
                        <a href="" class="btn-prev"></a>
                        <a href="" class="btn-next"></a>
                    </div>
                </div>
                <!-- ------------------end slick mobile-------------- -->
            </div>
        </div>
    </main>
<?php get_footer(); ?>