<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ipadresa]].
 *
 * @see Ipadresa
 */
class IpadresaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Ipadresa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ipadresa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}