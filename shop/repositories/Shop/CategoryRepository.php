<?php

namespace shop\repositories\Shop;

use shop\dispatchers\EventDispatcher;
use shop\entities\Shop\Category;
use shop\repositories\events\EntityPersisted;
use shop\repositories\events\EntityRemoved;
use shop\repositories\NotFoundException;

/**
 * Class CategoryRepository
 * @package shop\repositories\Shop
 */
class CategoryRepository
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * CategoryRepository constructor.
     * @param EventDispatcher $dispatcher
     */
//    public function __construct(EventDispatcher $dispatcher)
//    {
//        $this->dispatcher = $dispatcher;
//    }

    /**
     * @param $id
     * @return Category
     */
    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    /**
     * @param Category $category
     */
    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('Saving error.');
        }
        //$this->dispatcher->dispatch(new EntityPersisted($category));
    }

    /**
     * @param Category $category
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        //$this->dispatcher->dispatch(new EntityRemoved($category));
    }
}
