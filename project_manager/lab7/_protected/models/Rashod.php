<?php

namespace app\models;

use Yii;
use \app\models\base\Rashod as BaseRashod;

/**
 * This is the model class for table "rashod".
 */
class Rashod extends BaseRashod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['aktivnost_id'], 'required'],
            [['aktivnost_id', 'postoji'], 'integer'],
            [['opis'], 'string'],
            [['datum'], 'safe'],
            [['novcani_iznos'], 'number']
        ]);
    }
	
}
