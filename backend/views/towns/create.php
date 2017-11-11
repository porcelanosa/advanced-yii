<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Towns */

$this->title = 'Create Towns';
$this->params['breadcrumbs'][] = ['label' => 'Towns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="towns-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
