<?php

$data = [
    'pageTitle' => 'Trang chủ'
];

layout('header', 'client', $data);

require_once 'contents/slider.php';
require_once 'contents/about.php';
require_once 'contents/services.php';
require_once 'contents/facts.php';
require_once 'contents/portfolios.php';
require_once 'contents/cta.php';
require_once 'contents/blog.php';
require_once 'contents/partner.php';
layout('footer', 'client');