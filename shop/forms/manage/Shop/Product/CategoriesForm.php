<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Category;
use shop\entities\Shop\Product\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class CategoriesForm
 * @package shop\forms\manage\Shop\Product
 */
class CategoriesForm extends Model
{
    /**
     * @var
     */
    public $main;
    /**
     * @var array
     */
    public $others = [];

    /**
     * CategoriesForm constructor.
     * @param Product|null $product
     * @param array $config
     */
    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->main = $product->category_id;
            $this->others = ArrayHelper::getColumn($product->categoryAssignments, 'category_id');
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->asArray()->all(), 'id', function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . $category['name'];
        });
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['main', 'required'],
            ['main', 'integer'],
            ['others', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        $this->others = array_filter((array)$this->others);
        return parent::beforeValidate();
    }
}
