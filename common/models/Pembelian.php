<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pembelian".
 *
 * @property string $no_pembelian
 * @property string $no_faktur
 * @property string $tanggal_pembelian
 * @property double $total_harga
 * @property string $keterangan
 * @property string $dibuat_oleh
 *
 * @property DetailPembelian[] $detailPembelians
 * @property Admin $dibuatOleh
 */
class Pembelian extends \yii\db\ActiveRecord
{
    public $details = [];
    public $detail ;
    public $biaya_pemesanan;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembelian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_pembelian', 'tanggal_pembelian', 'total_harga',  'dibuat_oleh', 'biaya_pemesanan'], 'required'],
            [['tanggal_pembelian', 'details', 'detail'], 'safe'],
            [['no_pembelian', 'no_faktur'], 'string', 'max' => 50],
            [['keterangan'], 'string', 'max' => 500],
            [['dibuat_oleh'], 'string', 'max' => 16],
            [['no_pembelian'], 'unique'],
            [['dibuat_oleh'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['dibuat_oleh' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_pembelian' => 'No Pembelian',
            'no_faktur' => 'No Faktur',
            'tanggal_pembelian' => 'Tanggal Pembelian',
            'total_harga' => 'Total Harga',
            'keterangan' => 'Keterangan',
            'dibuat_oleh' => 'Dibuat Oleh',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembelians()
    {
        return $this->hasMany(DetailPembelian::className(), ['no_pembelian' => 'no_pembelian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDibuatOleh()
    {
        return $this->hasOne(Admin::className(), ['username' => 'dibuat_oleh']);
    }
}
