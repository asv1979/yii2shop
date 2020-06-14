<?php

namespace shop\forms\manage\Shop\Product;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class PhotosForm
 * @package shop\forms\manage\Shop\Product
 */
class PhotosForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }
}
