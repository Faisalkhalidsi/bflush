<?php

namespace app\controllers;

use Yii;
use app\models\NossaStatusIntegrasi;
use app\models\NossaWorkorderTotal;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\data\ArrayDataProvider;

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
                        ->andWhere(["DATE(waktu)" => $jam[0]])
                        ->andWhere(["MINUTE(waktu)" => $jamMenit])
                    ,
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => NossaStatusIntegrasi::find()
                        ->where(['=', 'waktu', NossaStatusIntegrasi::find()->select('waktu')->orderBy(['waktu' => SORT_DESC])->limit(1)])
                    ,
            ]);
        }
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

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

    public function actionDbstatus() {
        $timeParam = 'DATE_SUB(NOW(), INTERVAL 1 HOUR)';
        $timeParam2 = 'DATE_SUB(NOW(), INTERVAL 6 HOUR)';
        // work order
        $data = NossaWorkorderTotal::find()
                ->select(['workorder_total', 'waktu'])
                ->where(['>', 'waktu', new Expression($timeParam)])
                ->asArray()
                ->all();
        foreach ($data as $i) {
            $labelData[] = $i['waktu'];
        }

        foreach ($data as $i) {
            $dataQueue[] = $i['workorder_total'];
        }

        //db session
        $dataSessionDB = \app\models\NossaSessionDbTotal::find()
                ->select(['session_total', 'waktu'])
                ->where(['>', 'waktu', new Expression($timeParam)])
                ->asArray()
                ->all();
        foreach ($dataSessionDB as $i) {
            $labelDataSessionDB[] = $i['waktu'];
        }

        foreach ($dataSessionDB as $i) {
            $dataQueueSessionDB[] = $i['session_total'];
        }

        //nossa db uptime
        $dataProvider = new ArrayDataProvider([
            'allModels' => \app\models\NossaDbStatus::find()
                    ->where(['in', 'id', \app\models\NossaDbStatus::find()->select('MAX(id)')->groupBy(['hostname'])])
                    ->all(),
        ]);

        //nossa session appl
        $dataPac = \app\models\NossaSessionAppl::find()
                ->select(['waktu'])
                ->where(['>', 'waktu', new Expression($timeParam2)])
                ->groupBy(['waktu'])
                ->asArray()
                ->all();
        foreach ($dataPac as $i) {
            $labelDataPac[] = $i['waktu'];
        }


        $dataSessionApplLabel = \app\models\NossaSessionAppl::find()
                ->groupBy(['server_name'])
                ->asArray()
                ->all();

        $allPackets = [];
        for ($i = 0; $i < sizeof($dataSessionApplLabel); $i++) {
            $packets = [];
            $packets['label'] = $dataSessionApplLabel[$i]["server_name"];
            $dataSessionApplData = \app\models\NossaSessionAppl::find()
                    ->where(['>', 'waktu', new Expression($timeParam2)])
                    ->andWhere(['server_name' => $dataSessionApplLabel[$i]["server_name"]])
                    ->asArray()
                    ->all();

            $dataData = [];
            foreach ($dataSessionApplData as $j) {
                $dataData[] = $j['session_total'];
            }
            $packets['backgroundColor'] = "rgba(0,0,255,0)";
            $packets['borderColor'] = "rgba(0,0,255,0.5)";
            $packets['pointBackgroundColor'] = "rgba(255,99,132,1)";
            $packets['pointBorderColor'] = "#fff";
            $packets['pointHoverBackgroundColor'] = "#fff";
            $packets['pointHoverBorderColor'] = "rgba(255,99,132,1)";
            $packets['data'] = $dataData;
            array_push($allPackets, $packets);
        }

        return $this->render('dbStatus', [
                    'packets' => $allPackets,
                    'data' => $labelData,
                    'dataPackets' => $labelDataPac,
                    'dataOwn' => $dataQueue,
                    'dataSessionDB' => $labelDataSessionDB,
                    'dataOwnSessionDB' => $dataQueueSessionDB,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAppl_session() {
        $timeParam2 = 'DATE_SUB(NOW(), INTERVAL 6 HOUR)';

        $data = \app\models\NossaSessionAppl::find()
                ->select(['waktu'])
                ->where(['>', 'waktu', new Expression($timeParam2)])
                ->groupBy(['waktu'])
                ->asArray()
                ->all();
        foreach ($data as $i) {
            $labelData[] = $i['waktu'];
        }

        //nossa session appl
        $dataSessionApplLabel = \app\models\NossaSessionAppl::find()
                ->groupBy(['server_name'])
                ->asArray()
                ->all();

        foreach ($dataSessionApplLabel as $i) {
            $labelDataPac[] = $i['server_name'];
        }

        $allPackets = [];
        for ($i = 0; $i < sizeof($dataSessionApplLabel); $i++) {
            $packets = [];
            $packets['label'] = $dataSessionApplLabel[$i]["server_name"];
            $dataSessionApplData = \app\models\NossaSessionAppl::find()
                    ->where(['>', 'waktu', new Expression($timeParam2)])
                    ->andWhere(['server_name' => $dataSessionApplLabel[$i]["server_name"]])
                    ->asArray()
                    ->all();

            $dataData = [];
            foreach ($dataSessionApplData as $j) {
                $dataData[] = $j['session_total'];
            }
            $packets['backgroundColor'] = "rgba(0,0,255,0)";
            $packets['borderColor'] = "rgba(0,0,255,0.5)";
            $packets['pointBackgroundColor'] = "rgba(255,99,132,1)";
            $packets['pointBorderColor'] = "#fff";
            $packets['pointHoverBackgroundColor'] = "#fff";
            $packets['pointHoverBorderColor'] = "rgba(255,99,132,1)";
            $packets['data'] = $dataData;
            array_push($allPackets, $packets);
        }

        return $this->render('appl_session', [
                    'packets' => $allPackets,
                    'data' => $labelData,
                    'label' => $labelDataPac,
        ]);
    }

    public function actionAjaxapplsess() {
        $request = Yii::$app->request;
        $start = "'" . $request->post("start") . "'";
        $end = "'" . $request->post("end") . "'";
        $data = $request->post("data");


        $dataRes = \app\models\NossaSessionAppl::find()
                ->select(['waktu'])
                ->where(['>', 'waktu', new Expression($start)])
                ->andWhere(['<', 'waktu', new Expression($end)])
                ->groupBy(['waktu'])
                ->asArray()
                ->all();
        $labelData = [];
        foreach ($dataRes as $i) {
            $labelData[] = $i['waktu'];
        }

        //nossa session appl
        $allPackets = [];
        for ($i = 0; $i < sizeof($data); $i++) {
            $packets = [];
            $packets['label'] = $data[$i];
            $dataSessionApplData = \app\models\NossaSessionAppl::find()
                    ->where(['>', 'waktu', new Expression($start)])
                    ->andWhere(['<', 'waktu', new Expression($end)])
                    ->andWhere(['server_name' => $data[$i]])
                    ->asArray()
                    ->all();

            $dataData = [];
            foreach ($dataSessionApplData as $j) {
                $dataData[] = $j['session_total'];
            }
            $packets['backgroundColor'] = "rgba(0,0,255,0)";
            $packets['borderColor'] = "rgba(0,0,255,0.5)";
            $packets['pointBackgroundColor'] = "rgba(255,99,132,1)";
            $packets['pointBorderColor'] = "#fff";
            $packets['pointHoverBackgroundColor'] = "#fff";
            $packets['pointHoverBorderColor'] = "rgba(255,99,132,1)";
            $packets['data'] = $dataData;
            array_push($allPackets, $packets);
        }

        $dataKirim['allPackets'] = $allPackets;
        $dataKirim['labelData'] = $labelData;

        return json_encode($dataKirim);
    }

}
