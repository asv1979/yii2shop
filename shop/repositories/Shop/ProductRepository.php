<?php

namespace shop\repositories\Shop;

//use shop\dispatchers\EventDispatcher;
use shop\entities\Shop\Product\Product;
use shop\repositories\events\EntityPersisted;
use shop\repositories\events\EntityRemoved;
use shop\repositories\NotFoundException;

/**
 * Class ProductRepository
 * @package shop\repositories\Shop
 */
class  ProductRepository
{

    //private $dispatcher;

    /**
     * ProductRepository constructor.
     * @param EventDispatcher $dispatcher
     */
//    public function __construct(EventDispatcher $dispatcher)
//    {
//        $this->dispatcher = $dispatcher;
//    }

    /**
     * @param $id
     * @return Product
     */
    public function get($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $product;
    }

    /**
     * @param $id
     * @return bool
     */
    public function existsByBrand($id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }

    /**
     * @param $id
     * @return bool
     */
    public function existsByMainCategory($id): bool
    {
        return Product::find()->andWhere(['category_id' => $id])->exists();
    }

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
//        $this->dispatcher->dispatchAll($product->releaseEvents());
//        $this->dispatcher->dispatch(new EntityPersisted($product));
    }

    /**
     * @param Product $product
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new \RuntimeException('Removing error.');
        }
//        $this->dispatcher->dispatchAll($product->releaseEvents());
//        $this->dispatcher->dispatch(new EntityRemoved($product));
    }
}
