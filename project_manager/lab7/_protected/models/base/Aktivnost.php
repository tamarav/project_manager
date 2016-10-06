<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%aktivnost}}".
 *
 * @property integer $id
 * @property integer $ucesnik_id
 * @property integer $zadatak_id
 * @property string $opis
 * @property string $potroseno_vremena
 * @property string $datum
 * @property integer $postoji
 *
 * @property \app\models\Ucesnik $ucesnik
 * @property \app\models\Zadatak $zadatak
 * @property \app\models\Prihod[] $prihods
 * @property \app\models\Rashod[] $rashods
 */
class Aktivnost extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'zadatak_id'], 'required'],
            [['ucesnik_id', 'zadatak_id', 'postoji'], 'integer'],
            [['opis'], 'string'],
            [['datum'], 'safe'],
            [['potroseno_vremena'], 'string', 'max' => 45]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%aktivnost}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ucesnik_id' => 'Ucesnik ID',
            'zadatak_id' => 'Zadatak ID',
            'opis' => 'Opis',
            'potroseno_vremena' => 'Potroseno Vremena',
            'datum' => 'Datum',
            'postoji' => 'Postoji',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnik()
    {
        return $this->hasOne(\app\models\Ucesnik::className(), ['id' => 'ucesnik_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZadatak()
    {
        return $this->hasOne(\app\models\Zadatak::className(), ['id' => 'zadatak_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrihods()
    {
        return $this->hasMany(\app\models\Prihod::className(), ['aktivnost_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRashods()
    {
        return $this->hasMany(\app\models\Rashod::className(), ['aktivnost_id' => 'id']);
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
     * @return \app\models\AktivnostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AktivnostQuery(get_called_class());
    }
}
