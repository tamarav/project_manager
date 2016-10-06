<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Prostorija]].
 *
 * @see Prostorija
 */
class ProstorijaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Prostorija[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Prostorija|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}