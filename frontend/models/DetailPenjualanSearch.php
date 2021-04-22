<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailPenjualan;

/**
 * DetailPenjualanSearch represents the model behind the search form of `app\models\DetailPenjualan`.
 */
class DetailPenjualanSearch extends DetailPenjualan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_detail', 'id_stock', 'jumlah'], 'integer'],
            [['no_penjualan', 'sku_barang'], 'safe'],
            [['size', 'harga_satuan'], 'number'],
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
        $query = DetailPenjualan::find();

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
            'id_detail' => $this->id_detail,
            'id_stock' => $this->id_stock,
            'size' => $this->size,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
        ]);

        $query->andFilterWhere(['like', 'no_penjualan', $this->no_penjualan])
            ->andFilterWhere(['like', 'sku_barang', $this->sku_barang]);

        return $dataProvider;
    }
}
