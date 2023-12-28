<?php
$data = [
    'pageTitle' => 'Quản lý danh mục blog'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lọc dữ liệu

$view = 'add'; // view mac dinh
$id = 0; //id mac dinh

$filter = '';
$body = getBody('get');

if (!empty($body['keyword'])) {
    $keyword = $body['keyword'];
    $filter = "WHERE name LIKE '%$keyword%'";
}

if (!empty($body['view'])) {
    $view = $body['view'];
}

if (!empty($body['id'])) {
    $id = $body['id'];
}

// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allBlogCate = getRows("SELECT id FROM blog_categories $filter");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = _PER_PAGE;

// 2.tinh so trang 
$maxPage = ceil($allBlogCate / $perPage);

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

if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog_categories', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

// Truy van du lieu nhom nguoi dung
$listAllCate = getRaw("SELECT *,(SELECT count(blog.id) FROM blog WHERE blog.category_id=blog_categories.id) as blog_count FROM blog_categories $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <div class="row">
            <div class="col-6">
                <?php
                if (!empty($view) && !empty($id)) {
                    require_once $view . '.php';
                } else {
                    require_once 'add.php';
                }
                ?>
            </div>

            <div class="col-6">
                <h4>Danh sách danh mục</h4>
                <form action="" method="get">
                    <div class="row">
                        <div class="col-10">
                            <input type="search" name="keyword" placeholder="Từ khóa tìm kiếm..." class="form-control" value="<?php echo !empty($keyword) ? $keyword : false ?>">
                        </div>

                        <div class="col-2">
                            <button type="subimt" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                    </div>

                    <input type="hidden" name="module" value="blog_categories">
                </form>
                <hr>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Thời gian</th>
                            <th width="7%">Sửa</th>
                            <th width="7%">Xóa</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($listAllCate)) :
                            foreach ($listAllCate as $key => $item) : ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><a href="<?php echo getLinkAdmin('blog_categories', '', ['id' => $item['id'], 'view' => 'edit'])  ?>"><?php echo $item['name'] ?></a>
                                        (<?php echo $item['blog_count'] ?>) <a href="<?php echo getLinkAdmin('blog_categories', 'duplicate', ['id' => $item['id']])  ?>"><button class="btn btn-danger btn-sm" style="padding: 0 5px;">Nhân
                                                bản</button></a>
                                    </td>
                                    <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s') ?></td>
                                    <td class="text-center"><a href="<?php echo getLinkAdmin('blog_categories', '', ['id' => $item['id'], 'view' => 'edit']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                    <td class="text-center"><a href="<?php echo getLinkAdmin('blog_categories', 'delete', ['id' => $item['id']]) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="fa fa-trash"></i>
                                        </a></td>
                                </tr>

                            <?php
                            endforeach;
                        else : ?>
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger text-center">Không có dữ liệu</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <nav aria-label="Page navigation example" class="d-flex justify-content-end">
                    <ul class="pagination pagination-sm">
                        <?php if ($page > 1) {
                            $prevPage = $page - 1;
                            echo ' <li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blog_categories' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
                        } ?>
                        <?php
                        $begin = $page - 2;
                        if ($begin <= 1) {
                            $begin = 1;
                        }
                        $end = $page + 2;
                        if ($end > $maxPage) {
                            $end = $maxPage;
                        }

                        for ($index = $begin; $index <= $end; $index++) {
                        ?>
                            <li class="page-item <?php echo ($index == $page) ? 'active' : false ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=blog_categories' . $queryString . '&page=' . $index ?>"><?php echo $index ?></a>
                            </li>
                        <?php
                        }

                        if ($page < $maxPage) {
                            $nextPage = $page + 1;
                            echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blog_categories' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                        }
                        ?>

                    </ul>
                </nav>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
