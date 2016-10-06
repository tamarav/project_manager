<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%zadatak}}".
 *
 * @property integer $id
 * @property integer $projekat_id
 * @property string $naziv
 * @property string $pocetak_rada
 * @property string $kraj_rada
 * @property string $rok_za_zavrsetak
 * @property integer $radnih_sati_potrebno
 * @property string $opis
 * @property integer $aktivan
 * @property integer $procenat_dovrsenosti
 * @property integer $postoji
 *
 * @property \app\models\Aktivnost[] $aktivnosts
 * @property \app\models\RadiNaZadatku[] $radiNaZadatkus
 * @property \app\models\Projekat $projekat
 */
class Zadatak extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projekat_id'], 'required'],
            [['projekat_id', 'radnih_sati_potrebno', 'aktivan', 'procenat_dovrsenosti', 'postoji'], 'integer'],
            [['pocetak_rada', 'kraj_rada', 'rok_za_zavrsetak'], 'safe'],
            [['opis'], 'string'],
            [['naziv'], 'string', 'max' => 200]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zadatak}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projekat_id' => 'Projekat ID',
            'naziv' => 'Naziv',
            'pocetak_rada' => 'Pocetak Rada',
            'kraj_rada' => 'Kraj Rada',
            'rok_za_zavrsetak' => 'Rok Za Zavrsetak',
            'radnih_sati_potrebno' => 'Radnih Sati Potrebno',
            'opis' => 'Opis',
            'aktivan' => 'Aktivan',
            'procenat_dovrsenosti' => 'Procenat Dovrsenosti',
            'postoji' => 'Postoji',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivnosts()
    {
        return $this->hasMany(\app\models\Aktivnost::className(), ['zadatak_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadiNaZadatkus()
    {
        return $this->hasMany(\app\models\RadiNaZadatku::className(), ['zadatak_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekat()
    {
        return $this->hasOne(\app\models\Projekat::className(), ['id' => 'projekat_id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ZadatakQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ZadatakQuery(get_called_class());
    }
}
