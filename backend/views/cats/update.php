<?php
    
    /* @var $this yii\web\View */
/* @var $model common\models\Cats */

$this->title = 'Update Cats: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cats-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
