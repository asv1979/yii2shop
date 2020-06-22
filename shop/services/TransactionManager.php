<?php

namespace shop\services;

//use shop\dispatchers\DeferredEventDispatcher;

/**
 * Class TransactionManager
 * @package shop\services
 */
class TransactionManager
{
//    /**
//     * @var DeferredEventDispatcher
//     */
//    private $dispatcher;

//    /**
//     * TransactionManager constructor.
//     * @param DeferredEventDispatcher $dispatcher
//     */
//    public function __construct(DeferredEventDispatcher $dispatcher)
//    {
//        $this->dispatcher = $dispatcher;
//    }

    /**
     * @param callable $function
     * @throws \yii\db\Exception
     */
    public function wrap(callable $function): void
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //$this->dispatcher->defer();
            $function();
            $transaction->commit();
            //$this->dispatcher->release();
        } catch (\Exception $e) {
            $transaction->rollBack();
            //$this->dispatcher->clean();
            throw $e;
        }
    }
}
