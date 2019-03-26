<?php
return array(
    // Просмотр поста
    'article/([0-9]+)' => 'article/view/$1',
    'article/addLike/([0-9]+)' => 'article/addLike/$1',
    'article/removeLike/([0-9]+)' => 'article/removeLike/$1',
    // Список тем
    'catalog' => 'catalog/index',
    // Просмотр постов в теме
    'theme/([0-9]+)' => 'catalog/theme/$1',
    // Пользователь
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    // Управление постами
    'admin/article/create' => 'adminArticle/create',
    'admin/article/update/([0-9]+)' => 'adminArticle/update/$1',
    'admin/article/delete/([0-9]+)' => 'adminArticle/delete/$1',
    'admin/article' => 'adminArticle/index',
    // Управление темами
    'admin/theme/create' => 'adminTheme/create',
    'admin/theme/update/([0-9]+)' => 'adminTheme/update/$1',
    'admin/theme/delete/([0-9]+)' => 'adminTheme/delete/$1',
    'admin/theme' => 'adminTheme/index',
    // Админка
    'admin' => 'admin/index',
    // О сайте
    'contacts' => 'site/contact',
    'about' => 'site/about',
    // Главная страница
    '' => 'site/index',
);