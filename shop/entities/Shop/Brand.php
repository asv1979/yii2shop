<?php
namespace shop\entities\Shop;

use shop\entities\behaviors\MetaBehavior;
use shop\entities\Meta;
use yii\db\ActiveRecord;


/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{
    /**
     * @var
     */
    public $meta;

    /**
     * @param $name
     * @param $slug
     * @param Meta $meta
     * @return static
     */
    public static function create($name, $slug, Meta $meta): self
    {
        $brand = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    /**
     * @param $name
     * @param $slug
     * @param Meta $meta
     */
    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%shop_brands}}';
    }

    /**
     * @return array|string[]
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
        ];
    }
}
