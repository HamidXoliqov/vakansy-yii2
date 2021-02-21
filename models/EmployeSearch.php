<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employe;

/**
 * EmployeSearch represents the model behind the search form of `app\models\Employe`.
 */
class EmployeSearch extends Employe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'hired', 'updated', 'created','employe_status_id'], 'integer'],
            [['lastname', 'firstname', 'address', 'country_of_origin', 'email', 'phone_number'], 'safe'],
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
    public function search($params, $queryModel = null, $isAll = false)
    {
        if (!empty($queryModel))
        {
            $query = $queryModel;
        }
        else{
            $query = Employe::find();
        }
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);

        if ($isAll)
            $dataProvider->setPagination(false);
            
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'age' => $this->age,
            'employe_status_id' => $this->employe_status_id,
            'hired' => $this->hired,
            'updated' => $this->updated,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country_of_origin', $this->country_of_origin])
            ->andFilterWhere(['like', 'employe_status_id', $this->employe_status_id])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number]);

        return $dataProvider;
    }
}
