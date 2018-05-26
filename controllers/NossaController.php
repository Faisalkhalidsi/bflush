<?php

namespace app\controllers;

use Yii;
use app\models\NossaStatusIntegrasi;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NossaController implements the CRUD actions for NossaStatusIntegrasi model.
 */
class NossaController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all NossaStatusIntegrasi models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->request->post("date_range")) {
            $jam = explode(" ", Yii::$app->request->post("date_range"));
            $jamH = $jam[1];
            $jamHH = explode(":", $jamH);
            $jamReal = $jamHH[0];
            $jamMenit = $jamHH[1];

            $dataProvider = new ActiveDataProvider([
                'query' => NossaStatusIntegrasi::find()
//                        ->where(['in', 'waktu', NossaStatusIntegrasi::find()->select('waktu')])
//                        ->where(['=', 'waktu', Yii::$app->request->post("date_range")])
                        ->where(["HOUR(waktu)" => $jamReal])
                        ->andWhere(["DATE(waktu)" =>$jam[0]])
                        ->andWhere(["MINUTE(waktu)" => $jamMenit])
                    ,
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => NossaStatusIntegrasi::find()
//                    ->where(['in', 'waktu', NossaStatusIntegrasi::find()->select('waktu')])
                        ->where(['=', 'waktu', NossaStatusIntegrasi::find()->select('waktu')->orderBy(['waktu' => SORT_DESC])->limit(1)])
                    ,
            ]);
        }
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NossaStatusIntegrasi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id) {
        if (($model = NossaStatusIntegrasi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
