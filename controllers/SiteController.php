<?php

namespace app\controllers;

use app\models\PasienSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;
use app\models\PemesananForm;

use app\models\base\Admin;
use app\models\Pasien;
use app\models\Dokter;
use app\models\TransaksiPemesanan;
use app\models\TransaksiPenjualan;
use app\models\Barang;
use app\models\Kategori;


use yii\db\Expression;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }

        $pasien = count(Pasien::find()->all());
        $dokter = count(Dokter::find()->all());
        $kategori = count(Kategori::find()->all());
        $transaksiPemesanan = count(TransaksiPemesanan::find()->all());
        $transaksiPenjualan = count(TransaksiPenjualan::find()->all());
        $barang = count(Barang::find()->all());

        return $this->render('index', [
            'pasien' => $pasien,
            'dokter' => $dokter,
            'kategori' => $kategori,
            'transaksiPemesanan' => $transaksiPemesanan,
            'transaksiPenjualan' => $transaksiPenjualan,
            'barang' => $barang,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'layout-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            //log last login column
            $user = Yii::$app->user->identity;
            $user->last_login = new Expression("NOW()");
            $user->authKey = 'sdfds';
            $user->save();

            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $this->layout = 'layout-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->addFlash("success", "Register success, please login");
            return $this->redirect(["site/login"]);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPemesanan()
    {
        $model = new PemesananForm();

        if ($model->load(Yii::$app->request->post()) && $model->simpan()) {
            return $this->redirect(["site/index"]);
        }

        return $this->render('pemesanan', [
            'model' => $model,
        ]);
    }

    public function actionPenjualan()
    {
        return $this->redirect(["transaksi-penjualan/index"]);
    }

    public function actionPetugas()
    {             
        return $this->render('petugas');
    }

    public function actionBarang()
    {
        return $this->redirect(["barang/index"]);

        // return $this->render('barang');
    }

    public function actionProfile()
    {
        $userId = Yii::$app->user->getId();
        $userProfile = Admin::find()->where(['id' => $userId])->one();
        if($userProfile->load(Yii::$app->request->post()) && $userProfile->save()){
            return $this->redirect(['profile']);
        }
        return $this->render('profile', ['model' => $userProfile]);
    }

    public function actionTesting()
    {
        return $this->render('testing');
    }
}
