<?php

namespace app\controllers;

use yii;
use app\models\NossfOsmOrderQueue;
use yii\db\Expression;
use yii\data\ActiveDataProvider;

class NossfOsmController extends \yii\web\Controller {

    public function actionIndex() {
        $request = Yii::$app->request;
        $timeParam = 'DATE_SUB(NOW(), INTERVAL 3 HOUR)';
//        $dataLabel = NossfOsmOrderQueue::find()
//                ->select(['waktu'])
//                ->distinct()
//                ->where(['>', 'waktu', new Expression($timeParam)])
//                ->all();
        $data = NossfOsmOrderQueue::find()
                ->select(['MAX(queued)', 'waktu'])
                ->where(['>', 'waktu', new Expression($timeParam)])
                ->groupBy(['waktu'])
                ->asArray()
                ->all();
        foreach ($data as $i) {
            $labelData[] = $i['waktu'];
        }

        foreach ($data as $i) {
            $dataQueue[] = $i['MAX(queued)'];
        }
        return $this->render('index', [
                    'data' => $labelData,
                    'dataOwn' => $dataQueue,
        ]);
    }

    public function actionAjaxchart() {
        $request = Yii::$app->request;
        $start = "'" . $request->post("start") . "'";
        $end = "'" . $request->post("end") . "'";

        if (($start != "") && ($end != "")) {
            $modelData = NossfOsmOrderQueue::find()
                    ->select(['MAX(queued)', 'waktu'])
                    ->where(['>=', 'waktu', new Expression($start)])
                    ->andWhere(['<=', 'waktu', new Expression($end)])
                    ->groupBy(['waktu'])
                    ->asArray()
                    ->all();
            $labelData = [];
            $dataQueue = [];
            foreach ($modelData as $i) {
                $labelData[] = $i['waktu'];
                $dataQueue[] = $i['MAX(queued)'];
            }

            $data['waktu'] = $labelData;
            $data['queue'] = $dataQueue;

            return json_encode($data);
        }
        return "error";
    }

    public function actionOrderqueue() {
        if (Yii::$app->request->post("date_range")) {
            $jam = explode(" ", Yii::$app->request->post("date_range"));
            $jamH = $jam[1];
            $jamHH = explode(":", $jamH);
            $jamReal = $jamHH[0];
            $jamMenit = $jamHH[1];

            $dataProvider = new ActiveDataProvider([
                'query' => NossfOsmOrderQueue::find()
//                        ->where(['in', 'waktu', NossaStatusIntegrasi::find()->select('waktu')])
//                        ->where(['=', 'waktu', Yii::$app->request->post("date_range")])
                        ->where(["HOUR(waktu)" => $jamReal])
                        ->andWhere(["DATE(waktu)" => $jam[0]])
                        ->andWhere(["MINUTE(waktu)" => $jamMenit])
                    ,
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => NossfOsmOrderQueue::find()
//                    ->where(['in', 'waktu', NossaStatusIntegrasi::find()->select('waktu')])
                        ->where(['=', 'waktu', NossfOsmOrderQueue::find()->select('waktu')->orderBy(['waktu' => SORT_DESC])->limit(1)])
                    ,
            ]);
        }
        return $this->render('orderQueue', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}
