<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TownsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Towns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="towns-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a('Create Towns', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'slug',
                'name',
                'lng',
                'lat',
                // 'title',
                // 'meta_descr',
                // 'short_descr:ntext',
                // 'descr:ntext',
                // 'link',
                // 'image',
                // 'sort',
                // 'status',
                // 'active',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
