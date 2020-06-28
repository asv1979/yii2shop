<?php

namespace shop\cart\cost\calculator;

use shop\cart\cost\Cost;
use shop\cart\cost\Discount as CartDiscount;
use shop\entities\Shop\Discount as DiscountEntity;

/**
 * Class DynamicCost
 * @package shop\cart\cost\calculator
 */
class DynamicCost implements CalculatorInterface
{
    /**
     * @var CalculatorInterface
     */
    private $next;

    /**
     * DynamicCost constructor.
     * @param CalculatorInterface $next
     */
    public function __construct(CalculatorInterface $next)
    {
        $this->next = $next;
    }

    /**
     * @param array $items
     * @return Cost
     */
    public function getCost(array $items): Cost
    {
        /** @var DiscountEntity[] $discounts */
        $discounts = DiscountEntity::find()->active()->orderBy('sort')->all();

        $cost = $this->next->getCost($items);

        foreach ($discounts as $discount) {
            if ($discount->isEnabled()) {
                $new = new CartDiscount($cost->getOrigin() * $discount->percent / 100, $discount->name);
                $cost = $cost->withDiscount($new);
            }
        }

        return $cost;
    }
}
