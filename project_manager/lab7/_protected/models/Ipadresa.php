<?php

namespace app\models;

use Yii;
use \app\models\base\Ipadresa as BaseIpadresa;

/**
 * This is the model class for table "lab7_ipadresa".
 */
class Ipadresa extends BaseIpadresa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['racunar_id'], 'required'],
            [['racunar_id'], 'integer'],
            [['dd', 'fqdn', 'kartica'], 'string', 'max' => 255]
        ]);
    }
	
}
