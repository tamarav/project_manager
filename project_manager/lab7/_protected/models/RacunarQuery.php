<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Racunar]].
 *
 * @see Racunar
 */
class RacunarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Racunar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Racunar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}