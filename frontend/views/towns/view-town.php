<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 12.11.2017
     * Time: 14:46
     */
    
    /**
     * @var $town   \common\models\Towns
     * @var $places \common\models\Places[]
     */
    
    use yii\helpers\Html;
    use yii\helpers\Url;
    
    frontend\assets\LeafletTownAsset::register($this);
?>
<script>
	var ajax = new XMLHttpRequest()
    ajax.responseType = 'json'
	ajax.open('GET', '/places/getgeo?town_id=<?=$town->id?>', true)
	ajax.send()
	ajax.onload = function (e) {
		var places = ajax.response
	}
</script>
<h1><?=$town->name?></h1>
<div>
    <?=$town->descr?>
</div>
<input type="hidden" name="lngInput" id="lngInput" value="<?=$town->lng?>">
<input type="hidden" name="latInput" id="latInput" value="<?=$town->lat?>">
<h2>Места</h2>
<ul>
    <? foreach ($town->places as $place): ?>
        <li><?=Html::a($place->name, Url::toRoute(['/places/view', 'slug' => $place->slug]))?>
        <small><?=$place->cats[0]->name?></small></li>
    <? endforeach; ?>
</ul>
<div class="row">
    <div class="col-md-9">
        <style>
            #map {
                height: 280px;
            }
        </style>
        <div id="map"></div>
    </div>
    <div class="col-md-3"></div>
</div>