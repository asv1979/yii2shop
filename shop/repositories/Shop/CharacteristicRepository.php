<?php
namespace shop\repositories\Shop;

use shop\entities\Shop\Characteristic;
use shop\repositories\NotFoundException;

/**
 * Class CharacteristicRepository
 * @package shop\repositories\Shop
 */
class CharacteristicRepository
{
    /**
     * @param $id
     * @return Characteristic
     */
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundException('Characteristic is not found.');
        }
        return $characteristic;
    }

    /**
     * @param Characteristic $characteristic
     */
    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Characteristic $characteristic
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
