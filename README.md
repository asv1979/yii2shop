# Study yii2 project

####`http://shop.test.local:8080`

Старт:

```
composer run-script docker:build
```

Если нужно пересобрать контейнеры без кеша:

```
composer run-script docker:re-build
```

Остановить и удалить контейнеры:

```
composer run-script docker:cleanup
```

Очитстить все (в случае возникновения ошибки при старте):

```
composer run-script docker:system-prune
```