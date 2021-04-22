<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "safety_stock".
 *
 * @property int $id_safety
 * @property string $sku_barang
 * @property int $max
 * @property double $rerata
 * @property int $leadtime
 *
 * @property Barang $skuBarang
 */
class SafetyStock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'safety_stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku_barang', 'leadtime'], 'required'],
            [['max', 'leadtime', 'stock', 'safety_stock', 'rop', 'status', 'terjual', 'size', 'eoq'], 'integer'],
            [['rerata'], 'number'],
            [['sku_barang'], 'string', 'max' => 50],
            [['sku_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['sku_barang' => 'sku']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_safety' => 'Id Safety',
            'rop' => 'Reorder Point',
            'sku_barang' => 'Barang',
            'max' => 'Max',
            'rerata' => 'Rata-Rata',
            'leadtime' => 'Leadtime (Hari)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkuBarang()
    {
        return $this->hasOne(Barang::className(), ['sku' => 'sku_barang']);
    }
}
