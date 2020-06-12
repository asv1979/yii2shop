<?php
namespace shop\forms\manage;

use shop\entities\Meta;
use yii\base\Model;

/**
 * Class MetaForm
 * @package shop\forms\manage
 */
class MetaForm extends Model
{
    /**
     * @var
     */
    public $title;
    /**
     * @var
     */
    public $description;
    /**
     * @var
     */
    public $keywords;

    /**
     * MetaForm constructor.
     * @param Meta|null $meta
     * @param array $config
     */
    public function __construct(Meta $meta = null, $config = [])
    {
        if ($meta) {
            $this->title = $meta->title;
            $this->description = $meta->description;
            $this->keywords = $meta->keywords;
        }
        parent::__construct($config);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['description', 'keywords'], 'string'],
        ];
    }
}
