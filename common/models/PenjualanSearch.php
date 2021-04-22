<?php

namespace common\models;

use common\models\Penjualan;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PenjualanSearch represents the model behind the search form of `app\models\Penjualan`.
 */
class PenjualanSearch extends Penjualan
{
    public $sku;
    public $all = false;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_penjualan', 'tanggal_penjualan', 'nama', 'jenis_kelamin', 'pekerjaan', 'keterangan', 'dibuat_oleh', 'sku'], 'safe'],
            [['umur'], 'integer'],
            [['total_harga'], 'number'],
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
        $query = Penjualan::find();

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
        if (isset($params['PenjualanSearch'])
            && !is_null($params['PenjualanSearch']['tanggal_penjualan']) && !empty($params['PenjualanSearch']['tanggal_penjualan'])) {
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

        $nop = [];
        if (isset($params['PenjualanSearch']) && isset($params['PenjualanSearch']['sku'])
            && !is_null($params['PenjualanSearch']['sku']) && !empty($params['PenjualanSearch']['sku'])) {
            foreach (DetailPenjualan::find()->andWhere(['sku_barang' => $this->sku])->all() as $det) {
                $nop[] = $det->no_penjualan;
            }
        }
        if (!is_null($this->tanggal_penjualan) && !empty($this->tanggal_penjualan) && strpos($this->tanggal_penjualan, ' to ') !== false) {
            list($dari, $ke) = explode(' to ', $this->tanggal_penjualan);
            if ($dari === $ke) { //COALESCE(to_char(last_post, 'MM-DD-YYYY HH24:MI:SS'), '') DATE_FORMAT(date,'%d/%m/%Y')
                $expression = new \yii\db\Expression("COALESCE(to_char(tanggal_penjualan, 'YYYY-MM-DD'), '')");
                $expression = new \yii\db\Expression("DATE_FORMAT(tanggal_penjualan,'%Y-%m-%d')");
                $query->andFilterWhere(['=', $expression, date("Y-m-d", strtotime($dari))]);
            } else {
                $query->andFilterWhere(['between', 'tanggal_penjualan', date("Y-m-d", strtotime($dari)), date("Y-m-d", strtotime($ke))]);
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'umur' => $this->umur,
            'total_harga' => $this->total_harga,
        ]);

        $query->andFilterWhere(['like', 'no_penjualan', $this->no_penjualan])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'dibuat_oleh', $this->dibuat_oleh]);
        if (!empty($nop)) {
            $query->andFilterWhere([
                'no_penjualan' => $nop,
            ]);
        }
        return $dataProvider;
    }
}
