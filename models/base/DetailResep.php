<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "detail_resep".
 *
 * @property integer $id
 * @property integer $id_resep
 * @property integer $id_barang
 * @property integer $jumlah
 */
class DetailResep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_resep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_resep', 'id_barang', 'jumlah'], 'required'],
            [['id_resep', 'id_barang', 'jumlah'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_resep' => 'Id Resep',
            'id_barang' => 'Id Barang',
            'jumlah' => 'Jumlah',
        ];
    }

    public function getResep(){
        return $this->hasOne(\app\models\Resep::className(), ['id' => 'id_resep']);
    }

    public function getBarang(){
        return $this->hasOne(\app\models\Barang::className(), ['id' => 'id_barang']);
    }
}
