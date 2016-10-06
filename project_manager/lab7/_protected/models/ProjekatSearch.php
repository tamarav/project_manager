<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projekat;

/**
 * app\models\ProjekatSearch represents the model behind the search form about `app\models\Projekat`.
 */
 class ProjekatSearch extends Projekat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktivan', 'uradjeno', 'postoji', 'sef_na_projektu', 'nadzor'], 'integer'],
            [['naziv', 'datum_pocetka_rada', 'datum_kraja_rada', 'opis_projekta', 'krajnji_rok'], 'safe'],
            [['budzet'], 'number'],
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
        $query = Projekat::find();

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
            'datum_pocetka_rada' => $this->datum_pocetka_rada,
            'datum_kraja_rada' => $this->datum_kraja_rada,
            'budzet' => $this->budzet,
            'aktivan' => $this->aktivan,
            'krajnji_rok' => $this->krajnji_rok,
            'uradjeno' => $this->uradjeno,
            'postoji' => $this->postoji,
            'sef_na_projektu' => $this->sef_na_projektu,
            'nadzor' => $this->nadzor,
        ]);

        $query->andFilterWhere(['like', 'naziv', $this->naziv])
            ->andFilterWhere(['like', 'opis_projekta', $this->opis_projekta]);

        return $dataProvider;
    }
}
