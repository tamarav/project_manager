<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Racunar;

/**
 * app\models\RacunarSearch represents the model behind the search form about `app\models\Racunar`.
 */
 class RacunarSearch extends Racunar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'prostorija_id'], 'integer'],
            [['naziv', 'opis'], 'safe'],
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
        $query = Racunar::find();

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
            'prostorija_id' => $this->prostorija_id,
        ]);

        $query->andFilterWhere(['like', 'naziv', $this->naziv])
            ->andFilterWhere(['like', 'opis', $this->opis]);

        return $dataProvider;
    }
}
