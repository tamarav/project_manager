<?php

namespace app\models;

use Yii;
use \app\models\base\Aktivnost as BaseAktivnost;

/**
 * This is the model class for table "aktivnost".
 */
class Aktivnost extends BaseAktivnost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ucesnik_id', 'zadatak_id'], 'required'],
            [['ucesnik_id', 'zadatak_id', 'postoji'], 'integer'],
            [['opis'], 'string'],
            [['datum'], 'safe'],
            [['potroseno_vremena'], 'string', 'max' => 45]
        ]);
    }
	
}
