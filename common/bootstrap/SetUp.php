<?php

namespace common\bootstrap;

use shop\useCases\ContactService;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\mail\MailerInterface;
use yii\caching\Cache;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        $container->setSingleton(ErrorHandler::class, function () use ($app) {
            return $app->errorHandler;
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        /** if get client from docker container  create()->setHost(...)->build() */
        $container->setSingleton(Client::class, function () {
            return ClientBuilder::create()->build();
        });
    }
}
