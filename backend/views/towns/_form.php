<?php
    
    use mihaildev\ckeditor\CKEditor;
    use mihaildev\elfinder\ElFinder;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    
    /* @var $this yii\web\View */
    /* @var $model common\models\Towns */
    /* @var $form yii\widgets\ActiveForm */
    
    backend\assets\LeafletAsset::register($this);
?>


<div class="towns-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'slug')->textInput(['maxlength' => true])?>
            </div>
            <div class="col-md-6">
                <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'lng')->textInput(['id' => 'lngInput', 'maxlength' => false])?>
            </div>
            <div class="col-md-6">
                <?=$form->field($model, 'lat')->textInput(['id' => 'latInput', 'maxlength' => false])?>
            </div>
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
                <?=$form->field($model, 'meta_descr')->textarea(['rows' => 3])?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?=$form->field($model, 'short_descr')->widget(CKEditor::className(), [
                        'editorOptions' => ElFinder::ckeditorOptions(
                            [
                                'elfinder',
                                'path' => Yii::getAlias('@frontend') . DIRECTORY_SEPARATOR . 'web/images/'
                            ],
                            [
                                'preset' => 'basic',
                                //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false,
                                //по умолчанию false
                            ]),
                    ])
                    ;?>
                </div>
                <div class="col-md-6">
                    <?=$form->field($model, 'descr')->widget(CKEditor::className(), [
                        'editorOptions' => ElFinder::ckeditorOptions(
                            [
                                'elfinder',
                                'path' => Yii::getAlias('@frontend') . DIRECTORY_SEPARATOR . 'web/images/'
                            ],
                            [
                                'preset' => 'standart',
                                //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                'inline' => false,
                                //по умолчанию false
                            ]),
                    ])
                    ;?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?=$form->field($model, 'link')->textInput(['maxlength' => true])?><?=$form->field($model, 'sort')->textInput()?>
                </div>
                <div class="col-md-4">
                    <?=$form->field($model, 'active')->checkbox()?>
                </div>
                <div class="col-md-4">
                    <?
                        echo $model->showThumb(200, 200);
                    ?>
                    <?=$form->field($model, 'image')->fileInput(['maxlength' => true])?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?=Html::submitButton('Save', ['class' => 'btn btn-success btn-flat'])?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
