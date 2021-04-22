<?php

namespace common\models;

use common\models\SafetyStock;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SafetyStockSearch represents the model behind the search form of `app\models\SafetyStock`.
 */
class SafetyStockSearch extends SafetyStock
{
    public $sort = 0;
    public $aktif = 0;
    public $pagination = true;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_safety', 'max', 'leadtime', 'stock', 'safety_stock', 'status', 'size', 'aktif', 'sort', 'rop', 'terjual'], 'integer'],
            [['sku_barang'], 'safe'],
            [['rerata'], 'number'],
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
        $query = SafetyStock::find();
        //$query->joinWith(['skuBarang']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['status' => SORT_DESC, 'sku_barang' => SORT_ASC, 'size' => SORT_ASC]],
        ]);
        if (!$this->pagination) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['status' => SORT_DESC, 'sku_barang' => SORT_ASC, 'size' => SORT_ASC]],
                'pagination' => false,
            ]);
        }
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        // grid filtering conditions , 'stock', 'safety_stock' , 'aktif' , 'status' size  'terjual'
        $query->andFilterWhere([
            'id_safety' => $this->id_safety,
            'max' => $this->max,
            'rerata' => $this->rerata,
            'leadtime' => $this->leadtime,
            'stock' => $this->stock,
            'safety_stock' => $this->safety_stock,
            'size' => $this->size,
            'status' => $this->status,
            'rop' => $this->rop,
            'terjual' => $this->terjual,
            'eoq' => $this->eoq,
            // 'barang.aktif' => $this->aktif,
        ]);

        $query->andFilterWhere(['like', 'sku_barang', $this->sku_barang]);

        return $dataProvider;
    }
}
