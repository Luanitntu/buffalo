<?php 
/*
Template Name: Thank you Template
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<style>
.text-center {
    font-size: 35px;
    font-family: "Libre Baskerville";
    color: #000;
    text-transform: uppercase;
    line-height: 100%;
}

.jumbotron {
    background: #fff !important;
}

.jumbotron .lead a {
    font-size: 20px;
    font-family: "Nexa Bold";
    color: #fff;
    line-height: 1.5;
    text-align: left;
    margin-bottom: 0;
    padding: 15px;
    background: #ca1f27;
    text-decoration: none;
}

.jumbotron .lead a:hover {
    border: 3px solid #000;
}

.text-center h1 {
    font-size: 45px;
}

@media only screen and (max-width: 576px) {

    .text-center h1 {
        font-size: 45px;
    }

    .text-center {
        font-size: 25px;
    }

    .jumbotron p {
        font-size: 18px;
    }
}

@media only screen and (max-width: 414px) {
    .text-center h1 {
        font-size: 35px;
    }

    .jumbotron p {
        font-size: 13px;
    }
}

@media only screen and (max-width: 375px) {
    .text-center h1 {
        font-size: 30px;
    }

    .jumbotron .lead a {
        font-size: 17px;
        padding: 10px;
    }
}
</style>
<main>
    <div class="jumbotron text-center">
        <h1 class="display-3">Thank You For emailing us</h1>
        <p class="lead">Someone will be in touch with you shortly. We look forward to speaking with you soon!</p>
        <p class="lead" style="margin-top:45px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" role="button">Continue to homepage</a>
        </p>
    </div>
</main>
<?php get_footer(); ?>