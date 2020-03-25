<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
        ],
        'session' => [
            'name' => '_session',
            'cookieParams' => [
                'domain' => $params['cookieDomain'],
                'httpOnly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
//                'contact' => 'contact/index',
//                'signup' => 'auth/signup/request',
//                'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',
//                '<_a:login|logout>' => 'auth/auth/<_a>',
//
//                ['pattern' => 'yandex-market', 'route' => 'market/index', 'suffix' => '.xml'],
//
//                ['pattern' => 'sitemap', 'route' => 'sitemap/index', 'suffix' => '.xml'],
//                ['pattern' => 'sitemap-<target:[a-z-]+>-<start:\d+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],
//                ['pattern' => 'sitemap-<target:[a-z-]+>', 'route' => 'sitemap/<target>', 'suffix' => '.xml'],
//
//                'blog' => 'blog/post/index',
//                'blog/tag/<slug:[\w\-]+>' => 'blog/post/tag',
//                'blog/<id:\d+>' => 'blog/post/post',
//                'blog/<id:\d+>/comment' => 'blog/post/comment',
//                'blog/<slug:[\w\-]+>' => 'blog/post/category',
//
//                'catalog' => 'shop/catalog/index',
//                ['class' => 'frontend\urls\CategoryUrlRule'],
//                'catalog/<id:\d+>' => 'shop/catalog/product',
//
//                'cabinet' => 'cabinet/default/index',
//                'cabinet/<_c:[\w\-]+>' => 'cabinet/<_c>/index',
//                'cabinet/<_c:[\w\-]+>/<id:\d+>' => 'cabinet/<_c>/view',
//                'cabinet/<_c:[\w\-]+>/<_a:[\w-]+>' => 'cabinet/<_c>/<_a>',
//                'cabinet/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'cabinet/<_c>/<_a>',
//
//                ['class' => 'frontend\urls\PageUrlRule'],
//
//                '<_c:[\w\-]+>' => '<_c>/index',
//                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
//                '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
//                '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
            ],
        ],

    ],
    'params' => $params,
];
