<?php

/* @var $this \yii\web\View */
/* @var $content string */
    
    use common\models\Cats;
    use common\models\Towns;
    use common\widgets\Alert;
    use frontend\assets\AppAsset;
    use yii\helpers\Html;
    
    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?=Html::csrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head() ?>
        
    </head>
    <body>
    <div class="wrap">
        
        <? echo $this->render('_header') ?>
        <?/* echo $this->render('_nav', ['catalogTree' => $catalogTree,]) */?>
        <div class="content-container container">
            <div class="row">
                <div class="col-md-3 d-none d-md-block left-tree">
                    <?
                        $towns = Towns::find()->where(['active'=>1])->all();
                        $cats = Cats::find()->where(['active'=>1])->all();
                    ?>
                    <?=$this->render(
                        '_left', [
                            'towns' => $towns,
                            'cats' => $cats,
                        ]
                    )?>
                </div>
                <div class="col-12 col-md-9 main-block">
                    
                    <?=Alert::widget()?>
                    
                    <?=$content?>
                </div>
            </div>
        </div>
    </div>
    
    <? echo $this->render('_footer') ?>
    
    
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>