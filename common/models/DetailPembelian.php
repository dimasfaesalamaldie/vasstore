<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "detail_pembelian".
 *
 * @property int $id_detail
 * @property string $no_pembelian
 * @property string $sku_barang
 * @property int $size
 * @property int $jumlah
 * @property double $harga_satuan
 *
 * @property Barang $skuBarang
 * @property Pembelian $noPembelian
 * @property Stock[] $stocks
 */
class DetailPembelian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_pembelian', 'sku_barang', 'size', 'jumlah', 'harga_satuan'], 'required'],
            [['size', 'jumlah'], 'integer'],
            [['harga_satuan'], 'number'],
            [['no_pembelian', 'sku_barang'], 'string', 'max' => 50],
            [['sku_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['sku_barang' => 'sku']],
            [['no_pembelian'], 'exist', 'skipOnError' => true, 'targetClass' => Pembelian::className(), 'targetAttribute' => ['no_pembelian' => 'no_pembelian']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_detail' => 'Id Detail',
            'no_pembelian' => 'No Pembelian',
            'sku_barang' => 'Sku Barang',
            'size' => 'Size',
            'jumlah' => 'Jumlah',
            'harga_satuan' => 'Harga Satuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkuBarang()
    {
        return $this->hasOne(Barang::className(), ['sku' => 'sku_barang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoPembelian()
    {
        return $this->hasOne(Pembelian::className(), ['no_pembelian' => 'no_pembelian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['id_detail' => 'id_detail']);
    }
}
