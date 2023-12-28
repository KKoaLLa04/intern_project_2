<?php

$data = [
    'pageTitle' => getOption('blog_title')
];

layout('header', 'client', $data);

layout('breadcrumb', 'client', $data);

// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allBlogNum = getRows("SELECT id FROM blog");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = getOption('blog_per_page');

// 2.tinh so trang 
$maxPage = ceil($allBlogNum / $perPage);

// 3.xủ lý biến page thông qua get
if (!empty(getBody()['page'])) {
    $page = getBody()['page'];

    if ($page < 1 || $page > $maxPage) {
        $page = 1;
    }
} else {
    $page = 1;
}

// 4. Tinh offset, limit
// $page = 1 => offset = 0 => ($page - 1)*$perPage = (1-1)*4 = 0 
// $page = 2 => offset = 4 => ($page - 1)*$perPage = (2-1)*4 = 4
// $page = 3 => offset = 8 => ($page - 1)*$perPage = (3-1)*4 = 8
// $page = 4 => offset = 12 =>($page - 1)*$perPage = (4-1)*4 = 12
$offset = ($page - 1) * $perPage;

$listAllBlog = getRaw("SELECT blog.*,name FROM blog INNER JOIN blog_categories ON blog_categories.id=blog.category_id LIMIT $offset, $perPage");
?>
<!-- Blogs Area -->
<section class="blogs-main archives section">
    <div class="container">
        <div class="row">
            <?php if (!empty($listAllBlog)) :
                foreach ($listAllBlog as $item) :
            ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Single Blog -->
                        <div class="single-blog">
                            <div class="blog-head">
                                <img src="<?php echo $item['thumbnail'] ?>" alt="#">
                            </div>
                            <div class="blog-bottom">
                                <div class="blog-inner">
                                    <h4><a href="#"><?php echo $item['title'] ?></a></h4>
                                    <p><?php echo html_entity_decode($item['content']) ?></p>
                                    <div class="meta">
                                        <span><i class="fa fa-bolt"></i><a href="<?php echo _WEB_HOST_ROOT . '/?module=blog&action=category&id=' . $item['category_id'] ?>"><?php echo $item['name'] ?></a></span>
                                        <span><i class="fa fa-calendar"></i><?php echo !empty($item['create_at']) ? getDateFormat($item['create_at'], 'd/m/Y') : '00-00-0000' ?></span>
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
    <?php if ($maxPage > 1) : ?>
        <div class="row">
            <div class="col-12">
                <!-- Start Pagination -->
                <div class="pagination-main">
                    <?php
                    $begin = $page - 2;
                    if ($begin <= 1) {
                        $begin = 1;
                    }
                    $end = $page + 2;
                    if ($end > $maxPage) {
                        $end = $maxPage;
                    }
                    ?>
                    <ul class="pagination">
                        <?php if ($page > 1) {
                            $prevPage = $page - 1;
                            echo '<li class="prev"><a href="' . _WEB_HOST_ROOT . '?module=blog&page=' . $prevPage . '"><i class="fa fa-angle-double-left"></i></a></li>';
                        } ?>

                        <?php for ($index = $begin; $index <= $end; $index++) {
                            $classActive = ($index == $page) ? 'active' : false
                        ?>
                            <li class="<?php echo $classActive ?>"><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&page=' . $index ?>"><?php echo $index ?></a>
                            </li>
                        <?php
                        }

                        if ($page < $maxPage) {
                            $nextPage = $page + 1;
                            echo '<li class="next"><a href="' . _WEB_HOST_ROOT . '?module=blog&page=' . $nextPage . '"><i class="fa fa-angle-double-right"></i></a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <!--/ End Pagination -->
            </div>
        </div>
    <?php endif; ?>
    </div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client');
