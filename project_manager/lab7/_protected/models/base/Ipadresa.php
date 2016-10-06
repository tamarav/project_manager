<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "{{%ipadresa}}".
 *
 * @property integer $id
 * @property string $dd
 * @property string $fqdn
 * @property string $kartica
 * @property integer $racunar_id
 *
 * @property \app\models\Racunar $racunar
 */
class Ipadresa extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['racunar_id'], 'required'],
            [['racunar_id'], 'integer'],
            [['dd', 'fqdn', 'kartica'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ipadresa}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dd' => 'Dd',
            'fqdn' => 'Fqdn',
            'kartica' => 'Kartica',
            'racunar_id' => 'Racunar ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRacunar()
    {
        return $this->hasOne(\app\models\Racunar::className(), ['id' => 'racunar_id']);
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
     * @return \app\models\IpadresaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\IpadresaQuery(get_called_class());
    }
}
