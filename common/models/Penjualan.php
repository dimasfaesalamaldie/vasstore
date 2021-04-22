<?php

namespace common\models;

use common\models\Staff;
use Yii;

/**
 * This is the model class for table "penjualan".
 *
 * @property string $no_penjualan
 * @property string $tanggal_penjualan
 * @property string $nama
 * @property string $jenis_kelamin
 * @property int $umur
 * @property double $total_harga
 * @property string $keterangan
 * @property string $dibuat_oleh
 *
 * @property DetailPenjualan[] $detailPenjualans
 * @property Staff $dibuatOleh
 */
class Penjualan extends \yii\db\ActiveRecord
{
    public $details = [];
    public $detail;
    public $jarak = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penjualan';
    }
    public function kerjalist()
    {
        return [
            'Wiraswasta' => 'Wiraswasta',
            'Aparatur Sipil Negara' => 'Aparatur Sipil Negara',
            'Pegawai Swasta' => 'Pegawai Swasta',
            'Pelajar/Mahasiswa' => 'Pelajar/Mahasiswa',
            'Tidak Bekerja' => 'Tidak Bekerja',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_penjualan', 'tanggal_penjualan', 'jenis_kelamin', 'umur', 'pekerjaan', 'total_harga', 'dibuat_oleh'], 'required'],
            [['tanggal_penjualan', 'details', 'detail', 'jarak'], 'safe'],
            [['umur'], 'integer'],
            [['no_penjualan', 'nama', 'keterangan'], 'string', 'max' => 50],
            [['jenis_kelamin', 'dibuat_oleh'], 'string', 'max' => 16],
            [['no_penjualan'], 'unique'],
            [['dibuat_oleh'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['dibuat_oleh' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_penjualan' => 'No Penjualan',
            'tanggal_penjualan' => 'Tanggal Penjualan',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'umur' => 'Umur',
            'total_harga' => 'Total Harga',
            'keterangan' => 'Keterangan',
            'dibuat_oleh' => 'Dibuat Oleh',
            'sku' => 'Barang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::className(), ['no_penjualan' => 'no_penjualan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDibuatOleh()
    {
        return $this->hasOne(Staff::className(), ['username' => 'dibuat_oleh']);
    }
}
