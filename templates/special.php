<?php 
/*
Template Name: Special Template
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<style>
#page-special {
    margin-top: 100px;
    margin-bottom: 100px;
}

#page-special .coming-soon p {
    font-size: 145px;
    font-family: "UTM Niagara";
    color: #252628;
    text-transform: uppercase;
    line-height: 0.9;
    margin-bottom: 0;
    text-align: center;
    text-shadow: 0px 0px 14px rgba(255, 255, 255, 0.5);
}

#page-special .sub-coming-soon{
	margin-top: 20px;
}
#page-special .sub-coming-soon p{
    font-size: 32px;
    font-family: "Nexa Light";
    color: #ca1f27;
    text-transform: uppercase;
    line-height: 1.25;
    text-align: center;
}

@media only screen and (max-width: 767px) {
	#page-special{
		margin: 50px 0 25px;
	}
    #page-special .coming-soon p {
        font-size: 100px;
    }
    #page-special .sub-coming-soon p{
    	font-size: 23px;
    }
}

@media only screen and (max-width: 414px) {
	#page-special{
		margin: 30px 0 0;
	}
    #page-special .coming-soon p {
        font-size: 80px;
    }
    #page-special .sub-coming-soon p{
    	font-size: 16px;
    }
}
</style>
<main>
    <div id="page-special">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-12">
                    <div class="coming-soon">
                        <p>Coming soon</p>
                    </div>
                    <div class="sub-coming-soon">
                        <p>We are currently working on a new super awesome page</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>