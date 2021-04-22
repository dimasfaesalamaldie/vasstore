<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Cetak extends Model
{
    public $models = [];
    public $biaya_pemesanan;
    public $biaya_penyimpanan = [];
    public $harga_beli = [];
    public $sku = [];
    public $ids = [];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['biaya_pemesanan', 'biaya_penyimpanan', 'harga_beli'], 'required'],
            [['ids'], 'safe'],
        ];
    }
}
