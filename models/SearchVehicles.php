<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblVehicles;

/**
 * SearchVehicles represents the model behind the search form of `app\models\TblVehicles`.
 */
class SearchVehicles extends TblVehicles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'did', 'mileage', 'doors', 'seats', 'status', 'detail_check', 'mot_check', 'has_images'], 'integer'],
            [['make', 'model', 'colour', 'fuel_type', 'year', 'dealer_description', 'post_code', 'orig_url', 'full_name', 'model_type', 'engine_type', 'engine_size', 'transmission', 'registration', 'phone', 'images', 'default_image', 'engine_configuration', 'interior_colour', 'h1_text', 'mot_check_date', 'slug', 'model_family', 'listed_date', 'created_at', 'amended_at'], 'safe'],
            [['price'], 'number'],
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
        $query = TblVehicles::find();

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
            'did' => $this->did,
            'price' => $this->price,
            'mileage' => $this->mileage,
            'doors' => $this->doors,
            'seats' => $this->seats,
            'status' => $this->status,
            'detail_check' => $this->detail_check,
            'mot_check' => $this->mot_check,
            'mot_check_date' => $this->mot_check_date,
            'listed_date' => $this->listed_date,
            'has_images' => $this->has_images,
            'created_at' => $this->created_at,
            'amended_at' => $this->amended_at,
        ]);

        $query->andFilterWhere(['like', 'make', $this->make])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'colour', $this->colour])
            ->andFilterWhere(['like', 'fuel_type', $this->fuel_type])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'dealer_description', $this->dealer_description])
            ->andFilterWhere(['like', 'post_code', $this->post_code])
            ->andFilterWhere(['like', 'orig_url', $this->orig_url])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'model_type', $this->model_type])
            ->andFilterWhere(['like', 'engine_type', $this->engine_type])
            ->andFilterWhere(['like', 'engine_size', $this->engine_size])
            ->andFilterWhere(['like', 'transmission', $this->transmission])
            ->andFilterWhere(['like', 'registration', $this->registration])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'default_image', $this->default_image])
            ->andFilterWhere(['like', 'engine_configuration', $this->engine_configuration])
            ->andFilterWhere(['like', 'interior_colour', $this->interior_colour])
            ->andFilterWhere(['like', 'h1_text', $this->h1_text])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'model_family', $this->model_family]);

        return $dataProvider;
    }
}
