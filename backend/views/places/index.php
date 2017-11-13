<?php
    
    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\widgets\Pjax;
    
    /* @var $this yii\web\View */
    /* @var $searchModel common\models\search\PlacesSearch */
    /* @var $dataProvider yii\data\ActiveDataProvider */
    
    $this->title                   = 'Places';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?=Html::a('Create Places', ['create'], ['class' => 'btn btn-success btn-flat'])?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                [
                    'attribute'     => 'town_id',
                    'label'         => 'Город',
                    'content'       => function ($data) {
                        /**
                         * @var $data \common\models\Places
                         */
                        if (isset($data->town->name)) {
                            return $data->town->name;
                        } else {
                            return 'Город не задан';
                        }
                    },
                    'headerOptions' => ['style' => 'width:200px']
                ],
                //'slug',
    
                [
                    'attribute'     => 'name',
                    'label'=>'Название',
                    'content' => function ($data) {
                        /**
                         * @var $data \common\models\Places
                         */
                            return $data->name.'<br><b>LNG: </b>'.$data->lng.' <b>LAT:</b>'.$data->lat;
                    },
                    ],
                /*'lng',
                'lat',*/
                /*[
                      'attribute' => 'coords',
                      'label' => 'Координаты',
                      'content'=> function ($data) {
                        /**
                         * @var $data \common\models\Places
                         */
                        /*return $data->lng.'<br>'.$data->lat;
                        },
                ]*/
                // 'title',
                // 'meta_descr',
                // 'short_descr:ntext',
                // 'descr:ntext',
                // 'image',
                // 'updated_at',
                // 'created_at',
                // 'sort',
                // 'status',
                // 'active',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
