<?php

namespace app\controllers;

use Yii;
use app\models\Event;
//use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller {

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

    public function actionIndex() {
//        $searchModel = new EventSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $events = Event::find()->all();

        $tasks = [];
        foreach ($events as $eventnya) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eventnya->id;
            $event->title = $eventnya->title;
            $event->start = $eventnya->created_date;
            $event->end = $eventnya->end_date;
            $tasks[] = $event;
        }

        return $this->render('index', [
                    'events' => $tasks,
        ]);
    }

    public function actionDetail() {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()
//                    ->select(['title','category','created_date','description','DATEDIFF(created_date,end_Date) as duration'])
                    ->orderBy(['created_date' => SORT_DESC])
                    ->limit(10)
//                    ->groupBy(['created_date'])
//                    ->where(['in', 'waktu', NossaStatusIntegrasi::find()->select('waktu')])
//                    ->where(['=', 'created_date', NossfOsmOrderQueue::find()->select('waktu')->orderBy(['waktu' => SORT_DESC])->limit(1)])
            ,
            'pagination' => false,
        ]);
        return $this->render('detail', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSummary() {
        return $this->render('summary');
    }

    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $model = new Event();
//        $model->created_date = $date;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAjaxeventdetail($startDate, $endDate) {
        $startDateNow = $startDate . ":00";
        $endDateNow = $endDate . ":00";

        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()
                    ->where("created_date BETWEEN '" . $startDateNow . "' AND '" . $endDateNow . "'")
                ,
        ]);

        return $this->renderAjax('_detail', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}
