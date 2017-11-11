<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Places */

$this->title = 'Update Places: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="places-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
