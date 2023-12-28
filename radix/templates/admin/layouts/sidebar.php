<?php
$userId = isLogin()['user_id'];
$getUserDetail = getUserInfor($userId);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>" class="brand-link">
        <img src="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-uppercase">Radix Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo _WEB_HOST_TEMPLATE_ADMIN ?>/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo getLinkAdmin('users', 'profile') ?>" class="d-block"><?php echo $getUserDetail['fullname'] ?> (Super
                    Admin)</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- 
                Tổng quan - begin
             -->
                <li class="nav-item">
                    <a href="<?php echo _WEB_HOST_ROOT_ADMIN ?>" class="nav-link <?php echo (activeMenuSidebar('')) || empty($_GET['module']) ? 'active' : false ?>">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>

                <!-- 
                    Tổng quan - end
                 -->

                <!-- 
                    Services - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('services')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('services')) ? 'active' : false ?>">
                        <i class="nav-icon fab fa-servicestack"></i>
                        <p>
                            Quản lý dịch vụ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=services" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=services&action=add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    Services -end 
                -->

                <!-- 
                    Pages - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('pages')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('pages')) ? 'active' : false ?>">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            Quản lý trang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=pages" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=pages&action=add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    Pages -end 
                -->

                <!-- 
                    Portfolios - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('portfolios') || activeMenuSidebar('portfolios_categories')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('portfolios') || activeMenuSidebar('portfolios_categories')) ? 'active' : false ?>">

                        <i class="nav-icon fa fa-project-diagram"></i>
                        <p>
                            Quản lý dự án
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=portfolios" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách dự án</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=portfolios&action=add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm dự án mới</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=portfolios_categories" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục dự án</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    Portfolios -end 
                -->

                <!-- 
                    Blog - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('blog') || activeMenuSidebar('blog_categories')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('blog') || activeMenuSidebar('blog_categories')) ? 'active' : false ?>">
                        <i class="nav-icon fa fa-address-card"></i>
                        <p>
                            Quản lý blog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=blog" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách blog</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=blog&action=add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm blog mới</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=blog_categories" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục blog</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    Blog -end 
                -->


                <!-- 
                    Groups - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('groups')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('groups')) ? 'active' : false ?>">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Nhóm người dùng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=groups" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=groups&action=add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    Groups -end 
                -->

                <!-- 
                    users - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('users')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('users')) ? 'active' : false ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Quản lý người dùng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=users&action=add" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    users -end 
                -->

                <!-- 
                    contact - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('contacts')) || activeMenuSidebar('contact_type') ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('contacts')) || activeMenuSidebar('contact_type') ? 'active' : false ?>">
                        <i class="nav-icon fa fa-comment"></i>
                        <p>
                            Quản lý liên hệ <span class="badge badge-danger"><?php echo getCountContact() ?></span>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=contacts" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách liên hệ <span class="badge badge-danger"><?php echo getCountContact() ?></span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=contact_type" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý phòng ban</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    contact -end 
                -->

                <!-- 
                    options - begin 
                -->
                <li class="nav-item has-treeview <?php echo (activeMenuSidebar('options')) ? 'menu-open' : false ?>">
                    <a href="#" class="nav-link <?php echo (activeMenuSidebar('options')) ? 'active' : false ?>">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Thiết lập
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="?module=options&action=general" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập chung</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=options&action=home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập trang chủ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=options&action=header" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?module=options&action=footer" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập footer</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=options&action=about" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập giới thiệu</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=options&action=team" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập team</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=options&action=services" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập dịch vụ</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=options&action=portfolios" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập dự án</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="?module=options&action=blog" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thiết lập bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 
                    options -end 
                -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">