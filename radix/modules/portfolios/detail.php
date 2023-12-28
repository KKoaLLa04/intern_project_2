<?php

if (!empty(getBody()['id'])) {
    $id = getBody()['id'];
    $sql = "SELECT portfolios.*,portfolios_categories.name as cate_name FROM portfolios INNER JOIN portfolios_categories ON portfolios.portfolio_categories_id=portfolios_categories.id WHERE portfolios.id=$id";
    $portfoliosDetail = firstRaw($sql);
    if (empty($portfoliosDetail)) {
        loadError();
    }
} else {
    loadError();
}

$data = [
    'pageTitle' => $portfoliosDetail['name']
];

layout('header', 'client', $data);

$data['itemParent'] = '<li><a href="' . _WEB_HOST_ROOT . '/portfolios/lists.php' . '">' . getOption('portfolios_title') . '</a></li>';

layout('breadcrumb', 'client', $data);

?>
<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
    <div class="container" style="text-align: left;">
        <h1><?php echo !empty($portfoliosDetail['name']) ? $portfoliosDetail['name'] : false ?></h1>
        <p class="my-2">Chuyên mục: <b><?php echo $portfoliosDetail['cate_name'] ?></b> | Thời gian:
            <?php echo $portfoliosDetail['create_at'] ?></p>
        <hr>
        <?php echo !empty($portfoliosDetail['content']) ? html_entity_decode($portfoliosDetail['content']) : false ?>

        <div class="row my-4">
            <div class="col-6">
                <h3 class="my-4">Video</h3>
                <hr>
                <?php
                $checkVideo = false;
                if (!empty($portfoliosDetail['video'])) {
                    $checkVideo = true;
                    $videoId = getVideoId($portfoliosDetail['video']);
                ?>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoId ?>?si=1Yw_ApvJRY0MdMZd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <?php
                } ?>
            </div>

            <?php
            if ($checkVideo) {
                echo '<div class="col-6">';
            } else {
                echo '<div class="col-12">';
            }
            ?>
            <h3 class="my-4">Ảnh dự án</h3>
            <hr>
            <div class="row">
                <div class="col-4 mb-4">
                    <a data-fancybox="gallery" href="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png"><img src="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png" alt=""></a>
                </div>

                <div class="col-4 mb-4">
                    <a data-fancybox="gallery" href="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png"><img src="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png" alt=""></a>
                </div>

                <div class="col-4 mb-4">
                    <a data-fancybox="gallery" href="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png"><img src="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png" alt=""></a>
                </div>

                <div class="col-4 mb-4">
                    <a data-fancybox="gallery" href="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png"><img src="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png" alt=""></a>
                </div>

                <div class="col-4 mb-4">
                    <a data-fancybox="gallery" href="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png"><img src="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png" alt=""></a>
                </div>

                <div class="col-4 mb-4">
                    <a data-fancybox="gallery" href="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png"><img src="https://w7.pngwing.com/pngs/114/579/png-transparent-pink-cross-stroke-ink-brush-pen-red-ink-brush-ink-leave-the-material-text.png" alt=""></a>
                </div>
            </div>
            <?php
            echo '</div>'
            ?>
        </div>
    </div>
</section>
<!--/ End portfolio -->
<?php
layout('footer', 'client');
