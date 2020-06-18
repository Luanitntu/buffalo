<?php

//add feature image page
add_theme_support( 'post-thumbnails' );
add_post_type_support( 'page', 'excerpt' );

//add menu
add_theme_support('menus');
function register_my_menus() {
    $args = array( 
    'top-menu' => __( 'Top Menu' ),
    // 'menu-sub' => __( 'Sub Menu' ),
    );
    register_nav_menus( $args );
}
add_action( 'init', 'register_my_menus' );

// add class menu li 
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
function add_additional_class_on_li($classes, $item, $args) {
    if($args->add_li_class) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );
function wpse156165_menu_add_class( $atts, $item, $args ) {
    $class = 'nav-link'; // or something based on $item
    $atts['class'] = $class;
    return $atts;
}

//hook class active li in menu
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

function php_text($text) {
  if (strpos($text, '<' . '?') !== false) {
        ob_start();
        eval('?' . '>' . $text);
        $text = ob_get_contents();
        ob_end_clean();
    }
    return $text;
}
// remove tag a in content
remove_filter( 'the_content', 'wpautop' );

// ---- need and important for woocomerce
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_action('category_template', 'use_single_for_one_category');
function use_single_for_one_category($template = '') {
  global $wp_query;
    if ( 1 === (int) $wp_query->post_count ) {
      $template = get_single_template();
    }
  return $template;
}

// --------get description product woocom
function woocommerce_after_shop_loop_item_title_short_description() {
    global $product;
    if ( ! $product->get_short_description() ) return;
    ?>
    <div itemprop="description">
        <?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>
    </div>
    <?php
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);

function vitahc_excerpt_in_product_archives() {
  the_excerpt();
}
add_action('woocommerce_after_shop_loop_item_title','vitahc_excerpt_in_product_archives', 10);

 
add_filter( 'default_checkout_billing_country', 'bbloomer_change_default_checkout_country' );
 
function bbloomer_change_default_checkout_country() {
  return 'US'; 
}

//hook redirect thank you page
add_action( 'wp_footer', 'redirect_cf7' );
function redirect_cf7() {
?>
    <script type="text/javascript">
        document.addEventListener( 'wpcf7mailsent', function( event ) {
           if ( '11' == event.detail.contactFormId ) {
              location = '<?php echo esc_url( home_url( '/thank-you' ) ); ?>';
            }
        }, false );
    </script>
<?php
}

add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
  ?>
  <script type='text/javascript'>
  jQuery( function( $ ) {
    if ( ! String.prototype.getDecimals ) {
      String.prototype.getDecimals = function() {
        var num = this,
            match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        if ( ! match ) {
          return 0;
        }
        return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
      }
    }
    // Quantity "plus" and "minus" buttons
    $( document.body ).on( 'click', '.plus, .minus', function() {
      var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
          currentVal  = parseFloat( $qty.val() ),
          max         = parseFloat( $qty.attr( 'max' ) ),
          min         = parseFloat( $qty.attr( 'min' ) ),
          step        = $qty.attr( 'step' );

      // Format values
      if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
      if ( max === '' || max === 'NaN' ) max = '';
      if ( min === '' || min === 'NaN' ) min = 0;
      if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

      // Change the value
      if ( $( this ).is( '.plus' ) ) {
          if ( max && ( currentVal >= max ) ) {
              $qty.val( max );
          } else {
              $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
          }
      } else {
          if ( min && ( currentVal <= min ) ) {
              $qty.val( min );
          } else if ( currentVal > 0 ) {
              $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
          }
      }
      // Trigger change event
      $qty.trigger( 'change' );
    });
  });
  </script>
  <?php
}

/*--------------------------------------------------
Add file js add to cart ajax
---------------------------------------------------*/
function woocommerce_ajax_add_to_cart_js() {
    if (function_exists('is_product') && is_product()) {
       wp_enqueue_script('custom_script', get_bloginfo('stylesheet_directory') . '/js/ajax_add_to_cart.js', array('jquery'),'1.0' );
    }
}
add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);

