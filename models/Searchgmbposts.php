<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblLocalPost;

/**
 * Searchgmbposts represents the model behind the search form of `app\models\TblLocalPost`.
 */
class Searchgmbposts extends TblLocalPost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dealer_id', 'vehicle_id','status'], 'integer'],
            [['created_at', 'amended_at', 'local_id', 'post_type', 'start_date', 'end_date', 'start_time', 'end_time', 'summary', 'event_title', 'action_type', 'image_url', 'postname', 'cta_url'], 'safe'],
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
        $query = TblLocalPost::find();

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
            'dealer_id' => $this->dealer_id,
            'vehicle_id' => $this->vehicle_id,
            'created_at' => $this->created_at,
            'amended_at' => $this->amended_at,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status'=>$this->status,
        ]);

        $query->andFilterWhere(['like', 'local_id', $this->local_id])
            ->andFilterWhere(['like', 'post_type', $this->post_type])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'event_title', $this->event_title])
            ->andFilterWhere(['like', 'action_type', $this->action_type])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'postname', $this->postname])
            ->andFilterWhere(['like', 'cta_url', $this->cta_url]);

        return $dataProvider;
    }
}
