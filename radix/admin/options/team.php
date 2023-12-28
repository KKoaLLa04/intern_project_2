<?php
$data = [
    'pageTitle' => 'Thiết lập team'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

if (isPost()) {

    $teamContentJson = '';
    if (!empty(getBody()['team_content'])) {
        $teamContent = getBody()['team_content'];
        $teamContentArr = [];
        if (!empty($teamContent['name'])) {
            foreach ($teamContent['name'] as $key => $value) {
                $teamContentArr[] = [
                    'name' => $value,
                    'position' => isset($teamContent['position'][$key]) ? $teamContent['position'][$key] : false,
                    'facebook' => isset($teamContent['facebook'][$key]) ? $teamContent['facebook'][$key] : false,
                    'twitter' => isset($teamContent['twitter'][$key]) ? $teamContent['twitter'][$key] : false,
                    'linkedin' => isset($teamContent['linkedin'][$key]) ? $teamContent['linkedin'][$key] : false,
                    'behance' => isset($teamContent['behance'][$key]) ? $teamContent['behance'][$key] : false,
                    'image' => isset($teamContent['image'][$key]) ? $teamContent['image'][$key] : false,
                ];
            }
            if (!empty($teamContentArr)) {
                $teamContentJson = json_encode($teamContentArr);
            }
        }
    }

    $data = [
        'team_content' => $teamContentJson
    ];

    updateOption($data);
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <?php
        getMsg($msg, $msg_type);
        ?>
        <form action="" method="post">
            <h4>Thiết lập tiêu đề</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('team_title', 'label') ?></label>
                <input type="text" class="form-control" name="team_title" placeholder="<?php echo getOption('team_title', 'label') ?>...." value="<?php echo getOption('team_title') ?>">
                <p class="error"><?php echo errorData('team_title', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('team_title_bg', 'label') ?></label>
                <input type="text" class="form-control" name="team_title_bg" placeholder="<?php echo getOption('team_title_bg', 'label') ?>...." value="<?php echo getOption('team_title_bg') ?>">
                <p class="error"><?php echo errorData('team_title_bg', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('team_subTitle', 'label') ?></label>
                <textarea name="team_subTitle" class="form-control" placeholder="<?php echo getOption('team_subTitle', 'label') ?>"><?php echo getOption('team_subTitle') ?></textarea>
                <p class="error"><?php echo errorData('team_subTitle', $errors) ?></p>
            </div>

            <h4>Thiết lập đội ngũ</h4>

            <div class="team-wrapper">
                <?php
                $teamContentJson = getOption('team_content');
                $teamContentArr = [];
                if (!empty($teamContentJson)) {
                    $teamContentArr = json_decode($teamContentJson, true);
                }

                if (!empty($teamContentArr)) {
                    foreach ($teamContentArr as $item) {
                ?>
                        <div class="team-item">
                            <div class="row">
                                <div class="col-11">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Tên</label>
                                                <input type="text" name="team_content[name][]" class="form-control" value="<?php echo $item['name'] ?>" placeholder="Tên..." />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Chức vụ</label>
                                                <input type="text" name="team_content[position][]" class="form-control" value="<?php echo $item['position'] ?>" placeholder="Chức vụ..." />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Facebook</label>
                                                <input type="text" name="team_content[facebook][]" class="form-control" value="<?php echo $item['facebook'] ?>" placeholder="Facebook..." />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Twitter</label>
                                                <input type="text" name="team_content[twitter][]" class="form-control" value="<?php echo $item['twitter'] ?>" placeholder="Twitter..." />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Linkedin</label>
                                                <input type="text" name="team_content[linkedin][]" class="form-control" value="<?php echo $item['linkedin'] ?>" placeholder="Linkedin..." />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Behance</label>
                                                <input type="text" name="team_content[behance][]" class="form-control" value="<?php echo $item['behance'] ?>" placeholder="Behance..." />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Logo</label>
                                                <div class="row ckfinder-group">
                                                    <div class="col-10">
                                                        <input type="text" class="form-control image-render" name="team_content[image][]" placeholder="Đường dẫn ảnh...." value="<?php echo $item['image'] ?>">
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button" class="btn btn-success btn-block choose-image"><i class="fa fa-image"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
                                </div>
                            </div>
                        </div><!-- End team-item-->
                <?php
                    }
                }
                ?>

            </div>

            <p>
                <button type="button" class="btn btn-warning btn-sm add-team">Thêm nhân viên cho đội ngũ</button>
            </p>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);