/*--------------------------------------------------
Ajax add to cart
---------------------------------------------------*/
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');          
function woocommerce_ajax_add_to_cart() {
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}
/*--------------------------------------------------
Ajax get total cart refesh
---------------------------------------------------*/
add_filter( 'woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment', 30, 1 );
function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="amount-shop">
        <?php echo sprintf(_n('%d ', '%d ', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>
    </span>
    <?php
    $fragments['span.amount-shop'] = ob_get_clean();

   return $fragments;
}
/*--------------------------------------------------
Add mini cart
---------------------------------------------------*/
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_mini_cart_ajax_refresh' );
function wc_mini_cart_ajax_refresh( $fragments ){
    global $woocommerce;
    ob_start();
    ?>
    <div class="main-cart-mini">
        <table class="table">
            <?php $cart = WC()->cart->get_cart();
            foreach ($cart as $cart_item_key => $item) {
            $_product = $item['data']->post;
            $price = $item['data']->price;
            if($_SESSION['carts'][$item['product_id']]['option'] == 1) 
              $price = get_post_meta($item['product_id'] , '_price', true);
            ?>
            <tr>
                <td style="width: 58%; padding-right: 10px;" class="name">
                    <?php 
                        $name = $_product->post_title;
                        if(!empty($_SESSION['carts'][$item['product_id']]['option-name'])){
                            $name .= "-".$_SESSION['carts'][$item['product_id']]['option-name'];
                        }
                    ?>
                        <?php echo $name; ?>
              </td>
                <td style="width: 35%; padding-right: 10px;" class="price"><?php echo "$".$price; ?> x <?php echo $item['quantity'] ?></td>
                <td  class="btn-remove" style="width: 7%;"><a href="<?php echo esc_url( WC()->cart->get_remove_url( $cart_item_key ) ); ?>" class="item_remove">X</a></td>
            </tr>
            <?php } ?>
          </table>
        <div class="cart-mini-bottom">
            <div class="name-sub">
                 <p>Sub Total: </p>
             </div>
             <div class="prices-sub">
                 <p><?php echo WC()->cart->get_cart_total(); ?></p>
             </div>
           </div>
        <div class="checkout-mini">
            <div class="button-cart">
                <a href="<?php echo WC_Cart::get_cart_url(); ?>">View Cart</a>
            </div>
             <div class="button-cart">
                <a href="<?php echo WC_Cart::get_checkout_url(); ?>">Check out</a>
            </div>
          </div> 
      </div>
    <?php
    $fragments['div.main-cart-mini'] = ob_get_clean(); 
    return $fragments;
}

/*==========================================*/
/*               READY TIME                */
/*========================================*/

function custom_checkout_field($checkout){

  date_default_timezone_set('America/Denver');
  // date_default_timezone_set('Asia/Ho_Chi_Minh');
  
  $l_date = strtolower(date('l'));
  $from_l_date = $l_date . '_hours_from';
  $to_l_date = $l_date . '_hours_to';
  $from_l_date_val = get_option($from_l_date);
  $to_l_date_val = get_option($to_l_date);

  $current_time = date('H:i');
  $minutes = date('i', strtotime($current_time));
  $round_minute = ($minutes - ($minutes % 15)) + 15;
  
  if($round_minute >= 60){
    $round_hour = date('H') + 1;
    $round_minute = '00';
  } else {
    $round_hour = date('H');
  }
  $round_current_time = $round_hour . ":" . $round_minute;
  // echo 'Round Time: ' . $round_current_time;    
  $time_options_arr = array();

  if( strtotime($round_current_time) <= strtotime($to_l_date_val) && strtotime($round_current_time) >= strtotime($from_l_date_val) ){
    $start_time_run = $round_current_time;
    $time_options = '"' . $start_time_run . '":"' . $start_time_run . '",';
    $time_options_arr[$start_time_run ] = $start_time_run;

    while ( strtotime($start_time_run) < strtotime($to_l_date_val) ) {
      $start_time_run_numbertime = strtotime("+15 minutes", strtotime($start_time_run));
      $start_time_run = date('H:i', $start_time_run_numbertime);
      $time_options .= '"' . $start_time_run . '":"' . $start_time_run . '",';
      $time_options_arr[$start_time_run ] = $start_time_run;
      // echo $start_time_run . "<br/>";
    }

  } else if( strtotime($round_current_time) < strtotime($from_l_date_val) ) {
    $start_time_run = $from_l_date_val;
    $time_options = '"' . $start_time_run . '":"' . $start_time_run . '",';
    $time_options_arr[$start_time_run ] = $start_time_run;

    while ( strtotime($start_time_run) < strtotime($to_l_date_val) ) {
      $start_time_run_numbertime = strtotime("+15 minutes", strtotime($start_time_run));
      $start_time_run = date('H:i', $start_time_run_numbertime);
      $time_options .= '"' . $start_time_run . '":"' . $start_time_run . '",';
      $time_options_arr[$start_time_run ] = $start_time_run;
      // echo $start_time_run . "<br/>";
    }
  } else {
    $start_time_run = $from_l_date_val;
    $time_options = '"' . $start_time_run . '":"' . $start_time_run . '",';
    $time_options_arr[$start_time_run ] = $start_time_run;

    while ( strtotime($start_time_run) < strtotime($to_l_date_val) ) {
      $start_time_run_numbertime = strtotime("+15 minutes", strtotime($start_time_run));
      $start_time_run = date('H:i', $start_time_run_numbertime);
      $time_options .= '"' . $start_time_run . '":"' . $start_time_run . '",';
      $time_options_arr[$start_time_run ] = $start_time_run;
      // echo $start_time_run . "<br/>";
    }
  }

  echo '<div id="ready-time" class="col-xl-6 col-12">
  <h4>' . __('Ready Time: ') . '</h4>';
  woocommerce_form_field('ready-time', array(
    'type' => 'select',
    'class' => array(
    'select2-selection__rendered'
    ) ,
    'options'     => $time_options_arr,
    'label' => __('Ready Time') ,
    'placeholder' => __('Ready Time') ,
  ) ,
  $checkout->get_value('ready-time'));
  echo '</div>';
  echo '<div class="notice-delivery">';
  echo '<p>Please allow us at least 15 minutes to prepare.</p>';
  echo '<p>Requires 24 hours notice on all orders of Catering.</p>';
  echo '</div>';
  echo '<h4>' . __('Remark: ') . '</h4>';

}
add_action('woocommerce_before_order_notes', 'custom_checkout_field');

// Show an error message if the field is not set.
function customised_checkout_field_process(){
  if (!$_POST['ready-time']) wc_add_notice(__('Please choose value Ready Time!') , 'error');
}
add_action('woocommerce_checkout_process', 'customised_checkout_field_process');

// Display the Data of  WooCommerce Custom Fields in Admin
function cloudways_display_order_data_in_admin( $order ){  ?>
    <div class="order_data_column">
 
        <h4><?php _e( 'Additional Information', 'woocommerce' ); ?><a href="#" class="edit_address"><?php _e( 'Edit', 'woocommerce' ); ?></a></h4>
        <div class="address">
        <?php
            echo '<p><strong>' . __( 'Ready Time' ) . ':</strong>' . get_post_meta( $order->id, '_order_ready_time', true ) . '</p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_order_ready_time', 'label' => __( 'Some field' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
    </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'cloudways_display_order_data_in_admin' );

/**
* Save the value given in custom field
*/

function cloudways_save_extra_details( $post_id, $post ){
    update_post_meta( $post_id, '_order_ready_time', wc_clean( $_POST[ '_order_ready_time' ] ) );
}
add_action( 'woocommerce_process_shop_order_meta', 'cloudways_save_extra_details', 45, 2 );

/**
* Update the value given in custom field
*/

add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id){
  if (!empty($_POST['ready-time'])) {
    update_post_meta( $order_id, '_order_ready_time',sanitize_text_field($_POST['ready-time']));
  }
}


/*====================================================*/
/*        Add custom field to the checkout page      */
/*==================================================*/

function custom_tip_field($checkout) {
  echo '<div id="custom_tip_field"><h3>' . __('Tips') . '</h3>';
  woocommerce_form_field('tip_customer', array(
    'type' => 'number',
    'class' => array(
      'my-field-class form-row-wide'
      ) ,
    'label' => __('Custom Additional Field') ,
    'placeholder' => __('Enter your tip') ,
    ),
  $checkout->get_value('tip_customer'));
  echo'<select name="option-price" class="option-price">
        <option value="dol">$</option>
        <option value="per">%</option>
      </select>';
  echo '</div>';
}
add_action('woocommerce_after_order_notes', 'custom_tip_field');

function woo_add_cart_fee( $cart ){
  if ( ! $_POST || ( is_admin() && ! is_ajax() ) ) {
    return;
  }

  if ( isset( $_POST['post_data'] ) ) {
      parse_str( $_POST['post_data'], $post_data );
  } else {
      $post_data = $_POST;
  }

  if (isset($post_data['tip_customer'])) {

      $price_tip = $post_data['tip_customer'];
      $option_price = $post_data['option-price'];
      $total = WC()->cart->get_subtotal( );
      $total_tip = 0;
      // $total_tip = $option_price == 'dol' ? $total_tip = $price_tip : $total_tip  = round( (($total * $price_tip) / 100), 2);
      if($option_price == 'dol'){
        $total_tip = $price_tip;
      }else if($option_price = 'per'){
        $total_tip = round( (($total * $price_tip) / 100), 2);
      }
      WC()->cart->add_fee( 'Tip', $total_tip );
  }
}
add_action( 'woocommerce_cart_calculate_fees', 'woo_add_cart_fee' );

function woocommerce_tip_script() {
  if( ! is_checkout() ) return;
  ?>
  <script type="text/javascript">
    jQuery(function($){
      $('.option-price').change(function() {
        $(document.body).trigger("update_checkout");
        // $( document ).trigger( 'wc_update_cart' );
      });
      $('p#tip_customer_field .woocommerce-input-wrapper input#tip_customer').change(function() {
        $(document.body).trigger("update_checkout");
        // $( document ).trigger( 'wc_update_cart' );
      });
    });
  </script>
  <?php
}
add_action( 'wp_footer', 'woocommerce_tip_script' );

################################################
################################################
#####           RENG RING BELL            ######
################################################
################################################

add_action('wp_ajax_sb_test_ajax','sb_test_ajax_callback');
add_action('wp_ajax_nopriv_sb_test_ajax','sb_test_ajax_callback');

 function sb_test_ajax_callback(){
    $max = $_POST['max'];
    global $wpdb; 
    $maxonline = $wpdb->get_results("SELECT MAX(id) as max FROM wp_posts WHERE post_type LIKE '%shop_order%' AND post_status LIKE '%wc-processing%' ",OBJECT);
    if($maxonline[0]->max > $max){
        $result['check'] = 1;
        $result['max'] = $maxonline[0]->max;
    }else{
        $result['check'] = 0;
    }
    echo json_encode($result);
    die();
}

################################################
################################################
#####           RING RING BELL            ######
################################################
################################################

add_action('wp_ajax_sb_5ringring_ajax','sb_5ringring_ajax_callback');
add_action('wp_ajax_nopriv_sb_5ringring_ajax','sb_5ringring_ajax_callback');

 function sb_5ringring_ajax_callback(){
    global $wpdb; 
    $countOrder = $wpdb->get_results("SELECT COUNT(id) AS count_order FROM wp_posts WHERE post_type LIKE '%shop_order%' AND post_status LIKE '%wc-processing%' ",OBJECT);
    if($countOrder[0]->count_order > 0){
        $result['check'] = 1;
        $result['count_order'] = $countOrder[0]->count_order;
    }else{
        $result['check'] = 0;
    }
    echo json_encode($result);
    die();
}

###############################################
####  HIDE ADMIN BAR WITH CASHIER ACCOUNT  ####
###############################################

$current_user = wp_get_current_user();
if ( $current_user->exists() ) {
  if( $current_user->user_login == 'cashier' ){
    add_filter('show_admin_bar', '__return_false');
  }
}


/*=======================================*/
/*              CUSTOME FIELD           */
/**
 * Display the custom text field
 * @since 1.0.0
 * Adding a custom field in the back-end
 */
/*=====================================*/


function cfwc_create_custom_field() {
  $args = array(
    'id' => 'custom_text_field_title',
    'label' => __( 'Extra Product', 'cfwc' ),
    'class' => 'cfwc-custom-field',
    'desc_tip' => true,
    'description' => __( 'Enter the extra of your custom text field.', 'ctwc' ),
  );
  // flavor
  $flavor = array(
    'id' => 'custom_text_field_title_flavor',
    'label' => __( 'Flavor Product', 'cfwc' ),
    'class' => 'cfwc-custom-field',
    'desc_tip' => true,
    'description' => __( 'Enter the flavor of your custom text field.', 'ctwc' ),
  );
  woocommerce_wp_textarea_input( $args );
  woocommerce_wp_textarea_input( $flavor );
}
add_action( 'woocommerce_product_options_general_product_data', 'cfwc_create_custom_field' );

/**
 * Save the custom field
 * @since 1.0.0
 */
function cfwc_save_custom_field( $post_id ) {
  $product = wc_get_product( $post_id );

  $title = isset( $_POST['custom_text_field_title'] ) ? $_POST['custom_text_field_title'] : '';
  $title_flavor = isset( $_POST['custom_text_field_title_flavor'] ) ? $_POST['custom_text_field_title_flavor'] : '';

  $product->update_meta_data( 'custom_text_field_title', sanitize_text_field( $title ) );
  $product->update_meta_data( 'custom_text_field_title_flavor', sanitize_text_field( $title_flavor ) );

  $product->save();
}
add_action( 'woocommerce_process_product_meta', 'cfwc_save_custom_field' );

/**
 * Display custom field on the front end
 * @since 1.0.0
 */
function cfwc_display_custom_field() {
  global $post;
  $product = wc_get_product( $post->ID );

  $title = $product->get_meta( 'custom_text_field_title' );
  $title_flavor = $product->get_meta( 'custom_text_field_title_flavor' );

  $extra_arr =  explode('|', $title);
  $flavor_arr = explode('|', $title_flavor);

  if( $title ) {
    echo '<div class="outer-scroll">';
    echo '<div class="outer-custom-extra">';
    echo '<div class="wrap-extra-title">';
    echo '<p class="title-extra">Extras</p>';
    echo '<p class="sub-extra">Optional</p>';
    echo '</div>';
    echo '<div class="outer-extra">';
    foreach ($extra_arr as $key => $extra) {
      $extra_arr_info = explode(',', $extra);
      // echo '<p>'.$extra_arr_info['2'].'</p>';
      printf(
      '<div class="cfwc-custom-field-wrapper" data-extra="'.$extra_arr_info['2'].'">
        <input type="checkbox" id="cfwc-title-field_'.$key.'" name="cfwc-title-field_'.$key.'" data-name="'.$extra_arr_info['0'].'" value="'.$extra_arr_info['1'].'">
        <label for="cfwc-title-field">' .$extra_arr_info['0']. ' ( +$'.$extra_arr_info['1']. ')</label>
      </div>',
      esc_html( $extra_arr_info['0'] )
      );
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
// Flavor
  if( $title_flavor ) {
    echo '<div class="outer-scroll">';
    echo '<div class="outer-custom-flavor">';
    echo '<div class="wrap-flavor-title">';
    echo '<p class="title-flavor">Flavors</p>';
    echo '<p class="sub-flavor">Optional</p>';
    echo '</div>';
    echo '<div class="outer-flavor">';
    foreach ($flavor_arr as $key => $flavor) {
    $flavor_arr_info = explode(',', $flavor);
      printf(
      '<div class="cfwc-custom-field-wrapper-flavor" data-flavor="'.$flavor_arr_info['2'].'">
        <input type="checkbox" id="cfwc-title-field_'.$key.'" name="cfwc-title-field_'.$key.'" data-name="'.$flavor_arr_info['0'].'" value="'.$flavor_arr_info['1'].'">
        <label for="cfwc-title-field">' .$flavor_arr_info['0'].'</label>
      </div>',
      esc_html( $flavor_arr_info['0'] )
      );
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }

}
add_action( 'woocommerce_before_add_to_cart_button', 'cfwc_display_custom_field' );

/**
 * Add the text field as item data to the cart object
 * @since 1.0.0
 * @param Array     $cart_item_data Cart item meta data.
 * @param Integer   $product_id     Product ID.
 * @param Integer   $variation_id   Variation ID.
 * @param Boolean   $quantity       Quantity
 */
function cfwc_add_custom_field_item_data( $cart_item_data, $product_id, $variation_id, $quantity ) {

  $product = wc_get_product( $_POST['product_id'] );

  if( ! empty( $_POST['extra_item'] ) ) {

    $price_extra_option =  $_POST['extra_item'];
    $price_flavor_object = explode('|', $price_extra_option);
    $total_price_extra = 0;

    foreach ($price_flavor_object as $key => $price) {
      $price_item = explode(',', $price);
      $total_price_extra += $price_item[1];
    }
  }

/*=============FLAVOR=================*/
  if( ! empty( $_POST['flavor_item'] ) ) {

    $price_flavor_option =  $_POST['extra_item'];
    $price_flavor_object = explode('|', $price_flavor_option);
    $total_price_extra = 0;

    foreach ($price_flavor_object as $key => $price) {
      $price_item = explode(',', $price);
      $total_price_extra += $price_item[1];
    }
  }

  $price_total = $product->get_price();

  $cart_item_data['total_price'] = $price_total + $total_price_extra + $total_price_flavor;
  $cart_item_data['title_field'] = $_POST['extra_item'] . ' - ' . $_POST['flavor_item'];
  return $cart_item_data;

}
add_filter( 'woocommerce_add_cart_item_data', 'cfwc_add_custom_field_item_data', 10, 4 );

/**
 * Display the custom field value in the cart
 * @since 1.0.0
 */
function cfwc_cart_item_name( $name, $cart_item, $cart_item_key ) {

  if( isset( $cart_item['title_field'] ) ) {
    $arr = explode('|', $cart_item['title_field']);
    foreach ($arr as $key => $value) {
      $extra_detail = explode(',', $value);
      if ($extra_detail[1]) {
        $name .= sprintf(
        '<p><span class="name-extra">%s</span><span class="price-extra"> +$'.$extra_detail[1].'</span></p>',
          esc_html( $extra_detail[0] )
        );
      }else{
        $name .= sprintf(
        '<p><span class="name-extra">%s</span></p>',
          esc_html( $extra_detail[0] )
        );
      }
    }
  }
 return $name;

}
add_filter( 'woocommerce_cart_item_name', 'cfwc_cart_item_name', 10, 3);

/**
 * Update the price in the cart
 * @since 1.0.0
 */
function cfwc_before_calculate_totals( $cart_obj ) {
  if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
    return;
  }
   // Iterate through each cart item
   foreach( $cart_obj->get_cart() as $key=>$value ) {
     if( isset( $value['total_price'] ) ) {
       $price = $value['total_price'];
       $value['data']->set_price( ( $price ) );
     }
   }
}
add_action( 'woocommerce_before_calculate_totals', 'cfwc_before_calculate_totals', 10, 1 );
/**
* Add custom field to order object
* @since 1.0.0
*/
// function cfwc_add_custom_data_to_order( $item, $cart_item_key, $values, $order ) {
//   foreach( $item as $cart_item_key => $values ) {
//     var_dump($values);
//     die;
//     if( isset( $values['title_field'] ) ) {
//       $arr = explode('|', $values['title_field']);
//       $newarr = '';
//       foreach ($arr as $key => $value) {
//         $extra_detail = explode(',', $value);
//         if( $newarr == "" ) {
//           $newarr = $extra_detail[0] .' +$'. $extra_detail[1];
//           } else {
//           $newarr .= ', ' . $extra_detail[0] .' +$'. $extra_detail[1];
//         }
//       }
//       $item->add_meta_data( __( 'Extra', 'cfwc' ), $newarr, true );
//     }
//   }
// }
// add_action( 'woocommerce_checkout_create_order_line_item', 'cfwc_add_custom_data_to_order', 10, 4 );


// remove shipping free in email
add_filter( 'woocommerce_get_order_item_totals', function( $total_rows, $order, $tax_display ){
    // Only for "Free Shipping" method
    if( ! $order->has_shipping_method('free_shipping') || is_account_page() || is_wc_endpoint_url( 'order-received' ) )
        return $total_rows; 

    unset($total_rows['shipping']);

    return $total_rows;
}, 11, 3 );



