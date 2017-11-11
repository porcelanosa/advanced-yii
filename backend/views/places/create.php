<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Places */

$this->title = 'Create Places';
$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
