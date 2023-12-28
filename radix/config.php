<?php

// thiet lap module, action mac dinh

date_default_timezone_set('Asia/Ho_Chi_Minh');

const _MODULE_DEFAULT = 'home';
const _ACTION_DEFAULT = 'lists';
const _MODULE_DEFAULT_ADMIN = 'dashboard';

// Thiet lap HOST
define('_WEB_HOST_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/radix_module6/radix'); // dia chi trang chu
define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT . '/templates');

define('_WEB_HOST_ROOT_ADMIN', _WEB_HOST_ROOT . '/admin');
define('_WEB_HOST_TEMPLATE_ADMIN', _WEB_HOST_TEMPLATE . '/admin');

// Thiet lap PATH
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT . '/templates');


const _PER_PAGE = 20;
