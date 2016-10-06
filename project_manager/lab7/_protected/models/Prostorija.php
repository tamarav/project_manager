<?php

namespace app\models;

use Yii;
use \app\models\base\Prostorija as BaseProstorija;

/**
 * This is the model class for table "lab7_prostorija".
 */
class Prostorija extends BaseProstorija
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['broj', 'sprat', 'zgrada'], 'required'],
            [['broj', 'sprat', 'zgrada'], 'integer'],
            [['opis'], 'string'],
            [['naziv'], 'string', 'max' => 255],
            [['broj'], 'unique']
        ]);
    }
	
}
