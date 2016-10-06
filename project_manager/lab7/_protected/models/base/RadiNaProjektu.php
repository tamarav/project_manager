<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%radi_na_projektu}}".
 *
 * @property integer $ucesnik_id
 * @property integer $projekat_id
 * @property integer $id
 * @property integer $postoji
 *
 * @property \app\models\Projekat $projekat
 * @property \app\models\Ucesnik $ucesnik
 */
class RadiNaProjektu extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'projekat_id'], 'required'],
            [['ucesnik_id', 'projekat_id', 'postoji'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%radi_na_projektu}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ucesnik_id' => 'Ucesnik ID',
            'projekat_id' => 'Projekat ID',
            'id' => 'ID',
            'postoji' => 'Postoji',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekat()
    {
        return $this->hasOne(\app\models\Projekat::className(), ['id' => 'projekat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUcesnik()
    {
        return $this->hasOne(\app\models\Ucesnik::className(), ['id' => 'ucesnik_id']);
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
     * @return \app\models\RadiNaProjektuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RadiNaProjektuQuery(get_called_class());
    }
}
