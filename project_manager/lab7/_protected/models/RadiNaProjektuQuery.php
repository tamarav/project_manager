<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RadiNaProjektu]].
 *
 * @see RadiNaProjektu
 */
class RadiNaProjektuQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return RadiNaProjektu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RadiNaProjektu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}