<?php
namespace shop\forms\manage\Shop;

use shop\entities\Shop\Characteristic;
use shop\helpers\CharacteristicHelper;
use yii\base\Model;

/**
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $required;
    /**
     * @var string
     */
    public $default;
    /**
     * @var string
     */
    public $textVariants;
    /**
     * @var bool|int|mixed|string|null
     */
    public $sort;

    /**
     * @var Characteristic
     */
    private $_characteristic;

    /**
     * CharacteristicForm constructor.
     * @param Characteristic|null $characteristic
     * @param array $config
     */
    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        if ($characteristic) {
            // it is better decision? but if we will change some its field we will get problem
            //$this->setAttributes($characteristic->getAttributes());
            $this->name = $characteristic->name;
            $this->type = $characteristic->type;
            $this->required = $characteristic->required;
            $this->default = $characteristic->default;
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->sort = $characteristic->sort;
            $this->_characteristic = $characteristic;
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
            [['name'], 'unique', 'targetClass' => Characteristic::class, 'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : null]
        ];
    }

    /**
     * @return array
     */
    public function typesList(): array
    {
        return CharacteristicHelper::typeList();
    }

    /**
     * @return array
     */
    public function getVariants(): array
    {
        // TODO check return preg_split('#\s+#i', $this->textVariants);
        return preg_split('#[\r\n]+#i', $this->textVariants);
    }
}
