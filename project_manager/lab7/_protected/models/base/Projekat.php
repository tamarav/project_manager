<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "{{%projekat}}".
 *
 * @property integer $id
 * @property string $naziv
 * @property string $datum_pocetka_rada
 * @property string $datum_kraja_rada
 * @property string $budzet
 * @property string $opis_projekta
 * @property integer $aktivan
 * @property string $krajnji_rok
 * @property integer $uradjeno
 * @property integer $postoji
 * @property integer $sef_na_projektu
 * @property integer $nadzor
 *
 * @property \app\models\Ucesnik $nadzor0
 * @property \app\models\Ucesnik $sefNaProjektu
 * @property \app\models\RadiNaProjektu[] $radiNaProjektus
 * @property \app\models\Zadatak[] $zadataks
 */
class Projekat extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datum_pocetka_rada', 'datum_kraja_rada', 'krajnji_rok'], 'safe'],
            [['budzet'], 'number'],
            [['opis_projekta'], 'string'],
            [['aktivan', 'uradjeno', 'postoji', 'sef_na_projektu', 'nadzor'], 'integer'],
            [['sef_na_projektu', 'nadzor'], 'required'],
            [['naziv'], 'string', 'max' => 200]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projekat}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'naziv' => 'Naziv',
            'datum_pocetka_rada' => 'Datum Pocetka Rada',
            'datum_kraja_rada' => 'Datum Kraja Rada',
            'budzet' => 'Budzet',
            'opis_projekta' => 'Opis Projekta',
            'aktivan' => 'Aktivan',
            'krajnji_rok' => 'Krajnji Rok',
            'uradjeno' => 'Uradjeno',
            'postoji' => 'Postoji',
            'sef_na_projektu' => 'Sef Na Projektu',
            'nadzor' => 'Nadzor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNadzor0()
    {
        return $this->hasOne(\app\models\Ucesnik::className(), ['id' => 'nadzor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSefNaProjektu()
    {
        return $this->hasOne(\app\models\Ucesnik::className(), ['id' => 'sef_na_projektu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadiNaProjektus()
    {
        return $this->hasMany(\app\models\RadiNaProjektu::className(), ['projekat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZadataks()
    {
        return $this->hasMany(\app\models\Zadatak::className(), ['projekat_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\ProjekatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProjekatQuery(get_called_class());
    }
}
