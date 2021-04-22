<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $id_stock
 * @property string $sku_barang
 * @property int $id_detail
 * @property double $size
 * @property int $stock_awal
 * @property int $stock_real
 *
 * @property DetailPembelian $detail
 * @property Barang $skuBarang
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_barang', 'id_detail', 'size', 'stock_awal', 'stock_real'], 'required'],
            [['id_detail', 'stock_awal', 'stock_real'], 'integer'],
            [['size'], 'number'],
            [['sku_barang'], 'string', 'max' => 50],
            [['id_detail'], 'exist', 'skipOnError' => true, 'targetClass' => DetailPembelian::className(), 'targetAttribute' => ['id_detail' => 'id_detail']],
            [['sku_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['sku_barang' => 'sku']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_stock' => 'Id Stock',
            'sku_barang' => 'Sku Barang',
            'id_detail' => 'Id Detail',
            'size' => 'Size',
            'stock_awal' => 'Stock Awal',
            'stock_real' => 'Stock Real',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetail()
    {
        return $this->hasOne(DetailPembelian::className(), ['id_detail' => 'id_detail']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkuBarang()
    {
        return $this->hasOne(Barang::className(), ['sku' => 'sku_barang']);
    }
}
