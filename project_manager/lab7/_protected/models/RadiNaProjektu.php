<?php

namespace app\models;

use Yii;
use \app\models\base\RadiNaProjektu as BaseRadiNaProjektu;

/**
 * This is the model class for table "radi_na_projektu".
 */
class RadiNaProjektu extends BaseRadiNaProjektu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['ucesnik_id', 'projekat_id'], 'required'],
            [['ucesnik_id', 'projekat_id', 'postoji'], 'integer']
        ]);
    }
	
}
