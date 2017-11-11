<?php
    
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use common\models\Towns;
    use common\models\Cats;
    
    /* @var $this yii\web\View */
    /* @var $model common\models\Places */
    /* @var $form yii\widgets\ActiveForm */
    
    backend\assets\LeafletAsset::register($this);
?>

<div class="places-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive ">
        <div class="row">
            <div class="col-md-12">
                <?use kartik\widgets\Select2;
                $data = [
                "red" => "red",
                "green" => "green",
                "blue" => "blue",
                "orange" => "orange",
                "white" => "white",
                "black" => "black",
                "purple" => "purple",
                "cyan" => "cyan",
                "teal" => "teal"
                ];

                // Tagging support Multiple
                $model->cat_id =  ['red', 'green']; // initial value
                echo $form->field($model, 'cat_ids')->widget(Select2::classname(), [
                    'attribute' => 'cat_ids',
                    'data' => ArrayHelper::map(Cats::find()->all(), 'id', 'name'),
                    'options' => [
                        'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                    ],
                ])->label('Категории');?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?=$form->field($model, 'town_id')->dropDownList(ArrayHelper::map(Towns::find()->all(), 'id', 'name'), ['prompt' => 'Город'])?>
            </div>
            <div class="col-md-3">
                <?=$form->field($model, 'slug')->textInput(['maxlength' => true])?></div>
            <div class="col-md-3">
                <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'lng')->textInput(['id' => 'lngInput', 'maxlength' => false])?></div>
            <div class="col-md-6">
                <?=$form->field($model, 'lat')->textInput(['id' => 'latInput', 'maxlength' => false])?></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <style>
                    #map {
                        height: 280px;
                    }
                </style>
                <div id="map"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
            </div>
            <div class="col-md-6">
                <?=$form->field($model, 'meta_descr')->textInput(['maxlength' => true])?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'short_descr')->textarea(['rows' => 6])?></div>

            <div class="col-md-6">
                <?=$form->field($model, 'descr')->textarea(['rows' => 6])?></div>
        </div>
        <?=$form->field($model, 'image')->textInput(['maxlength' => true])?>
        
        <? /*=$form->field($model, 'updated_at')->textInput()*/ ?><!--
            
            --><? /*=$form->field($model, 'created_at')->textInput()*/ ?>

        <div class="row">
            <div class="col-md-4">
                <?=$form->field($model, 'sort')->textInput()?></div>
        
        <?/*=$form->field($model, 'status')->checkbox()*/?>

            <div class="col-md-4">
        <?=$form->field($model, 'active')->checkbox()?>
            </div>
        </div>
    </div>
</div>
<div class="box-footer">
    <?=Html::submitButton('Save', ['class' => 'btn btn-success btn-flat'])?>
</div>
<?php ActiveForm::end(); ?>
</div>