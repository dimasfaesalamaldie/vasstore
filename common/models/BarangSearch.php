<?php

namespace common\models;

use common\models\Barang;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BarangSearch represents the model behind the search form of `app\models\Barang`.
 */
class BarangSearch extends Barang
{
    public $sort = 0;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'nama', 'keterangan', 'warna', 'gender', 'dibuat_oleh', 'diubah_oleh'], 'safe'],
            [['id_kriteria', 'aktif', 'stock', 'leadtime', 'status', 'biaya_penyimpanan', 'biaya_pemesanan', 'harga_beli'], 'integer'],
            [['harga'], 'number'],
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
        $query = Barang::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if ($this->sort== 1) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['status' => SORT_DESC]],
            ]);
        }
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions stock status  'biaya_pemesanan', 'harga_beli'
        $query->andFilterWhere([
            'id_kriteria' => $this->id_kriteria,
            'harga' => $this->harga,
            'aktif' => $this->aktif,
            'stock' => $this->stock,
            'leadtime' => $this->leadtime, 
            'status' => $this->status,
            'biaya_penyimpanan' => $this->biaya_penyimpanan,
            'biaya_pemesanan' => $this->biaya_pemesanan,
            'harga_beli' => $this->harga_beli,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'warna', $this->warna])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'dibuat_oleh', $this->dibuat_oleh])
            ->andFilterWhere(['like', 'diubah_oleh', $this->diubah_oleh]);

        return $dataProvider;
    }
}
