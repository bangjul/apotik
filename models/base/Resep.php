<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "resep".
 *
 * @property integer $id
 * @property integer $id_dokter
 * @property integer $id_pasien
 * @property string $tanggal
 * @property string $keterangan
 */
class Resep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dokter', 'id_pasien', 'tanggal', 'keterangan'], 'required'],
            [['id_dokter', 'id_pasien'], 'integer'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dokter' => 'Id Dokter',
            'id_pasien' => 'Id Pasien',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
        ];
    }

    public function getDokter(){
        return $this->hasOne(\app\models\Dokter::className(), ['id' => 'id_dokter']);
    }

    public function getPasien(){
        return $this->hasOne(\app\models\Dokter::className(), ['id' => 'id_pasien']);
    }

    public function getDetailReseps()
    {
        return $this->hasMany(\app\models\DetailResep::className(), ['id_resep' => 'id']);
    }
}
