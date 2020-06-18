<?php 
/*
Template Name: Menu Template
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<main>

    <!-- ------------------ -->
    <div id="page-menu">
        <div class="wrap-menu">
            <div class="container">
                <div class="row">
                    <!-- ------------list tab menu--------- -->
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="list-tab-menu">
                            <ul class="nav nav-tabs" role="tablist">
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
                                        // expect uncategorized
                                    if(($value->category_parent == 0)&&($value->slug != 'uncategorized')) { ?>
                                <li class="nav-item active ">
                                    <a class="nav-link <?php if( $key == 1 ) echo 'active '; ?>" href="#<?php echo $value->slug ?>" role="tab" data-toggle="tab">
                                        <?php echo $value->name; ?></a>
                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- ---------content menu------------ -->
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="tab-content">
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
                                        // get image cate
                                        $thumbnail_id = get_woocommerce_term_meta( $value->term_id, 'thumbnail_id', true );
                                        $image = wp_get_attachment_url( $thumbnail_id );
                                        // get description
                                        $description = get_field('description_category_custom', $taxonomy . '_' . $value->term_id);

                                        if(($value->category_parent == 0)&&($value->slug != 'uncategorized')) { ?>
                            <!-- -----start for category------ -->
                            <div role="tabpanel" class="tab-pane fade in <?php if( $key == 1 ) echo 'active '; ?> " id="<?php echo $value->slug ?>">
                                <div class="img-category">
                                    <img src="<?php  echo $image; ?>" alt="" />
                                </div>
                                <!-- ----------------section 1--------------- -->
                                <div class="section-1">
                                    <?php if($value->term_id == 16){ ?>
                                    <div class="sec1-intro">
                                        <p>All Wings are Served with</p>
                                    </div>
                                    <div class="sec1-extra">
                                        <div class="extra-left">
                                            <p>Extra Blue Cheese or Ranch Dressing or Cheddar Cheese Sauce </p>
                                            <p>Carrot or Celery</p>
                                        </div>
                                        <div class="extra-right">
                                            <p>$0.75</p>
                                            <p>$0.99</p>
                                        </div>
                                    </div>
                                    <?php } else if($value->term_id == 19){?>
                                    <div class="sec1-intro">
                                        <p>All of the following specials come with French Fries & a Drink</p>
                                    </div>
                                    <?php } ?>
                                    <!-- -----for product----- -->
                                    <div class="sec1-content">
                                        <?php 
                                                $args_post = array(
                                                    'post_type' => 'product',
                                                    'orderby'=> 'date',
                                                    'order' => 'ASC',
                                                    'posts_per_page' => -1,
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
                                        <?php 
                                            $price = get_post_meta( get_the_ID(), '_regular_price', true); 
                                            $sub = get_post_meta( get_the_ID(), 'sub', true);
                                            $regular =get_post_meta( get_the_ID(), 'regular', true);
                                            $large = get_post_meta( get_the_ID(), 'large', true);
                                        ?>
                                        <!-- ---start for -->
                                        <div class="wrap-content">
                                            <div class="name-product">
                                                <p>
                                                    <?php the_title(); ?>
                                                </p>
                                                <p class="content-product">
                                                    <?php the_content(); ?>
                                                </p>
                                            </div>
                                            <!-- ------if cate diff id 20----- -->
                                            <?php if($value->term_id != 20){ ?>
                                            <div class="wrap-prices-order">
                                                <div class="prices-product">
                                                    <?php if($sub){ ?>
                                                    <!-- if sub exist -->
                                                    <p class="only" style="margin-right: 8px;font-weight: bold;">
                                                        <?php echo ($sub); ?>
                                                    </p>
                                                    <?php } ?>
                                                    <!-- -----prices normal -->
                                                    <p>$<?php echo $regular; ?>
                                                    </p>
                                                </div>
                                                <div class="btn-add-cart">
                                                    <a href="#<?php echo get_the_id(); ?>" class="fancybox">Order <i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <?php }else if($regular){ ?>
                                            <!-- ----if produce has 2 prices -->
                                            <div class="wrap-prices-order">
                                                <div class="prices-product multi-price">
                                                    <p>R: $
                                                        <?php echo $regular; ?>
                                                    </p>
                                                    <p>L: $
                                                        <?php echo $large; ?>
                                                    </p>
                                                </div>
                                                <div class="btn-add-cart">
                                                    <a href="#<?php echo get_the_id(); ?>" class="fancybox">Order <i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <?php }else{ ?>
                                            <!-- if product has 1 prices----- -->
                                            <div class="wrap-prices-order">
                                                <div class="prices-product single-price">
                                                    <p>$
                                                        <?php echo $price; ?>
                                                    </p>
                                                </div>
                                                <div class="btn-add-cart">
                                                    <a href="#<?php echo get_the_id(); ?>" class="fancybox">Order <i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div style="display: none;" id="<?php echo get_the_ID(); ?>" class="popup-content">
                                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
                                            </div>
                                        </div>
                                        <!-- ----end for---- -->
                                        <?php endwhile; ?>
                                        <?php endif; ?>
                                        <div class="description-cate">
                                            <p>
                                                <?php echo $value->description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($value->term_id == 16) { ?>
                                <!-- ----------section 2--------------- -->
                                <div class="section-2">
                                    <div class="sec2-wrap">
                                        <div class="sec2-title">
                                            <p>Extras</p>
                                        </div>
                                        <div class="sec2-sub">
                                            <p>Per Box or Per Pound</p>
                                        </div>
                                        <div class="sec2-content">
                                            <div class="sec2-content-left">
                                                <p>Breaded .......................... $2.00</p>
                                                <p>All Flats ............................. $1.75</p>
                                            </div>
                                            <div class="sec2-content-left">
                                                <p>All Drums ...............................$1.75</p>
                                                <p>X Sauce (wet) ................... $1.75</p>
                                            </div>
                                        </div>
                                        <div class="sec2-bot">
                                            <p>2 Flavors on 12 Pieces $1</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- ----------------section 3---------------- -->
                                <div class="section-3">
                                    <div class="sec3-wrap">
                                        <div class="sec3-title">
                                            <p>FLAVORS</p>
                                        </div>
                                        <div class="sec3-content">
                                            <div class="sec3-col1">
                                                <p>Carolina Reaper <img src="<?php echo bloginfo('template_directory');?>/images/5-chill.png" alt=""></p>
                                                <p>Trinidad Scorpion <img src="<?php echo bloginfo('template_directory');?>/images/5-chill.png" alt=""></p>
                                                <p>Ghost Pepper <img src="<?php echo bloginfo('template_directory');?>/images/4-chill.png" alt=""></p>
                                                <p>XXXHot <img src="<?php echo bloginfo('template_directory');?>/images/3-chill.png" alt=""></p>
                                                <p>XXHot <img src="<?php echo bloginfo('template_directory');?>/images/2-chill.png" alt=""></p>
                                                <p>Hot <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                <p>Mild</p>
                                            </div>
                                            <div class="sec3-col2">
                                                <div class="sec3-col2-1">
                                                    <p>• BBQ Sriracha <img src="<?php echo bloginfo('template_directory');?>/images/2-chill.png" alt=""></p>
                                                    <p>• BBQ Hot <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Honey BBQ Hot <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Golden BBQ</p>
                                                    <p>• Honey BBQ</p>
                                                    <p>• BBQ</p>
                                                </div>
                                                <div class="sec3-col2-2">
                                                    <p>• Mango Habanero <img src="<?php echo bloginfo('template_directory');?>/images/2-chill.png" alt=""></p>
                                                    <p>• Honey Sriracha <img src="<?php echo bloginfo('template_directory');?>/images/2-chill.png" alt=""></p>
                                                    <p>• Jamaican Jerk <img src="<?php echo bloginfo('template_directory');?>/images/2-chill.png" alt=""></p>
                                                    <p>• Spicy Honey Garlic <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Spicy Thai Peanut Sauce <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Spicy Garlic Parmesan <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Hot and Tangy <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Rasta Gold <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Honey Hot <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                </div>
                                            </div>
                                            <div class="sec3-col3">
                                                <div class="sec3-col3-1">
                                                    <p>• Lemon and Herb Sauce <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Lemon Pepper Dry</p>
                                                    <p>• Garlic Parmesan Dry</p>
                                                    <p>• Salt and Vinegar</p>
                                                    <p>• Tennessee Whisky</p>
                                                    <p>• Breaded (Extra Cost)</p>
                                                </div>
                                                <div class="sec3-col3-2">
                                                    <p>• Spicy Teriyaki <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Singapore Hot <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Bomb Diggity <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Sweet Red Chili <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Sweet and Sour Hot <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Asian <img src="<?php echo bloginfo('template_directory');?>/images/1-chill.png" alt=""></p>
                                                    <p>• Teriyaki Pineapple</p>
                                                    <p>• Korean Glaze</p>
                                                    <p>• Singapore</p>
                                                    <p>• Sweet and Sour</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>