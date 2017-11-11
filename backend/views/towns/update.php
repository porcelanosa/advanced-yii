<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Towns */

$this->title = 'Update Towns: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Towns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="towns-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
