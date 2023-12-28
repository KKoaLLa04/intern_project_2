<?php
$data = [
    'pageTitle' => 'Quản lý blog'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " (title LIKE '%$keyword%' OR content LIKE '%$keyword%')";
    }

    if (!empty($body['user_id'])) {
        $userId = $body['user_id'];

        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " blog.user_id = $userId";
    }

    if (!empty($body['cate_id'])) {
        $cateId = $body['cate_id'];

        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " category_id = $cateId";
    }
}

// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allBlogNum = getRows("SELECT id FROM blog $filter");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = _PER_PAGE;

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

if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

// Truy van du lieu nhom nguoi dung
$listAllBlog = getRaw("SELECT blog.*, blog_categories.name ,fullname FROM blog INNER JOIN blog_categories ON blog.category_id=blog_categories.id INNER JOIN users ON blog.user_id=users.id $filter ORDER BY blog.create_at DESC LIMIT $offset, $perPage");

// Truy van du lieu users
$allUser = getRaw("SELECT id,fullname,email FROM users");

// truy van du lieu blog_categories
$allCate = getRaw("SELECT * FROM blog_categories ORDER BY name");

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <a href="<?php echo getLinkAdmin('blog', 'add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm
            blog mới</a>
        <hr>
        <form action="" method="get">
            <?php
            getMsg($msg, $msg_type);
            ?>
            <div class="row">
                <div class="col-3">
                    <select name="user_id" class="form-control">
                        <option value="0">---Chọn người đăng---</option>
                        <?php if (!empty($allUser)) {
                            foreach ($allUser as $item) {
                        ?>
                        <option value="<?php echo $item['id'] ?>"
                            <?php echo (!empty($userId) && $userId == $item['id']) ? 'selected' : false ?>>
                            <?php echo $item['fullname'] . ' (' . $item['email'] . ')' ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-3">
                    <select name="cate_id" class="form-control">
                        <option value="0">---Chọn danh mục---</option>
                        <?php if (!empty($allCate)) {
                            foreach ($allCate as $item) {
                        ?>
                        <option value="<?php echo $item['id'] ?>"
                            <?php echo (!empty($cateId) && $cateId == $item['id']) ? 'selected' : false ?>>
                            <?php echo $item['name'] ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-4">
                    <input type="search" name="keyword" placeholder="Từ khóa tìm kiếm..." class="form-control"
                        value="<?php echo !empty($keyword) ? $keyword : false ?>">
                </div>

                <div class="col-2">
                    <button type="subimt" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>

            <input type="hidden" name="module" value="blog">
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">STT</th>
                    <th>Tiêu đề</th>
                    <th width="10%">Danh mục</th>
                    <th width="10%">Đăng bởi</th>
                    <th width="13%">Thời gian</th>
                    <th width="7%">Sửa</th>
                    <th width="7%">Xóa</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($listAllBlog)) :
                    foreach ($listAllBlog as $key => $item) : ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><a href="<?php echo getLinkAdmin('blog', 'edit', ['id' => $item['id']]) ?>"><?php echo $item['title'] ?>
                            <br>
                            <a href="<?php echo getLinkAdmin('blog', 'duplicate', ['id' => $item['id']])  ?>"><button
                                    class="btn btn-danger btn-sm" style="padding: 0 5px;">Nhân
                                    bản</button></a>
                            <a href="#" class="btn btn-success btn-sm"
                                style="padding: 0 5px;"><?php echo $item['view_count'] ?> Lượt xem</a>
                            <a href="#" target="_blank" class="btn btn-primary btn-sm" style="padding: 0 5px;">Xem</a>
                        </a>
                    </td>
                    <td><a
                            href="?module=blog&<?php echo getLinkQueryString($queryString, 'cate_id', $item['category_id']); ?>"><?php echo $item['name'] ?></a>
                    </td>
                    <td>
                        <a
                            href="?module=blog&<?php echo getLinkQueryString($queryString, 'user_id', $item['user_id']); ?>"><?php echo $item['fullname'] ?></a>
                    </td>
                    <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s') ?></td>
                    <td class="text-center"><a href="<?php echo getLinkAdmin('blog', 'edit', ['id' => $item['id']]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <td class="text-center"><a
                            href="<?php echo getLinkAdmin('blog', 'delete', ['id' => $item['id']]) ?>"
                            class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                class="fa fa-trash"></i> Xóa</a></td>
                </tr>

                <?php
                    endforeach;
                else : ?>
                <tr>
                    <td colspan="8">
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
                    echo ' <li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blog' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                <li class="page-item <?php echo ($index == $page) ? 'active' : false ?>"><a class="page-link"
                        href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=blog' . $queryString . '&page=' . $index ?>"><?php echo $index ?></a>
                </li>
                <?php
                }

                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=blog' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>

            </ul>
        </nav>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);