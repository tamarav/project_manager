<?php

namespace app\models;

use Yii;
use \app\models\base\Ucesnik as BaseUcesnik;

/**
 * This is the model class for table "ucesnik".
 */
class Ucesnik extends BaseUcesnik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['postoji', 'user_id'], 'integer'],
            [['ime', 'prezime', 'vrsta_ucesnika'], 'string', 'max' => 45]
        ]);
    }
	
}
