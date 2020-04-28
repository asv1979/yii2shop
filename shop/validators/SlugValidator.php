<?php
namespace shop\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class SlugValidator
 * @package shop\validators
 */
class SlugValidator extends RegularExpressionValidator
{
    /**
     * @var string
     */
    public $pattern = '#^[a-z0-9_-]*$#s';
    /**
     * @var string
     */
    public $message = 'Only [a-z0-9_-] symbols are allowed.';
}
