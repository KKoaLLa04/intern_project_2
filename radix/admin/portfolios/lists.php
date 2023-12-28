<?php

$data = [
    'pageTitle' => 'Quản lý dự án'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$portfolioId = isLogin()['user_id'];

// Lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    if (!empty($body['user_id'])) {
        $user_id = $body['user_id'];

        $filter .= 'WHERE portfolios.user_id=' . $user_id;
    }

    if (!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " portfolios.name like '%$keyword%'";
    }

    if (!empty($body['cate_id'])) {
        $cateId = $body['cate_id'];

        $operator = '';
        if (stripos($filter, 'WHERE') !== false) {
            $operator = 'AND';
        } else {
            $operator = 'WHERE';
        }

        $filter .= ' ' . $operator . " portfolio_categories_id = $cateId";
    }
}
// Xu ly thuat toan phan trang
// Lay tat ca du lieu ban ghi trong db
$allPortfolioNum = getRows("SELECT id FROM portfolios $filter");
// 1.Xu ly lay so luong  ban ghi / 1 trang
$perPage = _PER_PAGE;

// 2.tinh so trang 
$maxPage = ceil($allPortfolioNum / $perPage);

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

// Truy van den co so du lieu portfolios
$dataPortfolio = getRaw("SELECT portfolios.id,portfolios.name,portfolios.create_at, fullname, portfolios_categories.name as cate_name, portfolios_categories.id as cate_id, users.id as user_id FROM portfolios INNER JOIN portfolios_categories ON portfolios.portfolio_categories_id=portfolios_categories.id INNER JOIN users ON users.id=portfolios.user_id $filter ORDER BY portfolios.create_at DESC LIMIT $offset,$perPage");

// truy van den co so du lieu bang Portfolios_categories
$dataCate = getRaw("SELECT id,name FROM Portfolios_categories ORDER BY create_at DESC");

// truy van den co so du lieu user
$listAllUser = getRaw("SELECT * FROM users ORDER BY fullname");

if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=portfolios', '', $queryString);
    $queryString = str_replace('&page=' . $page, '', $queryString);
    $queryString = trim($queryString, '&');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid"></div>
    <a href="?module=portfolios&action=add" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm dự án mới </a>

    <hr>
    <form action="" method="GET">
        <div class="row">
            <div class="col-3">
                <select name="user_id" class="form-control">
                    <option value="0">---Chon người đăng---</option>
                    <?php
                    if (!empty($listAllUser)) {
                        foreach ($listAllUser as $item) {
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo (!empty($body['user_id']) && $body['user_id'] == $item['id']) ? 'selected' : false ?>>
                                <?php echo $item['fullname'] . ' (' . $item['email'] . ')' ?>
                            </option>
                    <?php
                        }
                    }
                    ?>

                </select>
            </div>

            <div class="col-3">
                <select name="cate_id" class="form-control">
                    <option value="0">---Chon danh mục---</option>
                    <?php
                    if (!empty($dataCate)) {
                        foreach ($dataCate as $item) {
                    ?>
                            <option value="<?php echo $item['id'] ?>" <?php echo (!empty($body['cate_id']) && $body['cate_id'] == $item['id']) ? 'selected' : false ?>>
                                <?php echo $item['name'] ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-4">
                <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." class="form-control" value="<?php echo !empty($body['keyword']) ? $body['keyword'] : false ?>">
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-primary form-control">Tìm kiếm</button>
            </div>
        </div>
        <input type="hidden" name="module" value="portfolios">
    </form>
    <br>
    <?php
    getMsg($msg, $msgType);
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Đăng bởi</th>
                <th width="15%">Thời gian</th>
                <th width="7%">Sua</th>
                <th width="7%">Xoa</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($dataPortfolio)) :
                $count = 0;
                foreach ($dataPortfolio as $item) :
                    $count++;
            ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]) ?>"><?php echo $item['name'] ?></a>
                            <br>
                            <a href="<?php echo getLinkAdmin('portfolios', 'duplicate', ['id' => $item['id']])  ?>"><button class="btn btn-danger btn-sm" style="padding: 0 5px;">Nhân
                                    bản</button></a>
                        </td>
                        <td><a href="?module=portfolios&<?php echo getLinkQueryString($queryString, 'cate_id', $item['cate_id']) ?>"><?php echo $item['cate_name'] ?></a>
                        </td>
                        <td><a href="?module=portfolios&<?php echo getLinkQueryString($queryString, 'user_id', $item['user_id']) ?>"><?php echo $item['fullname'] ?></a>
                        </td>
                        <td><?php echo (!empty($item['create_at'])) ? getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false ?>
                        </td>
                        <td class="text-center"><a href="<?php echo getLinkAdmin('portfolios', 'edit', ['id' => $item['id']]) ?>" class="btn btn-warning btn-sm">Sửa <i class="fa fa-edit"></i></a></td>
                        <?php if ($item['id'] !== $portfolioId) : ?>
                            <td class="text-center"><a href="<?php echo getLinkAdmin('portfolios', 'delete', ['id' => $item['id']]) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa <i class="fa fa-trash"></i></a></td>
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
                echo ' <li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=portfolios&page=' . $prevPage . '">Trước</a></li>';
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
                <li class="page-item <?php echo ($index == $page) ? 'active' : false ?>"><a class="page-link" href="<?php echo _WEB_HOST_ROOT . '?module=portfolios&' . $queryString . '&page=' . $index ?>"><?php echo $index ?></a>
                </li>
            <?php
            }

            if ($page < $maxPage) {
                $nextPage = $page + 1;
                echo '<li class="page-item"><a class="page-link" href="' . _WEB_HOST_ROOT . '?module=portfolios&page=' . $nextPage . '">Sau</a></li>';
            }
            ?>

        </ul>
    </nav>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
