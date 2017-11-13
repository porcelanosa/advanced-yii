<?php
    
    namespace frontend\controllers;
        
        use common\models\Cats;
        use yii\filters\AccessControl;
        use yii\filters\VerbFilter;
        use yii\web\Controller;
    
        /**
         * Site controller
         */
        class CatsController extends Controller
        {
            /**
             * @inheritdoc
             */
            public function behaviors()
            {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'only'  => ['logout', 'signup'],
                        'rules' => [
                            [
                                'actions' => ['signup'],
                                'allow'   => true,
                                'roles'   => ['?'],
                            ],
                            [
                                'actions' => ['logout'],
                                'allow'   => true,
                                'roles'   => ['@'],
                            ],
                        ],
                    ],
                    'verbs'  => [
                        'class'   => VerbFilter::className(),
                        'actions' => [
                            'logout' => ['post'],
                        ],
                    ],
                ];
            }
            
            /**
             * @inheritdoc
             */
            public function actions()
            {
                return [
                    'error'   => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                    'captcha' => [
                        'class'           => 'yii\captcha\CaptchaAction',
                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                    ],
                ];
            }
            
            /**
             * Displays Town
             *
             * @return mixed
             */
            public function actionView($slug)
            {
                $cat = Cats::find()->where(['slug' => $slug])->one();
                return $this->render('view-cat', [
                    'cat' => $cat
                ]);
            }
            
        }
