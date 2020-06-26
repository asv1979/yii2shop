<?php

namespace shop\forms\Shop;

use shop\entities\Shop\Product\Modification;
use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class AddToCartForm
 * @package shop\forms\Shop
 */
class AddToCartForm extends Model
{
    /**
     * @var
     */
    public $modification;
    /**
     * @var int
     */
    public $quantity;

    /**
     * @var Product
     */
    private $_product;

    /**
     * AddToCartForm constructor.
     * @param Product $product
     * @param array $config
     */
    public function __construct(Product $product, $config = [])
    {
        $this->_product = $product;
        $this->quantity = 1;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return array_filter([
            $this->_product->modifications ? ['modification', 'required'] : false,
            ['quantity', 'required'],
            ['quantity', 'integer', 'max' => $this->_product->quantity],
        ]);
    }

    /**
     * @return array
     */
    public function modificationsList(): array
    {
        return ArrayHelper::map($this->_product->modifications, 'id', function (Modification $modification) {
            return $modification->code . ' - ' . $modification->name . ' (' . PriceHelper::format($modification->price ?: $this->_product->price_new) . ')';
        });
    }
}
