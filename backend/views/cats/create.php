<?php
    
    
    /* @var $this yii\web\View */
/* @var $model common\models\Cats */

$this->title = 'Create Cats';
$this->params['breadcrumbs'][] = ['label' => 'Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cats-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
