<?php

$data = [
    'pageTitle' => getOption('service_title')
];

layout('header', 'client', $data);

layout('breadcrumb', 'client', $data);

?>
<!-- Services -->
<section id="services" class="services archives section">
    <div class="container">
        <div class="row">
            <div class="col-12">
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
                <?php foreach ($listAllServices as $item) : ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Service -->
                        <div class="single-service">
                            <?php echo html_entity_decode($item['icon']) ?>
                            <h2><a href="?module=services&action=detail&id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                            </h2>
                            <p><?php echo $item['description'] ?></p>
                        </div>
                        <!-- End Single Service -->
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
    </div>
</section>
<!--/ End Services -->
<?php
layout('footer', 'client');
