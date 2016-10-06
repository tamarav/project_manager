<?php

namespace app\models;

use Yii;
use \app\models\base\Zadatak as BaseZadatak;

/**
 * This is the model class for table "zadatak".
 */
class Zadatak extends BaseZadatak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['projekat_id'], 'required'],
            [['projekat_id', 'radnih_sati_potrebno', 'aktivan', 'procenat_dovrsenosti', 'postoji'], 'integer'],
            [['pocetak_rada', 'kraj_rada', 'rok_za_zavrsetak'], 'safe'],
            [['opis'], 'string'],
            [['naziv'], 'string', 'max' => 200]
        ]);
    }
	
}
