<?php

$data = [
    'pageTitle' => getOption('portfolios_title')
];

layout('header', 'client', $data);

layout('breadcrumb', 'client', $data);

$isPortfolioPage = true;

require_once _WEB_PATH_ROOT . '/modules/home/contents/portfolios.php';

layout('footer', 'client');
