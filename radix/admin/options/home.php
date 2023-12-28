<?php
$data = [
    'pageTitle' => 'Thiết lập chung'
];
layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// updateOption();
if (isPost()) {
    if (!empty(getBody()['home_slide'])) {
        $homeSlideArr = [];
        $homeSlideJson = '';
        $homeSlide = getBody()['home_slide'];
        if (!empty($homeSlide['slide_title'])) {
            foreach ($homeSlide['slide_title'] as $key => $value) {
                $homeSlideArr[$key] = [
                    'slide_title' => $value,
                    'slide_desc' => isset($homeSlide['slide_desc'][$key]) ? $homeSlide['slide_desc'][$key] : '',
                    'slide_button_text' => isset($homeSlide['slide_button_text'][$key]) ? $homeSlide['slide_button_text'][$key] : '',
                    'slide_background' => isset($homeSlide['slide_background'][$key]) ? $homeSlide['slide_background'][$key] : '',
                    'slide_button_link' => isset($homeSlide['slide_button_link'][$key]) ? $homeSlide['slide_button_link'][$key] : '',
                    'slide_youtube' => isset($homeSlide['slide_youtube'][$key]) ? $homeSlide['slide_youtube'][$key] : '',
                    'slide_image_1' => isset($homeSlide['slide_image_1'][$key]) ? $homeSlide['slide_image_1'][$key] : '',
                    'slide_image_2' => isset($homeSlide['slide_image_2'][$key]) ? $homeSlide['slide_image_2'][$key] : '',
                    'slide_position' => isset($homeSlide['slide_position'][$key]) ? $homeSlide['slide_position'][$key] : 'left',
                ];
            }

            if (!empty($homeSlideArr)) {
                // Chuyển mảng về chuỗi json
                $homeSlideJson = json_encode($homeSlideArr);
            }
        }
    }

    $homeAbout = [];
    if (!empty(getBody()['home_about'])) {
        $homeAbout['information'] = json_encode(getBody()['home_about']);
    }

    if (!empty(getBody()['home_about']['skill'])) {
        if (!empty(getBody()['home_about']['skill']['name'])) {
            $homeSkillArr = [];
            foreach (getBody()['home_about']['skill']['name'] as $key => $value) {
                $homeSkillArr[$key] = [
                    'name' => $value,
                    'value' => getBody()['home_about']['skill']['value'][$key]
                ];
            }

            if (!empty($homeSkillArr)) {
                $homeAbout['skill'] = json_encode($homeSkillArr);
            }
        }
    }

    $homeAboutJson = json_encode($homeAbout);

    $homePartnerJson = '';
    if (!empty(getBody()['home_partner_content'])) {
        if (!empty(getBody()['home_partner_content']['logo'])) {
            $homePartnerArr = [];
            foreach (getBody()['home_partner_content']['logo'] as $key => $value) {
                $homePartnerArr[$key] = [
                    'logo' => $value,
                    'link' => getBody()['home_partner_content']['link'][$key]
                ];
            }
            if (!empty($homePartnerArr)) {
                $homePartnerJson = json_encode($homePartnerArr);
            }
        }
    }

    $data = [
        'home_slide' => $homeSlideJson,
        'home_about' => $homeAboutJson,
        'home_partner_content' => $homePartnerJson
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
            <h4>Thiết lập slide</h4>
            <div class="slide-wrapper">
                <?php
                $homeSlideJson = getOption('home_slide');
                if (!empty($homeSlideJson)) {
                    $homeSlideArr = json_decode($homeSlideJson, true);
                    if (!empty($homeSlideArr)) {
                        foreach ($homeSlideArr as $item) {
                ?>
                <div class="slide-item">
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Tiêu đề</label>
                                        <input type="text" class="form-control" name="home_slide[slide_title][]"
                                            placeholder="Tiêu đề...." value="<?php echo $item['slide_title'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <input type="text" class="form-control" name="home_slide[slide_desc][]"
                                            placeholder="Mô tả...." value="<?php echo $item['slide_desc'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chữ của nút</label>
                                        <input type="text" class="form-control" name="home_slide[slide_button_text][]"
                                            placeholder="Chữ của nút...."
                                            value="<?php echo $item['slide_button_text'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Ảnh slide 2</label>
                                        <div class="row ckfinder-group">
                                            <div class="col-10">
                                                <input type="text" class="form-control image-render"
                                                    name="home_slide[slide_background][]"
                                                    placeholder="Đường dẫn ảnh...."
                                                    value="<?php echo $item['slide_background'] ?>">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success btn-block choose-image"><i
                                                        class="fa fa-image"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Vị trí</label>
                                        <select name="home_slide[slide_position][]" class="form-control">
                                            <option value="left"
                                                <?php echo (!empty($item['slide_position']) && $item['slide_position'] == 'left') ? 'selected' : false ?>>
                                                Trái
                                            </option>
                                            <option value="center"
                                                <?php echo (!empty($item['slide_position']) && $item['slide_position'] == 'center') ? 'selected' : false ?>>
                                                Giữa</option>
                                            <option value="right"
                                                <?php echo (!empty($item['slide_position']) && $item['slide_position'] == 'right') ? 'selected' : false ?>>
                                                Phải</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Link của nút</label>
                                        <input type="text" class="form-control" name="home_slide[slide_button_link][]"
                                            placeholder="Link của nút...."
                                            value="<?php echo $item['slide_button_link'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Link youtube</label>
                                        <input type="text" class="form-control" name="home_slide[slide_youtube][]"
                                            placeholder="Link youtube...." value="<?php echo $item['slide_youtube'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Ảnh slide 1</label>
                                        <div class="row ckfinder-group">
                                            <div class="col-10">
                                                <input type="text" class="form-control image-render"
                                                    name="home_slide[slide_image_1][]" placeholder="Đường dẫn ảnh...."
                                                    value="<?php echo $item['slide_image_1'] ?>">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success btn-block choose-image"><i
                                                        class="fa fa-image"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Ảnh nền</label>
                                        <div class="row ckfinder-group">
                                            <div class="col-10">
                                                <input type="text" class="form-control image-render"
                                                    name="home_slide[slide_image_2][]" placeholder="Đường dẫn ảnh...."
                                                    value="<?php echo $item['slide_image_2'] ?>">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success btn-block choose-image"><i
                                                        class="fa fa-image"></i></button>
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
                </div> <!-- End slide-item-->
                <?php
                        }
                    }
                }
                ?>
                <p>
                    <button type="button" class="btn btn-warning btn-sm add-slide">Thêm slide</button>
                </p>
            </div>

            <h4>Thiết lập tin tức</h4>
            <?php
            $homeAboutJson = getOption('home_about');
            $homeAboutArr = [];
            $homeAboutInfor = [];
            $homeAboutSkill = [];
            if (!empty($homeAboutJson)) {
                $homeAboutArr = json_decode($homeAboutJson, true);
                $homeAboutInfor = json_decode($homeAboutArr['information'], true);
                if (!empty($homeAboutArr['skill'])) {
                    $homeAboutSkill = json_decode($homeAboutArr['skill'], true);
                }
            }
            ?>
            <div class="form-group">
                <label for="">Tiêu đề nền</label>
                <input type="text" class="form-control" placeholder="Tiêu đề nền..." name="home_about[title_background]"
                    value="<?php echo (!empty($homeAboutInfor['title_background'])) ? $homeAboutInfor['title_background'] : false ?>">
            </div>

            <div class="form-group">
                <label for="">Mô tả - chi tiết</label>
                <textarea name="home_about[desc]" class="form-control editor" placeholder="Mô tả - chi tiết..."
                    rows="5"><?php echo (!empty($homeAboutInfor['desc'])) ? $homeAboutInfor['desc'] : false ?></textarea>
            </div>

            <div class="form-group">
                <label for="">Thông tin chung</label>
                <textarea name="home_about[information]"
                    class="form-control editor"><?php echo (!empty($homeAboutInfor['information'])) ? $homeAboutInfor['information'] : false ?></textarea>
            </div>

            <div class="form-group">
                <label for="">Video</label>
                <input name="home_about[video]" class="form-control" placeholder="Link video youtube..."
                    value="<?php echo (!empty($homeAboutInfor['video'])) ? $homeAboutInfor['video'] : false ?>"></input>
            </div>

            <div class="form-group">
                <label for="">Ảnh đại diện</label>
                <div class="row ckfinder-group">
                    <div class="col-10">
                        <input type="text" class="form-control image-render" name="home_about[avatar]"
                            placeholder="Đường dẫn ảnh...."
                            value="<?php echo (!empty($homeAboutInfor['avatar'])) ? $homeAboutInfor['avatar'] : false ?>">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
                    </div>
                </div>
            </div>

            <h4>Thiết lập năng lực</h4>

            <div class="skill-wrapper">
                <?php if (!empty($homeAboutSkill)) :
                    foreach ($homeAboutSkill as $item) :
                ?>
                <div class="skill-item">
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Tên năng lực</label>
                                        <input type="text" name="home_about[skill][name][]" class="form-control"
                                            placeholder="Tên năng lực..."
                                            value="<?php echo (!empty($item['name'])) ? $item['name'] : false ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Giá trị</label>
                                        <input type="text" name="home_about[skill][value][]" class="form-control ranger"
                                            value="<?php echo (!empty($item['value'])) ? $item['value'] : false ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
                        </div>
                    </div>
                </div><!-- End skill item-->
                <?php endforeach;
                endif; ?>
            </div>

            <p>
                <button type="button" class="btn btn-warning btn-sm add-skill">Thêm năng lực</button>
            </p>

            <hr>
            <h4>Thiết lập dịch vụ</h4>

            <div class="form-group">
                <label for=""><?php echo getOption('home_service_title_bg', 'label') ?></label>
                <input type="text" class="form-control" name="home_service_title_bg"
                    placeholder="<?php echo getOption('home_service_title_bg', 'label') ?>"
                    value="<?php echo getOption('home_service_title_bg') ?>">
                <p class="error"><?php echo errorData('home_service_title_bg', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_service_title', 'label') ?></label>
                <input type="text" class="form-control" name="home_service_title"
                    placeholder="<?php echo getOption('home_service_title', 'label') ?>...."
                    value="<?php echo getOption('home_service_title') ?>">
                <p class="error"><?php echo errorData('home_service_title', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_service_subtitle', 'label') ?></label>
                <input type="text" class="form-control" name="home_service_subtitle"
                    placeholder="<?php echo getOption('home_service_subtitle', 'label') ?>...."
                    value="<?php echo getOption('home_service_subtitle') ?>">
                <p class="error"><?php echo errorData('home_service_subtitle', $errors) ?></p>
            </div>

            <hr>
            <h4>Thiết lập Thành tựu</h4>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_subtitle', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_subtitle"
                    placeholder="<?php echo getOption('home_fact_subtitle', 'label') ?>...."
                    value="<?php echo getOption('home_fact_subtitle') ?>">
                <p class="error"><?php echo errorData('home_fact_subtitle', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_title', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_title"
                    placeholder="<?php echo getOption('home_fact_title', 'label') ?>...."
                    value="<?php echo getOption('home_fact_title') ?>">
                <p class="error"><?php echo errorData('home_fact_title', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_desc', 'label') ?></label>
                <textarea name="home_fact_desc" class="form-control"
                    placeholder="<?php echo getOption('home_fact_desc', 'label') ?>"><?php echo getOption('home_fact_desc') ?></textarea>
                <p class="error"><?php echo errorData('home_fact_desc', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_button_text', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_button_text"
                    placeholder="<?php echo getOption('home_fact_button_text', 'label') ?>...."
                    value="<?php echo getOption('home_fact_button_text') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_button_link', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_button_link"
                    placeholder="<?php echo getOption('home_fact_button_link', 'label') ?>...."
                    value="<?php echo getOption('home_fact_button_link') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_years_number', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_years_number"
                    placeholder="<?php echo getOption('home_fact_years_number', 'label') ?>...."
                    value="<?php echo getOption('home_fact_years_number') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_projects_number', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_projects_number"
                    placeholder="<?php echo getOption('home_fact_projects_number', 'label') ?>...."
                    value="<?php echo getOption('home_fact_projects_number') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_earning_number', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_earning_number"
                    placeholder="<?php echo getOption('home_fact_earning_number', 'label') ?>...."
                    value="<?php echo getOption('home_fact_earning_number') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_fact_awards_number', 'label') ?></label>
                <input type="text" class="form-control" name="home_fact_awards_number"
                    placeholder="<?php echo getOption('home_fact_awards_number', 'label') ?>...."
                    value="<?php echo getOption('home_fact_awards_number') ?>">
            </div>

            <hr>
            <h4>Thiết lập dự án</h4>

            <div class="form-group">
                <label for=""><?php echo getOption('home_portfolios_title', 'label') ?></label>
                <input type="text" class="form-control" name="home_portfolios_title"
                    placeholder="<?php echo getOption('home_portfolios_title', 'label') ?>...."
                    value="<?php echo getOption('home_portfolios_title') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_portfolios_subtitle', 'label') ?></label>
                <input type="text" class="form-control" name="home_portfolios_subtitle"
                    placeholder="<?php echo getOption('home_portfolios_subtitle', 'label') ?>...."
                    value="<?php echo getOption('home_portfolios_subtitle') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_portfolios_desc', 'label') ?></label>
                <textarea name="home_portfolios_desc" class="form-control"
                    placeholder="<?php echo getOption('home_portfolios_desc', 'label') ?>"><?php echo getOption('home_portfolios_desc') ?></textarea>
                <p class="error"><?php echo errorData('home_portfolios_desc', $errors) ?></p>
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_portfolios_more_text', 'label') ?></label>
                <input type="text" class="form-control" name="home_portfolios_more_text"
                    placeholder="<?php echo getOption('home_portfolios_more_text', 'label') ?>...."
                    value="<?php echo getOption('home_portfolios_more_text') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_portfolios_more_link', 'label') ?></label>
                <input type="text" class="form-control" name="home_portfolios_more_link"
                    placeholder="<?php echo getOption('home_portfolios_more_link', 'label') ?>...."
                    value="<?php echo getOption('home_portfolios_more_link') ?>">
            </div>

            <hr>
            <h4>Thiết lập blog</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('home_blog_title_bg', 'label') ?></label>
                <input type="text" class="form-control" name="home_blog_title_bg"
                    placeholder="<?php echo getOption('home_blog_title_bg', 'label') ?>...."
                    value="<?php echo getOption('home_blog_title_bg') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_blog_title', 'label') ?></label>
                <input type="text" class="form-control" name="home_blog_title"
                    placeholder="<?php echo getOption('home_blog_title', 'label') ?>...."
                    value="<?php echo getOption('home_blog_title') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_blog_subtitle', 'label') ?></label>
                <input type="text" class="form-control" name="home_blog_subtitle"
                    placeholder="<?php echo getOption('home_blog_subtitle', 'label') ?>...."
                    value="<?php echo getOption('home_blog_subtitle') ?>">
            </div>

            <hr>
            <h4>Thiết lập đối tác</h4>
            <div class="form-group">
                <label for=""><?php echo getOption('home_partner_title_bg', 'label') ?></label>
                <input type="text" class="form-control" name="home_partner_title_bg"
                    placeholder="<?php echo getOption('home_partner_title_bg', 'label') ?>...."
                    value="<?php echo getOption('home_partner_title_bg') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_partner_title', 'label') ?></label>
                <input type="text" class="form-control" name="home_partner_title"
                    placeholder="<?php echo getOption('home_partner_title', 'label') ?>...."
                    value="<?php echo getOption('home_partner_title') ?>">
            </div>

            <div class="form-group">
                <label for=""><?php echo getOption('home_partner_subtitle', 'label') ?></label>
                <input type="text" class="form-control" name="home_partner_subtitle"
                    placeholder="<?php echo getOption('home_partner_subtitle', 'label') ?>...."
                    value="<?php echo getOption('home_partner_subtitle') ?>">
            </div>

            <h4>Danh sách đối tác</h4>
            <div class="partner-wrapper">
                <?php $homePartnerJson = getOption('home_partner_content');
                $homePartnerArr = json_decode($homePartnerJson,true);
                if (!empty($homePartnerArr)) :
                    foreach ($homePartnerArr as $item) :
                ?>
                <div class="partner-item">
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Logo</label>
                                        <div class="row ckfinder-group">
                                            <div class="col-10">
                                                <input type="text" class="form-control image-render"
                                                    name="home_partner_content[logo][]" placeholder="Đường dẫn ảnh...."
                                                    value="<?php echo $item['logo'] ?>">
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success btn-block choose-image"><i
                                                        class="fa fa-image"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text" name="home_partner_content[link][]" class="form-control"
                                            value="<?php echo $item['link'] ?>" placeholder="Link đối tác..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-danger btn-sm btn-block remove">&times;</button>
                        </div>
                    </div>
                </div><!-- End partner item-->
                <?php
                    endforeach;
                endif;
                ?>
            </div>

            <p>
                <button type="button" class="btn btn-warning btn-sm add-partner">Thêm đối tác</button>
            </p>

            <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<?php
layout('footer', 'admin', $data);