<?php
/* @var $this yii\web\View */

use kartik\daterange\DateRangePicker;
//use yii\bootstrap\Button;
use yii\bootstrap\Html;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

//use yii\bootstrap\ActiveForm;

$this->registerJsFile("@web/js/eventDetail.js", [
    'depends' => [
        \yii\web\JqueryAsset::className()
    ]
]);
$this->title = 'Event Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Event Detail</h3>
<!--<p>*Last 2 Hours</p>-->
<hr>
<?php Pjax::begin(); ?>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <?php
        date_default_timezone_set('Asia/Jakarta');
//        $form = ActiveForm::begin(['id' => 'osmQueue-form']);
        $addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
        echo '<div class="input-group drp-container">';
        echo DateRangePicker::widget([
            'id' => 'startParam',
            'name' => 'date_range_1',
            'value' => date("Y-m-d H:i"),
            'useWithAddon' => true,
            'convertFormat' => true,
            'pluginOptions' => [
                'timePicker' => true,
                'timePickerIncrement' => 5,
                'locale' => ['format' => 'Y-m-d H:i'],
                'singleDatePicker' => true,
                'showDropdowns' => true
            ]
        ]) . $addon;
        echo '</div>';
        ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo '<div class="input-group drp-container">';
        echo DateRangePicker::widget([
            'id' => 'endParam',
            'name' => 'date_range_2',
            'value' => date("Y-m-d H:i"),
            'useWithAddon' => true,
            'convertFormat' => true,
            'pluginOptions' => [
                'timePicker' => true,
                'timePickerIncrement' => 5,
                'locale' => ['format' => 'Y-m-d H:i'],
                'singleDatePicker' => true,
                'showDropdowns' => true
            ]
        ]) . $addon;
        echo '</div>';
        ?>
    </div>
    <div class="col-sm-3">
        <?php
        echo Html::submitButton('show', ['class' => 'btn btn-primary', 'id' => 'showBtn']);
        ?>
    </div>
</div>
<hr>
<?php
Modal::begin([
    'id' => 'model',
    'size' => 'model-lg',
    'footer' => '<a href="#" class="btn btn-success" data-dismiss="modal">Close</a>',
]);

echo "<div id='modelContent'></div>";


Modal::end();
?>
<?=
$this->render('_detail', [
    'dataProvider' => $dataProvider,
])
?>

<?php Pjax::end(); ?>