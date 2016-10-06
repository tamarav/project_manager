<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RadiNaZadatku;

/**
 * app\models\RadiNaZadatkuSearch represents the model behind the search form about `app\models\RadiNaZadatku`.
 */
 class RadiNaZadatkuSearch extends RadiNaZadatku
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zadatak_id', 'ucesnik_id', 'postoji', 'id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RadiNaZadatku::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'zadatak_id' => $this->zadatak_id,
            'ucesnik_id' => $this->ucesnik_id,
            'postoji' => $this->postoji,
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}
