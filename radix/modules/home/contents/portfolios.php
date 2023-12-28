<?php
$title = getOption('home_portfolios_title');
$subTitle = getOption('home_portfolios_subtitle');
$desc = getOption('home_portfolios_desc');
$buttonText = getOption('home_portfolios_more_text');
$buttonLink = getOption('home_portfolios_more_link');

// Truy van tat ca danh muc du an
$portfolioCategory = getRaw("SELECT * FROM portfolios_categories");

// Truy van tat ca du an
$portfolios = getRaw("SELECT * FROM portfolios");
?>
<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo !empty($subTitle) ? $subTitle : false ?></span>
                    <h1><?php echo !empty($title) ? $title : false ?></h1>
                    <p><?php echo !empty($desc) ? $desc : false ?>
                    <p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- portfolio Nav -->
                <div class="portfolio-nav">
                    <ul class="tr-list list-inline" id="portfolio-menu">
                        <li data-filter="*" class="cbp-filter-item active">Tất cả dự án<div class="cbp-filter-counter">
                            </div>
                        </li>
                        <?php if (!empty($portfolioCategory)) :
                            foreach ($portfolioCategory as $item) :
                        ?>
                                <li data-filter=".category_<?php echo $item['id'] ?>" class="cbp-filter-item">
                                    <?php echo $item['name'] ?><div class="cbp-filter-counter">
                                    </div>
                                </li>
                        <?php endforeach;
                        endif ?>

                    </ul>
                </div>
                <!--/ End portfolio Nav -->
            </div>
        </div>
        <div class="portfolio-inner">
            <div class="row">
                <div class="col-12">
                    <div id="portfolio-item">
                        <!-- Single portfolio -->
                        <?php if (!empty($portfolios)) :
                            foreach ($portfolios as $item) : ?>
                                <div class="cbp-item website category_<?php echo $item['portfolio_categories_id'] ?> printing">
                                    <div class="portfolio-single">
                                        <div class="portfolio-head">
                                            <img src="<?php echo $item['thumbnail'] ?>" alt="#" />
                                        </div>
                                        <div class="portfolio-hover">
                                            <h4><a href="<?php echo _WEB_HOST_ROOT . '/?module=portfolios&action=detail&id=' . $item['id'] ?>"><?php echo $item['name'] ?></a>
                                            </h4>
                                            <p><?php echo $item['description'] ?>
                                            </p>
                                            <div class="button">
                                                <?php if (!empty($item['video'])) : ?>
                                                    <a href="<?php echo $item['video'] ?>" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
                                                <?php endif; ?>
                                                <a class="primary" data-fancybox="gallery" href="<?php echo $item['thumbnail'] ?>"><i class="fa fa-search"></i></a>
                                                <a href="portfolio-single.html"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach;
                        endif; ?>
                        <!--/ End portfolio -->

                    </div>
                </div>
                <?php if (empty($isPortfolioPage)) : ?>
                    <div class="col-12">
                        <div class="button">
                            <a class="btn primary" href="<?php echo !empty($buttonLink) ? $buttonLink : false ?>"><?php echo !empty($buttonText) ? $buttonText : false ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!--/ End portfolio -->