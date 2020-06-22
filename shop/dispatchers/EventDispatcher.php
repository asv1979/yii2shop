<?php

namespace shop\dispatchers;

/**
 * Interface EventDispatcher
 * @package shop\dispatchers
 */
interface EventDispatcher
{
    /**
     * @param array $events
     */
    public function dispatchAll(array $events): void;

    /**
     * @param $event
     */
    public function dispatch($event): void;
}
