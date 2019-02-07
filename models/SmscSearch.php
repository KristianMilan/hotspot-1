<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Smsc;

/**
 * SmscSearch represents the model behind the search form of `app\models\Smsc`.
 */
class SmscSearch extends Smsc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code', 'status'], 'integer'],
            [['mac', 'phone', 'ap_mac', 'time'], 'safe'],
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
        $query = Smsc::find();

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
            'code' => $this->code,
            'status' => $this->status,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'mac', $this->mac])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'ap_mac', $this->ap_mac])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
