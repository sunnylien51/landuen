<?php

return [
    'production' => false,
    'baseUrl' => '',
    'siteName' => '公司名稱',
    'siteDescription' => '公司描述',
    'description' => '公司描述',
    'language' => 'zh-Hant',
    'collections' => [],
    'isActive' => function ($page, $path) {
        $current = trim($page->getPath(), '/');
        $target = trim($path, '/');

        if ($target === '') {
            return $current === '' ? 'active' : '';
        }

        return ($current === $target || str_starts_with($current . '/', $target . '/'))
            ? 'active'
            : '';
    },
];
