<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 12.11.2017
     * Time: 14:46
     */
    
    /**
     * @var $place \common\models\Places
     */
    
    frontend\assets\LeafletPlaceAsset::register($this);
    
    $this->title = $place->name. ' '. $place->town->name;
?>
<h1><?=$place->name?><small><?=$place->town->name?></small></h1>
<div>
    <?=$place->descr?>
</div>
<input type="hidden" name="lngInput" id="lngInput" value="<?=$place->lng?>">
<input type="hidden" name="latInput" id="latInput" value="<?=$place->lat?>">
<input type="hidden" name="townInput" id="townInput" value="<?=$place->town->name?>">
<input type="hidden" name="nameInput" id="nameInput" value="<?=$place->name?>">
<h2>Места</h2>
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