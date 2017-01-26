<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property integer $id
 * @property string $nama
 * @property string $tanggal_daftar
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'tanggal_daftar'], 'required'],
            [['tanggal_daftar'], 'safe'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tanggal_daftar' => 'Tanggal Daftar',
        ];
    }
}
