<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prihod;

/**
 * app\models\PrihodSearch represents the model behind the search form about `app\models\Prihod`.
 */
 class PrihodSearch extends Prihod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktivnost_id', 'postoji'], 'integer'],
            [['opis', 'datum'], 'safe'],
            [['novcani_iznos'], 'number'],
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
        $query = Prihod::find();

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
            'aktivnost_id' => $this->aktivnost_id,
            'datum' => $this->datum,
            'novcani_iznos' => $this->novcani_iznos,
            'postoji' => $this->postoji,
        ]);

        $query->andFilterWhere(['like', 'opis', $this->opis]);

        return $dataProvider;
    }
}
