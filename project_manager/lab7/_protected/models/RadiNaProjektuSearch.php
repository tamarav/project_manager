<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RadiNaProjektu;

/**
 * app\models\RadiNaProjektuSearch represents the model behind the search form about `app\models\RadiNaProjektu`.
 */
 class RadiNaProjektuSearch extends RadiNaProjektu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ucesnik_id', 'projekat_id', 'id', 'postoji'], 'integer'],
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
        $query = RadiNaProjektu::find();

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
            'ucesnik_id' => $this->ucesnik_id,
            'projekat_id' => $this->projekat_id,
            'id' => $this->id,
            'postoji' => $this->postoji,
        ]);

        return $dataProvider;
    }
}
