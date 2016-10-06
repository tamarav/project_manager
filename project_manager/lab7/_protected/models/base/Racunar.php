<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%racunar}}".
 *
 * @property integer $id
 * @property string $naziv
 * @property string $opis
 * @property integer $prostorija_id
 *
 * @property \app\models\Ipadresa[] $ipadresas
 * @property \app\models\Prostorija $prostorija
 */
class Racunar extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['opis'], 'string'],
            [['prostorija_id'], 'required'],
            [['prostorija_id'], 'integer'],
            [['naziv'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%racunar}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'naziv' => 'Naziv',
            'opis' => 'Opis',
            'prostorija_id' => 'Prostorija ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIpadresas()
    {
        return $this->hasMany(\app\models\Ipadresa::className(), ['racunar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProstorija()
    {
        return $this->hasOne(\app\models\Prostorija::className(), ['id' => 'prostorija_id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\RacunarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RacunarQuery(get_called_class());
    }
}
