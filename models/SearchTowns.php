<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblTowns;

/**
 * SearchTowns represents the model behind the search form of `app\models\TblTowns`.
 */
class SearchTowns extends TblTowns
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['town', 'outcode', 'town_slug', 'longitude', 'latitude'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TblTowns::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'town', $this->town])
            ->andFilterWhere(['like', 'outcode', $this->outcode])
            ->andFilterWhere(['like', 'town_slug', $this->town_slug])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude]);

        return $dataProvider;
    }
}
