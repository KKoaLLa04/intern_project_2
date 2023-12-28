<!-- Services -->
<section id="services" class="services section">
    <div class="container">
        <div class="row">
            <div class="col-12 wow fadeInUp">
                <div class="section-title">
                    <span class="title-bg"><?php echo getOption('home_service_title_bg') ?></span>
                    <h1><?php echo getOption('home_service_title') ?></h1>
                    <p><?php echo getOption('home_service_subtitle') ?>
                    <p>
                </div>
            </div>
        </div>
        <?php
        $listAllServices = getRaw("SELECT * FROM services");
        if (!empty($listAllServices)) :
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="service-slider">
                        <!-- Single Service -->
                        <?php foreach ($listAllServices as $item) : ?>
                            <div class="single-service">
                                <?php echo html_entity_decode($item['icon']) ?>
                                <h2><a href="#"><?php echo $item['name'] ?></a></h2>
                                <p><?php echo $item['description'] ?></p>
                            </div>
                        <?php endforeach; ?>
                        <!-- End Single Service -->
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>
<!--/ End Services -->