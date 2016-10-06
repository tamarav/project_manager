<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "{{%ucesnik}}".
 *
 * @property integer $id
 * @property string $ime
 * @property string $prezime
 * @property string $vrsta_ucesnika
 * @property integer $postoji
 * @property integer $user_id
 *
 * @property \app\models\Aktivnost[] $aktivnosts
 * @property \app\models\Projekat[] $projekats
 * @property \app\models\RadiNaProjektu[] $radiNaProjektus
 * @property \app\models\RadiNaZadatku[] $radiNaZadatkus
 * @property \app\models\User $user
 */
class Ucesnik extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postoji', 'user_id'], 'integer'],
            [['ime', 'prezime', 'vrsta_ucesnika'], 'string', 'max' => 45]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ucesnik}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ime' => 'Ime',
            'prezime' => 'Prezime',
            'vrsta_ucesnika' => 'Vrsta Ucesnika',
            'postoji' => 'Postoji',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAktivnosts()
    {
        return $this->hasMany(\app\models\Aktivnost::className(), ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekats()
    {
        return $this->hasMany(\app\models\Projekat::className(), ['sef_na_projektu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadiNaProjektus()
    {
        return $this->hasMany(\app\models\RadiNaProjektu::className(), ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadiNaZadatkus()
    {
        return $this->hasMany(\app\models\RadiNaZadatku::className(), ['ucesnik_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\UcesnikQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\UcesnikQuery(get_called_class());
    }
	public static function vratiIdUcesnika($idUser){
	   return Ucesnik::find()->where(['user_id'=>$idUser])->one()->id;
	}
}
