<?php

namespace app\controllers;

use yii;
use app\models\NossfOsmOrderQueue;
use yii\db\Expression;

class NossfOsmController extends \yii\web\Controller {

    public function actionIndex() {
        $request = Yii::$app->request;
        $timeParam = 'DATE_SUB(NOW(), INTERVAL 2 HOUR)';
        $dataLabel = NossfOsmOrderQueue::find()
                ->select(['waktu'])
                ->distinct()
                ->where(['>', 'waktu', new Expression($timeParam)])
                ->all();
        $data = NossfOsmOrderQueue::find()
                ->select(['MAX(queued)', 'waktu'])
                ->where(['>', 'waktu', new Expression($timeParam)])
                ->groupBy(['waktu'])
                ->asArray()
                ->all();
        foreach ($dataLabel as $i) {
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

//       public function actionIndex() {
//           
//       }
    public function actionAjaxchart() {
        return "boom2";
    }

}
