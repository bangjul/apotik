<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property integer $id
 * @property string $kode
 * @property string $nama
 * @property integer $stok
 * @property integer $id_kategori
 * @property integer $harga_satuan
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'nama', 'stok', 'id_kategori', 'harga_satuan'], 'required'],
            [['stok', 'id_kategori', 'harga_satuan'], 'integer'],
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'stok' => 'Stok',
            'id_kategori' => 'Id Kategori',
            'harga_satuan' => 'Harga Satuan',
        ];
    }

    public function getKategori(){
        return $this->hasOne(\app\models\Kategori::className(), ['id' => 'id_kategori']);
    }

    public function getKodeNama(){
        return $this->kode.'-'.$this->nama;
    }
}
