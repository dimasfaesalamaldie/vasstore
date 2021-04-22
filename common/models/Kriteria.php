<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kriteria".
 *
 * @property int $id_kriteria
 * @property string $nama
 *
 * @property Barang[] $barangs
 */
class Kriteria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kriteria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kriteria' => 'Id Kriteria',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarangs()
    {
        return $this->hasMany(Barang::className(), ['id_kriteria' => 'id_kriteria']);
    }
}
