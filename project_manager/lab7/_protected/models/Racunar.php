<?php

namespace app\models;

use Yii;
use \app\models\base\Racunar as BaseRacunar;

/**
 * This is the model class for table "lab7_racunar".
 */
class Racunar extends BaseRacunar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['opis'], 'string'],
            [['prostorija_id'], 'required'],
            [['prostorija_id'], 'integer'],
            [['naziv'], 'string', 'max' => 255]
        ]);
    }
	
}
