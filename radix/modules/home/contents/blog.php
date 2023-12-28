<?php

$title = getOption('home_blog_title');
$titleBg = getOption('home_blog_title_bg');
$subTitle = getOption('home_blog_subtitle');

// Truy van lay du lieu bang blog
$listAllBlog = getRaw("SELECT blog.*,name FROM blog INNER JOIN blog_categories ON blog_categories.id=blog.category_id");
?>
<!-- Blogs Area -->
<section class="blogs-main section">
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
                <div class="row blog-slider">
                    <?php if (!empty($listAllBlog)) :
                        foreach ($listAllBlog as $item) : ?>
                            <div class="col-lg-4 col-12">
                                <!-- Single Blog -->
                                <div class="single-blog">
                                    <div class="blog-head">
                                        <img src="<?php echo $item['thumbnail'] ?>" alt="#">
                                    </div>
                                    <div class="blog-bottom">
                                        <div class="blog-inner">
                                            <h4><a href="blog-single.html"><?php echo $item['title'] ?></a></h4>
                                            <p><?php echo html_entity_decode($item['content']) ?></p>
                                            <div class="meta">
                                                <span><i class="fa fa-bolt"></i><a href="#"><?php echo $item['name'] ?></a></span>
                                                <span><i class="fa fa-calendar"></i><?php echo !empty($item['create_at']) ? getDateFormat($item['create_at'], 'd/m/Y') : '00:00:00' ?></span>
                                                <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count'] ?></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Blog -->
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blogs Area -->