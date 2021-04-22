<?php

namespace common\models;
use common\models\Stock;
use common\models\Barang;

use Yii;

/**
 * This is the model class for table "detail_penjualan".
 *
 * @property int $id_detail
 * @property string $no_penjualan
 * @property string $sku_barang
 * @property int $id_stock
 * @property double $size
 * @property int $jumlah
 * @property double $harga_satuan
 *
 * @property Stock $stock
 * @property Penjualan $noPenjualan
 * @property Barang $skuBarang
 */
class DetailPenjualan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_penjualan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_detail', 'no_penjualan', 'sku_barang',  'size', 'jumlah', 'harga_satuan'], 'required'],
            [['id_detail',  'jumlah'], 'integer'],
            [['size', 'harga_satuan'], 'number'],
            [['no_penjualan', 'sku_barang'], 'string', 'max' => 50],
            [['id_detail'], 'unique'],
            [['no_penjualan'], 'exist', 'skipOnError' => true, 'targetClass' => Penjualan::className(), 'targetAttribute' => ['no_penjualan' => 'no_penjualan']],
            [['sku_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['sku_barang' => 'sku']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detail' => 'Id Detail',
            'no_penjualan' => 'No Penjualan',
            'sku_barang' => 'Sku Barang',
            'size' => 'Size',
            'jumlah' => 'Jumlah',
            'harga_satuan' => 'Harga Satuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoPenjualan()
    {
        return $this->hasOne(Penjualan::className(), ['no_penjualan' => 'no_penjualan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkuBarang()
    {
        return $this->hasOne(Barang::className(), ['sku' => 'sku_barang']);
    }
}
