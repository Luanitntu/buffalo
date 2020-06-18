<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
  echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
  return;
}

?>
<div id="page-checkout">
    <div class="container">
        <div class="row">
            <div class="col-12 no-padding-checkout">
                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
                    <?php if ( $checkout->get_checkout_fields() ) : ?>
                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                    <div class="col2-set" id="customer_details">
                        <div class="col-xl-6 col-12 checkout-left">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
                        <div class="col-xl-6 col-12 checkout-right">
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>
                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                    <?php endif; ?>
                    <div class="col-xl-12">
                        <div class="wrap-report">
                            <h3 id="order_review_heading">
                                <?php esc_html_e( 'Your order', 'woocommerce' ); ?>
                            </h3>
                            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                            </div>
                            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php
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

  if( ($round_minute - $minutes) < 10 ){
    $round_minute += 15;
  }

  if($round_minute >= 60){
    $round_hour = date('H') + 1;
    $round_minute = '00';
  } else {
    $round_hour = date('H');
  }
  $round_current_time = $round_hour . ":" . $round_minute;
  // echo 'Round Time: ' . $round_current_time;    

  if( strtotime($round_current_time) <= strtotime($to_l_date_val) && strtotime($round_current_time) >= strtotime($from_l_date_val) ){
    $start_time_run = $round_current_time;
    // "10:00": "10:00",
    $time_options = '"' . $start_time_run . '":"' . $start_time_run . '",';

    while ( strtotime($start_time_run) < strtotime($to_l_date_val) ) {
      $start_time_run_numbertime = strtotime("+15 minutes", strtotime($start_time_run));
      $start_time_run = date('H:i', $start_time_run_numbertime);
      $time_options .= '"' . $start_time_run . '":"' . $start_time_run . '",';
      // echo $start_time_run . "<br/>";
    }

    // echo 'In of Service';
    // echo $time_options;

  } else if( strtotime($round_current_time) < strtotime($from_l_date_val) ) {
    $start_time_run = $from_l_date_val;
    $time_options = '"' . $start_time_run . '":"' . $start_time_run . '",';

    while ( strtotime($start_time_run) < strtotime($to_l_date_val) ) {
      $start_time_run_numbertime = strtotime("+15 minutes", strtotime($start_time_run));
      $start_time_run = date('H:i', $start_time_run_numbertime);
      $time_options .= '"' . $start_time_run . '":"' . $start_time_run . '",';
      // echo $start_time_run . "<br/>";
    }

    // echo 'Out of Service From';
    // echo $time_options;
  } else {
    $start_time_run = $from_l_date_val;
    $time_options = '"' . $start_time_run . '":"' . $start_time_run . '",';

    while ( strtotime($start_time_run) < strtotime($to_l_date_val) ) {
      $start_time_run_numbertime = strtotime("+15 minutes", strtotime($start_time_run));
      $start_time_run = date('H:i', $start_time_run_numbertime);
      $time_options .= '"' . $start_time_run . '":"' . $start_time_run . '",';
      // echo $start_time_run . "<br/>";
    }

    // echo 'Out of Service To';
    // echo $time_options;
  }
?>
<script type="text/javascript">
jQuery(document).ready(function() {

    // var wpcf7Elm = document.querySelector( '.wpcf7' );
    // wpcf7Elm.addEventListener( 'wpcf7mailfailed', function( event ) {
    //     alert( "wpcf7mailfailed!" );
    // }, false );
    // wpcf7Elm.addEventListener( 'wpcf7invalid', function( event ) {
    //     alert( "wpcf7invalid!" );
    // }, false );
    // wpcf7Elm.addEventListener( 'wpcf7spam', function( event ) {
    //     alert( "wpcf7spam!" );
    // }, false );
    // wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
    //     alert( "wpcf7mailsent!" );
    // }, false );
    // wpcf7Elm.addEventListener( 'wpcf7submit', function( event ) {
    //     alert( "wpcf7submit!" );
    // }, false );


    var ready_time_display = jQuery("select[name=ready-time]");
    // console.log(ready_time_display);

    //    var newOptions = {
    //      "10:00": "10:00",
    //    "10:15": "10:15",
    //    "10:30": "10:30",
    // };

    var newOptions = { <?php echo $time_options; ?> };

    jQuery(ready_time_display).empty(); // remove old options
    jQuery.each(newOptions, function(key, value) {
        jQuery(ready_time_display).append(jQuery("<option></option>")
            .attr("value", value).text(key));
    });

});
</script>