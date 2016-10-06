<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RadiNaZadatku]].
 *
 * @see RadiNaZadatku
 */
class RadiNaZadatkuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RadiNaZadatku[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RadiNaZadatku|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}