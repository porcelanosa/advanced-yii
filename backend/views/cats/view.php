<?php
    
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    
    /* @var $this yii\web\View */
/* @var $model common\models\Cats */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cats-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'slug',
                'name',
                'title',
                'meta_descr',
                'short_descr:ntext',
                'descr:ntext',
                'image',
                'sort',
                'active',
            ],
        ]) ?>
    </div>
</div>
