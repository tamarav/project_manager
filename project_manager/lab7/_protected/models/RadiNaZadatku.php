<?php

namespace app\models;

use Yii;
use \app\models\base\RadiNaZadatku as BaseRadiNaZadatku;

/**
 * This is the model class for table "radi_na_zadatku".
 */
class RadiNaZadatku extends BaseRadiNaZadatku
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['zadatak_id', 'ucesnik_id'], 'required'],
            [['zadatak_id', 'ucesnik_id', 'postoji'], 'integer']
        ]);
    }
	
}
