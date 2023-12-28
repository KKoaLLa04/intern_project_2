<?php

function getPrefixLink($module = '')
{
    $prefixArr = [
        'services' => 'dich-vu',
        'pages' => 'thong-tin',
        'portfolios' => 'du-an',
        'blog_categories' => 'tin-tuc',
        'blog' => 'blog',
    ];

    if (!empty($prefixArr[$module])) {
        return $prefixArr[$module];
    }

    return false;
}
