<?php
namespace shop\entities\Shop;

use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 */
class Characteristic extends ActiveRecord
{
    /**
     *
     */
    const TYPE_STRING = 'string';
    /**
     *
     */
    const TYPE_INTEGER = 'integer';
    /**
     *
     */
    const TYPE_FLOAT = 'float';

    /**
     * @var
     */
    public $variants;

    /**
     * @param $name
     * @param $type
     * @param $required
     * @param $default
     * @param array $variants
     * @param $sort
     * @return static
     */
    public static function create($name, $type, $required, $default, array $variants, $sort): self
    {
        $object = new static();
        $object->name = $name;
        $object->type = $type;
        $object->required = $required;
        $object->default = $default;
        $object->variants = $variants;
        $object->sort = $sort;
        return $object;
    }

    /**
     * @param $name
     * @param $type
     * @param $required
     * @param $default
     * @param array $variants
     * @param $sort
     */
    public function edit($name, $type, $required, $default, array $variants, $sort): void
    {
        $this->name = $name;
        $this->type = $type;
        $this->required = $required;
        $this->default = $default;
        $this->variants = $variants;
        $this->sort = $sort;
    }

    /**
     * @return bool
     */
    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    /**
     * @return bool
     */
    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    /**
     * @return bool
     */
    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    /**
     * @return bool
     */
    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%shop_characteristics}}';
    }

    /**
     *
     */
    public function afterFind(): void
    {
        $this->variants = array_filter(Json::decode($this->getAttribute('variants_json')));
        parent::afterFind();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert): bool
    {
        $this->setAttribute('variants_json', Json::encode(array_filter($this->variants)));
        return parent::beforeSave($insert);
    }
}
