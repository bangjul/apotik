<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "detail_transaksi_pemesanan".
 *
 * @property integer $id
 * @property integer $id_pemesanan
 * @property integer $id_barang
 * @property integer $jumlah
 * @property integer $harga
 * @property integer $status
 */
class DetailTransaksiPemesanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_transaksi_pemesanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pemesanan', 'id_barang', 'jumlah', 'harga', 'status'], 'required'],
            [['id_pemesanan', 'id_barang', 'jumlah', 'harga', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pemesanan' => 'Id Pemesanan',
            'id_barang' => 'Id Barang',
            'jumlah' => 'Jumlah',
            'harga' => 'Harga',
            'status' => 'Status',
        ];
    }

    public function getPemesanan(){
        return $this->hasOne(\app\models\TransaksiPemesanan::className(), ['id' => 'id_pemesanan']);
    }

    public function getBarang(){
        return $this->hasOne(\app\models\Barang::className(), ['id' => 'id_barang']);
    }
}
