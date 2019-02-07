<?php

namespace app\controllers;

use Yii;
use app\models\Voucher;
use app\models\VoucherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VoucherController implements the CRUD actions for Voucher model.
 */
class VoucherController extends Controller
{
    public function Init()
    {
        $this->layout = 'admin';

        if(Yii::$app->user->isGuest)
            return $this->redirect('/site/login');
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Voucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $ttt = time();
        $voucher = Yii::$app->db->createCommand('SELECT * FROM `voucher` WHERE `time` >= :t')
            ->bindParam(':t', $ttt)->queryAll();

        $searchModel = new VoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'v' => $voucher
        ]);
    }

    /**
     * Displays a single Voucher model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        for($i=0;$i<10;$i++) {
            $model = new Voucher();

            $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890";

            $max = 6;
            $size = StrLen($chars) - 1;
            $password = null;
            while ($max--)
                $password .= $chars[rand(0, $size)];

            $post['Voucher']['password'] = $password;
            $post['Voucher']['time'] = mktime(23, 59, 59, date('m', time()), date('d', time()), date('Y', time()));

            if ($model->load($post) && $model->save()) {

            }
        }


        return $this->redirect('/vouch');
    }

    /**
     * Updates an existing Voucher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost)
        {
            $post['Voucher']['password'] = $_POST['Voucher']['password'];
            $post['Voucher']['time'] = mktime(23,59,59, date('m',time()), date('d',time()), date('Y',time()));

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Voucher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Voucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Voucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Voucher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
