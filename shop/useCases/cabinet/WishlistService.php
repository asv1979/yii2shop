<?php

namespace shop\useCases\cabinet;

use shop\repositories\Shop\ProductRepository;
use shop\repositories\UserRepository;

/**
 * Class WishlistService
 * @package shop\useCases\cabinet
 */
class WishlistService
{
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var ProductRepository
     */
    private $products;

    /**
     * WishlistService constructor.
     * @param UserRepository $users
     * @param ProductRepository $products
     */
    public function __construct(UserRepository $users, ProductRepository $products)
    {
        $this->users = $users;
        $this->products = $products;
    }

    /**
     * @param $userId
     * @param $productId
     */
    public function add($userId, $productId): void
    {
        $user = $this->users->get($userId);
        $product = $this->products->get($productId);
        $user->addToWishList($product->id);
        $this->users->save($user);
    }

    /**
     * @param $userId
     * @param $productId
     */
    public function remove($userId, $productId): void
    {
        $user = $this->users->get($userId);
        $product = $this->products->get($productId);
        $user->removeFromWishList($product->id);
        $this->users->save($user);
    }
}
