<?php

namespace app\models;

use Yii;
use \app\models\base\Projekat as BaseProjekat;

/**
 * This is the model class for table "projekat".
 */
class Projekat extends BaseProjekat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['datum_pocetka_rada', 'datum_kraja_rada', 'krajnji_rok'], 'safe'],
            [['budzet'], 'number'],
            [['opis_projekta'], 'string'],
            [['aktivan', 'uradjeno', 'postoji', 'sef_na_projektu', 'nadzor'], 'integer'],
            [['sef_na_projektu', 'nadzor'], 'required'],
            [['naziv'], 'string', 'max' => 200]
        ]);
    }
	
}
