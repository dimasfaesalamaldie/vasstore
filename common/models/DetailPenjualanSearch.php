<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DetailPenjualan;

/**
 * DetailPenjualanSearch represents the model behind the search form of `app\models\DetailPenjualan`.
 */
class DetailPenjualanSearch extends DetailPenjualan
{
    public $tanggal_penjualan;
    public $all = false;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_detail',  'jumlah'], 'integer'],
            [['no_penjualan', 'sku_barang', 'tanggal_penjualan'], 'safe'],
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
            'size' => $this->size,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
        ]);

        $query->andFilterWhere(['like', 'no_penjualan', $this->no_penjualan])
            ->andFilterWhere(['like', 'sku_barang', $this->sku_barang]);

        return $dataProvider;
    }

    public function search2($params)
    {
        $query = DetailPenjualan::find();
        $query->joinWith(['noPenjualan']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if ($this->all) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]);
        }
        if (isset($params['DetailPenjualanSearch'])
            && !is_null($params['DetailPenjualanSearch']['tanggal_penjualan']) && !empty($params['DetailPenjualanSearch']['tanggal_penjualan'])) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]);
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->sort->attributes['tanggal_penjualan'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['penjualan.tanggal_penjualan' => SORT_ASC],
            'desc' => ['penjualan.tanggal_penjualan' => SORT_DESC],
        ];

        if (!is_null($this->tanggal_penjualan) && !empty($this->tanggal_penjualan) && strpos($this->tanggal_penjualan, ' to ') !== false) {
            list($dari, $ke) = explode(' to ', $this->tanggal_penjualan);
            if ($dari === $ke) { //COALESCE(to_char(last_post, 'MM-DD-YYYY HH24:MI:SS'), '') DATE_FORMAT(date,'%d/%m/%Y')
                $expression = new \yii\db\Expression("COALESCE(to_char(penjualan.tanggal_penjualan, 'YYYY-MM-DD'), '')");
                $expression = new \yii\db\Expression("DATE_FORMAT(penjualan.tanggal_penjualan,'%Y-%m-%d')");
                $query->andFilterWhere(['=', $expression, date("Y-m-d", strtotime($dari))]);
            } else {
                $query->andFilterWhere(['between', 'penjualan.tanggal_penjualan', date("Y-m-d", strtotime($dari)), date("Y-m-d", strtotime($ke))]);
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_detail' => $this->id_detail,
            'size' => $this->size,
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
        ]);

        $query->andFilterWhere(['like', 'no_penjualan', $this->no_penjualan])
            ->andFilterWhere(['like', 'sku_barang', $this->sku_barang]);

        return $dataProvider;
    }
}
