<?php

namespace shop\entities\behaviors;

use shop\entities\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class MetaBehavior
 * @package shop\entities\behaviors
 */
class MetaBehavior extends Behavior
{
    /**
     * the value can be change for future extensibility
     * then in a entity's behavior method return such an example
     * [ 'class' => MetaBehavior::class, 'attribute' => 'new_value']
     *
     * @var string
     */
    public $attribute = 'meta';
    /**
     * the value can be change for future extensibility
     *
     * @var string
     */
    public $jsonAttribute = 'meta_json';

    /**
     * @return array|string[]
     */
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    /**
     * @param Event $event
     */
    public function onAfterFind(Event $event): void
    {
        $model = $event->sender;
        $meta = Json::decode($model->getAttribute($this->jsonAttribute));
        // without hardcode $model->attribute we use the such construction -   $model->{$this->attribute}
        $model->{$this->attribute} = new Meta(
            $meta['title'] ?? null,
            $meta['description'] ?? null,
            $meta['keywords'] ?? null
        );
    }

    /**
     * @param Event $event
     */
    public function onBeforeSave(Event $event): void
    {
        $model = $event->sender;
        $model->setAttribute('meta_json', Json::encode([
            'title' => $model->{$this->attribute}->title,
            'description' => $model->{$this->attribute}->description,
            'keywords' => $model->{$this->attribute}->keywords,
        ]));
    }
}
