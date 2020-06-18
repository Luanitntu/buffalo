<?php 
/*
Template Name: Contact Template
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<main>
    <div id="page-contact">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                    <div class="contact-left wow zoomIn">
                        <div class="title-left">
                            <p>Capitol Hill location</p>
                        </div>
                        <div class="content-left">
                            <p>514 E Colfax Ave, Denver, CO 80203<br>
                                <a href="tel:+13038607777">303.860.7777</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                    <div class="contact-right wow zoomIn">
                        <div class="title-right">
                            <p>Lowry location</p>
                        </div>
                        <div class="content-right">
                            <p>7236 E Colfax Ave, Denver, CO 80220<br>
                                <a href="tel:+13033937777">303.393.7777</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-12">
                    <div class="title-form wow lightSpeedIn" data-wow-delay="2s">
                        <p>Contact form</p>
                    </div>
                    <div class="wrap-form wow slideInLeft">
                        <?php echo do_shortcode('[contact-form-7 id="11" title="Contact Form"]');?>
                    </div>
                </div>
            </div>
        </div>
</main>
<?php get_footer(); ?>
