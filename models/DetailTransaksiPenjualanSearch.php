<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailTransaksiPenjualan;

/**
 * DetailTransaksiPenjualanSearch represents the model behind the search form about `app\models\DetailTransaksiPenjualan`.
 */
class DetailTransaksiPenjualanSearch extends DetailTransaksiPenjualan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_penjualan', 'id_barang', 'jumlah', 'harga'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DetailTransaksiPenjualan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_penjualan' => $this->id_penjualan,
            'id_barang' => $this->id_barang,
            'jumlah' => $this->jumlah,
            'harga' => $this->harga,
        ]);

        return $dataProvider;
    }
}
