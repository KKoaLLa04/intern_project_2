<?php
$data = [
    'pageTitle' => 'Quản lý nhóm người dùng'
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
        $filter = "WHERE name LIKE '%$keyword%'";
    }
}

// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allGroupsNum = getRows("SELECT id FROM groups $filter");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = _PER_PAGE;

// 2.tinh so trang 
$maxPage = ceil($allGroupsNum / $perPage);

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
    $queryString = str_replace('module=groups', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&' . $queryString;
}

// Truy van du lieu nhom nguoi dung
$listAllGroup = getRaw("SELECT * FROM groups $filter ORDER BY create_at DESC LIMIT $offset, $perPage");

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <a href="<?php echo getLinkAdmin('groups', 'add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm
            nhóm mới</a>
        <hr>
        <form action="" method="get">
            <?php
            getMsg($msg, $msg_type);
            ?>
            <div class="row">
                <div class="col-10">
                    <input type="search" name="keyword" placeholder="Từ khóa tìm kiếm..." class="form-control"
                        value="<?php echo !empty($keyword) ? $keyword : false ?>">
                </div>

                <div class="col-2">
                    <button type="subimt" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>

            <input type="hidden" name="module" value="groups">
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên nhóm</th>
                    <th>Thời gian</th>
                    <th width="10%">Phân quyền</th>
                    <th width="7%">Sửa</th>
                    <th width="7%">Xóa</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($listAllGroup)) :
                    foreach ($listAllGroup as $key => $item) : ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><a
                            href="<?php echo getLinkAdmin('groups', 'edit', ['id' => $item['id']]) ?>"><?php echo $item['name'] ?></a>
                    </td>
                    <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s') ?></td>
                    <td class="text-center"><a href="#" class="btn btn-primary btn-sm">Phân quyền</a></td>
                    <td class="text-center"><a
                            href="<?php echo getLinkAdmin('groups', 'edit', ['id' => $item['id']]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <td class="text-center"><a
                            href="<?php echo getLinkAdmin('groups', 'delete', ['id' => $item['id']]) ?>"
                            class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                class="fa fa-trash"></i> Xóa</a></td>
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
                    echo ' <li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=groups' . $queryString . '&page=' . $prevPage . '">Trước</a></li>';
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
                        href="<?php echo _WEB_HOST_ROOT_ADMIN . '?module=groups' . $queryString . '&page=' . $index ?>"><?php echo $index ?></a>
                </li>
                <?php
                }

                if ($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT_ADMIN . '?module=groups' . $queryString . '&page=' . $nextPage . '">Sau</a></li>';
                }
                ?>

            </ul>
        </nav>

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);