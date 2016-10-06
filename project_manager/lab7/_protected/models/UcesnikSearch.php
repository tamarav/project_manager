<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ucesnik;

/**
 * app\models\UcesnikSearch represents the model behind the search form about `app\models\Ucesnik`.
 */
 class UcesnikSearch extends Ucesnik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'postoji', 'user_id'], 'integer'],
            [['ime', 'prezime', 'vrsta_ucesnika'], 'safe'],
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
        $query = Ucesnik::find();

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
            'id' => $this->id,
            'postoji' => $this->postoji,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'ime', $this->ime])
            ->andFilterWhere(['like', 'prezime', $this->prezime])
            ->andFilterWhere(['like', 'vrsta_ucesnika', $this->vrsta_ucesnika]);

        return $dataProvider;
    }
}
