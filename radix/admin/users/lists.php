<?php

$data = [
    'pageTitle' => 'Quản lý người dùng'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userId = isLogin()['user_id'];

// Lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    if (!empty($body['status'])) {
        $statusSql = null;
        if ($body['status'] == 2) {
            $statusSql = 0;
        } else {
            $statusSql = $body['status'];
        }

        $filter .= 'WHERE status=' . $statusSql;
    }

    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " fullname like '%$keyword%'";
    }

    if (!empty($body['group_id'])) {
        $groupId = $body['group_id'];

        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " group_id = $groupId";
    }
}
// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allUserNum = getRows("SELECT id FROM users $filter");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = 4;

// 2.tinh so trang 
$maxPage = ceil($allUserNum / $perPage);

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

// Truy van den co so du lieu users
$dataUser = getRaw("SELECT users.id,users.fullname,users.email,users.status,users.create_at, name as group_name FROM users INNER JOIN groups ON users.group_id=groups.id $filter ORDER BY users.create_at DESC LIMIT $offset,$perPage");

// truy van den co so du lieu bang groups
$dataGroup = getRaw("SELECT id,name FROM groups ORDER BY create_at DESC");

if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=users', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid"></div>
    <a href="?module=users&action=add" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm người dùng mới </a>

    <hr>
    <form action="" method="GET">
        <div class="row">
            <div class="col-3">
                <select name="status" class="form-control">
                    <option value="0">---Chon Trang Thai---</option>
                    <option value="1"
                        <?php echo (!empty($body['status']) && $body['status'] == 1) ? 'selected' : false ?>>
                        Đã kích hoạt</option>
                    <option value="2"
                        <?php echo (!empty($body['status']) && $body['status'] == 2) ? 'selected' : false ?>>
                        Chưa kích hoạt</option>
                </select>
            </div>

            <div class="col-3">
                <select name="group_id" class="form-control">
                    <option value="0">---Chon Nhóm người dùng---</option>
                    <?php
                    if (!empty($dataGroup)) {
                        foreach ($dataGroup as $item) {
                    ?>
                    <option value="<?php echo $item['id'] ?>"
                        <?php echo ($body['group_id'] == $item['id']) ? 'selected' : false ?>>
                        <?php echo $item['name'] ?>
                    </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-4">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." class="form-control"
                    value="<?php echo !empty($body['keyword']) ? $body['keyword'] : false ?>">
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary form-control">Tìm kiếm</button>
            </div>
        </div>
        <input type="hidden" name="module" value="users">
    </form>
    <br>
    <?php
    getMsg($msg, $msgType);
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th width="15%">Thời gian</th>
                <th width="10%">Tinh trang</th>
                <th width="7%">Sua</th>
                <th width="7%">Xoa</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($dataUser)) :
                $count = 0;
                foreach ($dataUser as $item) :
                    $count++;
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><a
                        href="<?php echo getLinkAdmin('users', 'edit', ['id' => $item['id']]) ?>"><?php echo $item['fullname'] ?></a>
                </td>
                <td><?php echo $item['email'] ?></td>
                <td><a href="#"><?php echo $item['group_name'] ?></a></td>
                <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false ?>
                </td>
                <td class="text-center">
                    <?php echo ($item['status'] == 1) ? '<button class="btn btn-success btn-sm">Kích hoạt</button>' : '<button class="btn btn-warning btn-sm">Chưa kích hoạt</button>' ?>
                </td>
                <td class="text-center"><a href="<?php echo getLinkAdmin('users', 'edit', ['id' => $item['id']]) ?>"
                        class="btn btn-warning btn-sm">Sửa <i class="fa fa-edit"></i></a></td>
                <?php if($item['id'] !== $userId): ?>
                <td class="text-center"><a href="<?php echo getLinkAdmin('users', 'delete', ['id' => $item['id']]) ?>"
                        class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa <i
                            class="fa fa-trash"></i></a></td>
                <?php endif ?>
            </tr>
            <?php endforeach;
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
                echo ' <li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=users&page=' . $prevPage . '">Trước</a></li>';
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
                    href="<?php echo _WEB_HOST_ROOT . '?module=users&' . $queryString . '&page=' . $index ?>"><?php echo $index ?></a>
            </li>
            <?php
            }

            if ($page < $maxPage) {
                $nextPage = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=users&page=' . $nextPage . '">Sau</a></li>';
            }
            ?>

        </ul>
    </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);