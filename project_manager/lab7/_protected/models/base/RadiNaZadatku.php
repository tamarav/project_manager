<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%radi_na_zadatku}}".
 *
 * @property integer $zadatak_id
 * @property integer $ucesnik_id
 * @property integer $postoji
 * @property integer $id
 *
 * @property \app\models\Ucesnik $ucesnik
 * @property \app\models\Zadatak $zadatak
 */
class RadiNaZadatku extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zadatak_id', 'ucesnik_id'], 'required'],
            [['zadatak_id', 'ucesnik_id', 'postoji'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%radi_na_zadatku}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zadatak_id' => 'Zadatak ID',
            'ucesnik_id' => 'Ucesnik ID',
            'postoji' => 'Postoji',
            'id' => 'ID',
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
     * @return \app\models\RadiNaZadatkuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RadiNaZadatkuQuery(get_called_class());
    }
}
