<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Zadatak;

/**
 * app\models\ZadatakSearch represents the model behind the search form about `app\models\Zadatak`.
 */
 class ZadatakSearch extends Zadatak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projekat_id', 'radnih_sati_potrebno', 'aktivan', 'procenat_dovrsenosti', 'postoji'], 'integer'],
            [['naziv', 'pocetak_rada', 'kraj_rada', 'rok_za_zavrsetak', 'opis'], 'safe'],
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
        $query = Zadatak::find();

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
            'projekat_id' => $this->projekat_id,
            'pocetak_rada' => $this->pocetak_rada,
            'kraj_rada' => $this->kraj_rada,
            'rok_za_zavrsetak' => $this->rok_za_zavrsetak,
            'radnih_sati_potrebno' => $this->radnih_sati_potrebno,
            'aktivan' => $this->aktivan,
            'procenat_dovrsenosti' => $this->procenat_dovrsenosti,
            'postoji' => $this->postoji,
        ]);

        $query->andFilterWhere(['like', 'naziv', $this->naziv])
            ->andFilterWhere(['like', 'opis', $this->opis]);

        return $dataProvider;
    }
}
