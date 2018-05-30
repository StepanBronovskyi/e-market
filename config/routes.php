<?php
    return array(
        'product/(\d+)' => 'product/view/$1',
        'category/(\d+)/page(\d+)' => 'catalog/view/$1/$2',
        'category/(\d+)' => 'catalog/view/$1',
        'catalog/page(\d)' => 'catalog/index/$1',
        'catalog' => 'catalog/index',
        'blog/(\d+)' => 'blog/view/$1',
        'blog' => 'blog/index',
        'user/register' => 'user/register',
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
        'cabinet/edit' => 'cabinet/edit',
        'cabinet' => 'cabinet/index',
        'contacts' => 'site/contacts',
        'card/add/(\d+)' => 'card/add/$1',
        'card/addAjax/(\d+)' => 'card/addAjax/$1',
        'card/delete/(\d+)' => 'card/delete/$1',
        'card/checkout' => 'card/checkout',
        'admin/product/delete/(\d+)' => 'adminProduct/delete/$1',
        'admin/product/update/(\d+)' => 'adminProduct/update/$1',
        'admin/product/create' => 'adminProduct/create',
        'admin/product' => 'adminProduct/index',
        'admin/category/update/(\d+)' => 'adminCategory/update/$1',
        'admin/category/delete/(\d+)' => 'adminCategory/delete/$1',
        'admin/category/create' => 'adminCategory/create',
        'admin/category' => 'adminCategory/index',
        'admin/order/view/(\d+)' => 'adminOrder/view/$1',
        'admin/order/delete/(\d+)' => 'adminOrder/delete/$1',
        'admin/order/update/(\d+)' => 'adminOrder/update/$1',
        'admin/order' => 'adminOrder/index',
        'admin' => 'admin/index',
        'card' => 'card/index',
        '' => 'site/index'
    );