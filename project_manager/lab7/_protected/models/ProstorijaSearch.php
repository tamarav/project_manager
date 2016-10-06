<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prostorija;

/**
 * app\models\ProstorijaSearch represents the model behind the search form about `app\models\Prostorija`.
 */
 class ProstorijaSearch extends Prostorija
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'broj', 'sprat', 'zgrada'], 'integer'],
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
        $query = Prostorija::find();

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
            'broj' => $this->broj,
            'sprat' => $this->sprat,
            'zgrada' => $this->zgrada,
        ]);

        $query->andFilterWhere(['like', 'naziv', $this->naziv])
            ->andFilterWhere(['like', 'opis', $this->opis]);

        return $dataProvider;
    }
}
