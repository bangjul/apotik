<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "transaksi_pemesanan".
 *
 * @property integer $id
 * @property string $tanggal
 * @property integer $total
 * @property integer $id_admin
 */
class TransaksiPemesanan extends \yii\db\ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaksi_pemesanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal', 'total', 'id_admin'], 'required'],
            [['tanggal'], 'safe'],
            [['total', 'id_admin'], 'integer'],
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
            'keterangan' => 'Keterangan',
        ];
    }

    public function getAdmin(){
        return $this->hasOne(\app\models\User::className(), ['id' => 'id_admin']);
    }

    public function getDetailTransaksiPemesanans(){
        return $this->hasMany(\app\models\DetailTransaksiPemesanan::className(), ['id_pemesanan' => 'id']);
    }


}
