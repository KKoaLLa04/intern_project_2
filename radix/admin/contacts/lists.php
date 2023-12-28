<?php
$data = [
    'pageTitle' => 'Danh sách liên hệ'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    //Xử lý lọc status
    if (!empty($body['status'])) {
        $status = $body['status'];

        if ($status == 2) {
            $statusSql = 0;
        } else {
            $statusSql = $status;
        }

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= "$operator status=$statusSql";
    }

    //Xử lý lọc theo từ khoá
    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= " $operator (message LIKE '%$keyword%' OR fullname LIKE '%$keyword%' OR email LIKE '%$keyword%')";
    }

    //Xử lý lọc theo phòng ban
    if (!empty($body['type_id'])) {
        $typeId = $body['type_id'];

        if (!empty($filter) && strpos($filter, 'WHERE') >= 0) {

            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= " $operator contacts.type_id=$typeId";
    }
}

// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allContactNum = getRows("SELECT id FROM blog $filter");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = _PER_PAGE;

// 2.tinh so trang 
$maxPage = ceil($allContactNum / $perPage);

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
$listAllContact = getRaw("SELECT contacts.id, fullname, contacts.create_at, email, message, status, note, contact_type.name as type_name, contacts.type_id FROM contacts INNER JOIN contact_type ON contacts.type_id=contact_type.id $filter ORDER BY contacts.create_at DESC LIMIT $offset, $perPage");
// truy van du lieu blog_categories
$allContactType = getRaw("SELECT * FROM contact_type ORDER BY name");

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="get">
            <?php
            getMsg($msg, $msg_type);
            ?>
            <div class="row">

                <div class="col-3">
                    <select name="status" class="form-control">
                        <option value="0">---Chon Trang Thai---</option>
                        <option value="1"
                            <?php echo (!empty($body['status']) && $body['status'] == 1) ? 'selected' : false ?>>
                            Đã xử lý</option>
                        <option value="2"
                            <?php echo (!empty($body['status']) && $body['status'] == 2) ? 'selected' : false ?>>
                            Chưa xử lý</option>
                    </select>
                </div>

                <div class="col-3">
                    <select name="type_id" class="form-control">
                        <option value="0">---Chọn phòng ban---</option>
                        <?php if (!empty($allContactType)) {
                            foreach ($allContactType as $item) {
                        ?>
                        <option value="<?php echo $item['id'] ?>"
                            <?php echo (!empty($typeId) && $typeId == $item['id']) ? 'selected' : false ?>>
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

            <input type="hidden" name="module" value="contacts">
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="3%">STT</th>
                    <th width="20%">Thông tin</th>
                    <th>Nội dung</th>
                    <th width="8%">Trạng thái</th>
                    <th>Ghi chú</th>
                    <th width="13%">Thời gian</th>
                    <th width="7%">Sửa</th>
                    <th width="7%">Xóa</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($listAllContact)) :
                    foreach ($listAllContact as $key => $item) : ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td>
                        Họ tên: <?php echo $item['fullname'] ?> <br />
                        Email: <?php echo $item['email'] ?> <br />
                        Phòng ban: <?php echo $item['type_name'] ?>
                    </td>
                    <td>
                        <?php echo $item['message'] ?>
                    </td>
                    <td class="text-center">
                        <?php echo ($item['status'] == 1) ? '<button class="btn btn-success btn-sm">Đã xử lý</button>' : '<button class="btn btn-warning btn-sm">Chưa xử lý</button>' ?>
                    </td>
                    <td>
                        <?php echo $item['note'] ?>
                    </td>

                    <td><?php echo getDateFormat($item['create_at'], 'd/m/Y H:i:s') ?></td>
                    <td class="text-center"><a
                            href="<?php echo getLinkAdmin('contacts', 'edit', ['id' => $item['id']]) ?>"
                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Sửa</a></td>
                    <td class="text-center"><a
                            href="<?php echo getLinkAdmin('contacts', 'delete', ['id' => $item['id']]) ?>"
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