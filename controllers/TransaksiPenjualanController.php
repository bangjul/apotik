<?php

namespace app\controllers;

use app\models\base\Barang;
use Yii;
use app\models\base\TransaksiPenjualan;
use app\models\TransaksiPenjualanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use app\models\DetailTransaksiPenjualan;
use app\models\base\Model;
/**
 * TransaksiPenjualanController implements the CRUD actions for TransaksiPenjualan model.
 */
class TransaksiPenjualanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post','get']
                ],
            ],
        ];
    }

    /**
     * Lists all TransaksiPenjualan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransaksiPenjualanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TransaksiPenjualan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TransaksiPenjualan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransaksiPenjualan();
        $modelsDetails = [new DetailTransaksiPenjualan];


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelsDetails = Model::createMultiple(DetailTransaksiPenjualan::classname());
            Model::loadMultiple($modelsDetails, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsDetails) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetails as $modelDetail) {
                            $modelDetail->id_penjualan = $model->id;
                            if (! ($flag = $modelDetail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->tanggal = date('Y-m-d');
            $model->id_admin = Yii::$app->user->id;
            return $this->render('create', [
                'model' => $model,
                'modelsDetails' => (empty($modelsDetails)) ? [new DetailTransaksiPenjualan] : $modelsDetails,
                'barangs' => Barang::find()
                    ->select(['kode as value', 'nama','id', 'harga_satuan'])
                    ->asArray()->all()
            ]);
        }
    }

    /**
     * Updates an existing TransaksiPenjualan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TransaksiPenjualan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransaksiPenjualan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransaksiPenjualan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransaksiPenjualan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
