<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Brand;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductEditForm extends CompositeForm
{
    /**
     * @var int
     */
    public $brandId;
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var int
     */
    public $weight;

    /**
     * @var Product
     */
    private $_product;

    /**
     * ProductEditForm constructor.
     * @param Product $product
     * @param array $config
     */
    public function __construct(Product $product, $config = [])
    {
        $this->brandId = $product->brand_id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->weight = $product->weight;
        $this->meta = new MetaForm($product->meta);
        $this->categories = new CategoriesForm($product);
        $this->tags = new TagsForm($product);
        $this->values = array_map(function (Characteristic $characteristic) use ($product) {
            return new ValueForm($characteristic, $product->getValue($characteristic->id));
        }, Characteristic::find()->orderBy('sort')->all());
        $this->_product = $product;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['brandId', 'code', 'name', 'weight'], 'required'],
            [['brandId'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id', $this->_product->id] : null],
            ['description', 'string'],
            ['weight', 'integer', 'min' => 0],
        ];
    }

    /**
     * @return array
     */
    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    /**
     * @return string[]
     */
    protected function internalForms(): array
    {
        return ['meta', 'categories', 'tags', 'values'];
    }
}
