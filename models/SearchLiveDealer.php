<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblDealer;

/**
 * SearchDealer represents the model behind the search form of `app\models\TblDealer`.
 */
class SearchLiveDealer extends TblDealer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pid'], 'integer'],
            [['name', 'branchname','vehicle_count', 'address1', 'address2', 'address3', 'city', 'postcode', 'phone', 'mobile', 'contact_name', 'contact_title', 'dealer_web', 'dealer_email', 'outcode','longitude','latitude', 'updated_at', 'created_at'], 'safe'],
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
        $query = TblDealer::find();

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
            'pid' => $this->pid,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);
	$query->andFilterWhere(['has_stock'=>1]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'branchname', $this->branchname])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'address3', $this->address3])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_title', $this->contact_title])
            ->andFilterWhere(['like', 'dealer_web', $this->dealer_web])
            ->andFilterWhere(['like', 'dealer_email', $this->dealer_email])
            ->andFilterWhere(['like', 'outcode', $this->outcode])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['>', 'vehicle_count', $this->vehicle_count])
            ->andFilterWhere(['like', 'latitude', $this->latitude]);

        return $dataProvider;
    }
}
