<?php

namespace app\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%rashod}}".
 *
 * @property integer $id
 * @property integer $aktivnost_id
 * @property string $opis
 * @property string $datum
 * @property string $novcani_iznos
 * @property integer $postoji
 *
 * @property \app\models\Aktivnost $aktivnost
 */
class Rashod extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aktivnost_id'], 'required'],
            [['aktivnost_id', 'postoji'], 'integer'],
            [['opis'], 'string'],
            [['datum'], 'safe'],
            [['novcani_iznos'], 'number']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rashod}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aktivnost_id' => 'Aktivnost ID',
            'opis' => 'Opis',
            'datum' => 'Datum',
            'novcani_iznos' => 'Novcani Iznos',
            'postoji' => 'Postoji',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivnost()
    {
        return $this->hasOne(\app\models\Aktivnost::className(), ['id' => 'aktivnost_id']);
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
     * @return \app\models\RashodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RashodQuery(get_called_class());
    }
}
