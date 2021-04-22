<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property string $sku
 * @property int $id_kriteria
 * @property string $nama
 * @property string $keterangan
 * @property string $warna
 * @property string $gender
 * @property double $harga
 * @property string $dibuat_oleh
 * @property string $diubah_oleh
 * @property int $aktif
 *
 * @property Kriteria $kriteria
 * @property Admin $dibuatOleh
 * @property Admin $diubahOleh
 * @property DetailPembelian[] $detailPembelians
 * @property SafetyStock[] $safetyStocks
 * @property Stock[] $stocks
 */
class Barang extends \yii\db\ActiveRecord
{
    public $eoq;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'id_kriteria', 'nama',  'warna', 'gender', 'harga', 'dibuat_oleh', 'aktif'], 'required'],
            [['id_kriteria', 'aktif', 'stock', 'leadtime', 'status', 'biaya_penyimpanan', 'biaya_pemesanan', 'harga_beli'], 'integer'], // '', ''
            [['harga'], 'number'],
            [['sku', 'nama', 'warna'], 'string', 'max' => 50],
            [['keterangan'], 'string', 'max' => 500],
            [['gender', 'dibuat_oleh', 'diubah_oleh'], 'string', 'max' => 16],
            [['sku'], 'unique'],
            [['id_kriteria'], 'exist', 'skipOnError' => true, 'targetClass' => Kriteria::className(), 'targetAttribute' => ['id_kriteria' => 'id_kriteria']],
            [['dibuat_oleh'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['dibuat_oleh' => 'username']],
            [['diubah_oleh'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['diubah_oleh' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sku' => 'Sku',
            'id_kriteria' => 'Kriteria',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'warna' => 'Warna',
            'gender' => 'Gender',
            'harga' => 'Harga',
            'dibuat_oleh' => 'Dibuat Oleh',
            'diubah_oleh' => 'Diubah Oleh',
            'aktif' => 'Aktif',
            'leadtime' => 'Leadtime (Hari)',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKriteria()
    {
        return $this->hasOne(Kriteria::className(), ['id_kriteria' => 'id_kriteria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDibuatOleh()
    {
        return $this->hasOne(Admin::className(), ['username' => 'dibuat_oleh']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiubahOleh()
    {
        return $this->hasOne(Admin::className(), ['username' => 'diubah_oleh']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembelians()
    {
        return $this->hasMany(DetailPembelian::className(), ['sku_barang' => 'sku']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSafetyStocks()
    {
        return $this->hasMany(SafetyStock::className(), ['sku_barang' => 'sku']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['sku_barang' => 'sku']);
    }
}
