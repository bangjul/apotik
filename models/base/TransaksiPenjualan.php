<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "transaksi_penjualan".
 *
 * @property integer $id
 * @property string $tanggal
 * @property integer $total
 * @property integer $id_admin
 * @property integer $id_resep
 */
class TransaksiPenjualan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaksi_penjualan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal', 'total', 'id_admin'], 'required'],
            [['tanggal'], 'safe'],
            [['total', 'id_admin', 'id_resep'], 'integer'],
            [['keterangan'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'total' => 'Total',
            'id_admin' => 'Id Admin',
            'id_resep' => 'Id Resep',
            'keterangan' => 'Keterangan',
        ];
    }

    public function getAdmin(){
        return $this->hasOne(\app\models\User::className(), ['id' => 'id_admin']);
    }

    public function getResep(){
        return $this->hasOne(\app\models\Resep::className(), ['id' => 'id_resep']);
    }

    public function getDetailTransaksiPenjualans(){
        return $this->hasMany(\app\models\DetailTransaksiPenjualan::className(), ['id_penjualan' => 'id']);
    }

}
