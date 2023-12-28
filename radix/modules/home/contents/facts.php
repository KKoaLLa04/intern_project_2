<?php
$subTitle = getOption('home_fact_subtitle');
$title = getOption('home_fact_title');
$desc = getOption('home_fact_desc');
$buttonText = getOption('home_fact_button_text');
$buttonLink = getOption('home_fact_button_link');
$yearsNumber = getOption('home_fact_years_number');
$projectsNumber = getOption('home_fact_projects_number');
$earnNumber = getOption('home_fact_earning_number');
$awardsNumber = getOption('home_fact_awards_number');
?>
<!-- Fun Facts -->
<section id="fun-facts" class="fun-facts section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-12 wow fadeInLeft" data-wow-delay="0.5s">
                <div class="text-content">
                    <div class="section-title">
                        <h1><span><?php echo !empty($subTitle) ? $subTitle : false ?></span><?php echo !empty($title) ? $title : False ?>
                        </h1>
                        <p><?php echo !empty($desc) ? $desc : false ?></p>
                        <a href="<?php echo !empty($buttonLink)?$buttonLink:false ?>"
                            class="btn primary"><?php echo !empty($buttonText)?$buttonText:'Contact us' ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.6s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-clock-o"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo !empty($yearsNumber)?$yearsNumber:false ?></span></p>
                                <h4>years of success</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="0.8s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-bullseye"></i></div>
                            <div class="counter">
                                <p><span
                                        class="count"><?php echo !empty($projectsNumber)?$projectsNumber:false?></span>K
                                </p>
                                <h4>Project Complete</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-dollar"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo !empty($earnNumber)?$earnNumber:false ?></span>M</p>
                                <h4>Total Earnings</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 wow fadeIn" data-wow-delay="1.2s">
                        <!-- Single Fact -->
                        <div class="single-fact">
                            <div class="icon"><i class="fa fa-trophy"></i></div>
                            <div class="counter">
                                <p><span class="count"><?php echo !empty($awardsNumber)?$awardsNumber:false ?></span>
                                </p>
                                <h4>Winning Awards</h4>
                            </div>
                        </div>
                        <!--/ End Single Fact -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Fun Facts -->