<?php
$title = getOption('home_partner_title');
$titleBg = getOption('home_partner_title_bg');
$subTitle = getOption('home_partner_subtitle');
$partnerJson = getOption('home_partner_content');
$partnerArr = [];
if (!empty($partnerJson)) {
    $partnerArr = json_decode($partnerJson, true);
}
?>
<!-- Partners -->
<section id="partners" class="partners section">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo !empty($titleBg) ? $titleBg : false ?></span>
                    <h1><?php echo !empty($title) ? $title : false ?></h1>
                    <p><?php echo !empty($subTitle) ? $subTitle : false ?>
                    <p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="partners-inner">
                    <div class="row no-gutters">
                        <!-- Single Partner -->
                        <?php if (!empty($partnerArr)) :
                            foreach ($partnerArr as $item) : ?>
                                <div class="col-lg-2 col-md-3 col-12">
                                    <div class="single-partner">
                                        <a href="<?php echo $item['link'] ?>" target="_blank"><img src="<?php echo $item['logo'] ?>" alt="#"></a>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                        <!--/ End Single Partner -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Partners -->