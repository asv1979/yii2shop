<?php

namespace shop\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 */
class Review extends ActiveRecord
{
    /**
     * @param $userId
     * @param int $vote
     * @param string $text
     * @return static
     */
    public static function create($userId, int $vote, string $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = false;
        return $review;
    }

    /**
     * @param $vote
     * @param $text
     */
    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = true;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active === true;
    }

    /**
     * @return bool
     */
    public function getRating(): bool
    {
        return $this->vote;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }
}
