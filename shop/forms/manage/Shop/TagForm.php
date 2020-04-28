<?php
namespace shop\forms\manage\Shop;

use shop\entities\Shop\Tag;
use shop\validators\SlugValidator;
use yii\base\Model;

class TagForm extends Model
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $slug;
    /**
     * @var Tag
     */
    private $_tag;

    /**
     * TagForm constructor.
     * @param Tag|null $tag
     * @param array $config
     */
    public function __construct(Tag $tag = null, $config = [])
    {
        if ($tag) {
            $this->name = $tag->name;
            $this->slug = $tag->slug;
            $this->_tag = $tag;
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Tag::class, 'filter' => $this->_tag ? ['<>', 'id', $this->_tag->id] : null]
        ];
    }
}
