<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property integer $id
 * @property integer $nama
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
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
        ];
    }

    public function getBarangs()
    {
        return $this->hasMany(\app\models\Barang::className(), ['id_kategori' => 'id']);
    }

}
