<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "detail_transaksi_penjualan".
 *
 * @property integer $id
 * @property integer $id_penjualan
 * @property integer $id_barang
 * @property integer $jumlah
 * @property integer $harga
 */
class DetailTransaksiPenjualan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_transaksi_penjualan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_barang', 'jumlah', 'harga'], 'required'],
            [['id_penjualan', 'id_barang', 'jumlah', 'harga'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_penjualan' => 'Id Penjualan',
            'id_barang' => 'Id Barang',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
        ];
    }


    public function getPenjualan(){
        return $this->hasOne(\app\models\TransaksiPenjualan::className(), ['id' => 'id_penjualan']);
    }

    public function getBarang(){
        return $this->hasOne(\app\models\Barang::className(), ['id' => 'id_barang']);
    }
}
