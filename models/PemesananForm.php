<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

use app\models\TransaksiPemesanan;


class PemesananForm extends Model{
    public $tanggal;
    public $total;
    public $id_admin;

    public function rules()
    {
        return [
            [['tanggal','total', 'id_admin'], 'required']
        ];
    }

    public function simpan() {
        $model = new TransaksiPemesanan();
        $model->tanggal = new Expression("NOW()");
        $model->total = $this->total;
        $model->id_admin = $this->id_admin;
        if ($model->save()) {

            return true;
        } else {
            if ($model->errors) {
                $this->addErrors($model->errors);
            }
            return false;
        }
        return false;
    }
}
