<?php

namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Value;
use yii\base\Model;

/**
 * @property integer $id
 */
class ValueForm extends Model
{
    /**
     * @var
     */
    public $value;

    /**
     * @var Characteristic
     */
    private $_characteristic;

    /**
     * ValueForm constructor.
     * @param Characteristic $characteristic
     * @param Value|null $value
     * @param array $config
     */
    public function __construct(Characteristic $characteristic, Value $value = null, $config = [])
    {
        if ($value) {
            $this->value = $value->value;
        }
        $this->_characteristic = $characteristic;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return array_filter([
            $this->_characteristic->required ? ['value', 'required'] : false,
            $this->_characteristic->isString() ? ['value', 'string', 'max' => 255] : false,
            $this->_characteristic->isInteger() ? ['value', 'integer'] : false,
            $this->_characteristic->isFloat() ? ['value', 'number'] : false,
            ['value', 'safe'],
        ]);
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'value' => $this->_characteristic->name,
        ];
    }

    /**
     * @return array
     */
    public function variantsList(): array
    {
        return $this->_characteristic->variants ? array_combine($this->_characteristic->variants, $this->_characteristic->variants) : [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_characteristic->id;
    }
}
