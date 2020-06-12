<?php
namespace shop\entities\Shop;

use yii\db\ActiveRecord;

/**
 * without simply crud with active record we wrote more codes for future extensibility
 * for example - before edit a tag we can check - is the tag is active
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 */
class Tag extends ActiveRecord
{
    /**
     * @param $name
     * @param $slug
     * @return static
     */

    public static function create($name, $slug): self
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }

    /**
     * @param $name
     * @param $slug
     */
    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%shop_tags}}';
    }
}
