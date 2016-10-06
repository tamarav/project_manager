<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aktivnost;

/**
 * app\models\AktivnostSearch represents the model behind the search form about `app\models\Aktivnost`.
 */
 class AktivnostSearch extends Aktivnost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ucesnik_id', 'zadatak_id', 'postoji'], 'integer'],
            [['opis', 'potroseno_vremena', 'datum'], 'safe'],
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
        $query = Aktivnost::find();

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
            'ucesnik_id' => $this->ucesnik_id,
            'zadatak_id' => $this->zadatak_id,
            'datum' => $this->datum,
            'postoji' => $this->postoji,
        ]);

        $query->andFilterWhere(['like', 'opis', $this->opis])
            ->andFilterWhere(['like', 'potroseno_vremena', $this->potroseno_vremena]);

        return $dataProvider;
    }
}
