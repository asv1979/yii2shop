<?php

$config = [
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'google' => [
            'class' => 'yii\authclient\clients\Google',
            'clientId' => 'google_client_id',
            'clientSecret' => 'google_client_secret',
        ],
        'facebook' => [
            'class' => 'yii\authclient\clients\Facebook',
            'clientId' => 'facebook_client_id',
            'clientSecret' => 'facebook_client_secret',
        ],
        ]
    ],
];


if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
