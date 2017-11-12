<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 12.11.2017
     * Time: 13:40
     */
    
    /**
     * @var $towns \common\models\Towns[]
     * @var $cats \common\models\Cats[]
     */
    
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<h1>Города</h1>
<ul>
    <? foreach ($towns as $town): ?>
        <li><?=Html::a($town->name, Url::to(['/towns/view', 'slug'=>$town->slug]))?></li>
    <? endforeach; ?>
</ul>
<h1>Категории</h1>
<ul>
    <? foreach ($cats as $cat): ?>
        <li><?=Html::a($cat->name, Url::toRoute(['/cats/view', 'slug'=>$cat->slug]))?></li>
    <? endforeach; ?>
</ul>