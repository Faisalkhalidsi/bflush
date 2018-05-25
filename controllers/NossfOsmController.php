<?php

namespace app\controllers;

use yii;
use app\models\NossfOsmOrderQueue;
use yii\db\Expression;

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
            $labelData=[];
            $dataQueue=[];
            foreach ($modelData as $i) {
                $labelData[] = $i['waktu'];
                $dataQueue[] = $i['MAX(queued)'];
            }

            $data['waktu'] = $labelData;
            $data['queue']= $dataQueue;

            return json_encode($data);
        }
        return "error";
    }

}
