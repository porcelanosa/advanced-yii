<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 12.11.2017
     * Time: 14:46
     */
    
    /**
     * @var $cat   \common\models\Cats
     * @var $places \common\models\Places[]
     */
    
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<h1><?=$cat->name?></h1>
<div>
    <?=$cat->descr?>
</div>
<?if(isset($cat->places)):?>
<ul>
    <? foreach ($cat->places as $place): ?>
        <li><?=$place->town->name?><br><?=Html::a($place->name, Url::toRoute(['/places/view', 'slug' => $place->slug]))?>
        <small><?=$place->cats[0]->name?></small></li>
    <? endforeach; ?>
</ul>
<?endif?>
<!--<div class="row">
    <div class="col-md-9">
        <style>
            #map {
                height: 280px;
            }
        </style>
        <div id="map"></div>
    </div>
    <div class="col-md-3"></div>
</div>-->