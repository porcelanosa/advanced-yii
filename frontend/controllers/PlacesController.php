<?php
    
    namespace frontend\controllers;
        
        use common\models\Places;
        use yii\filters\AccessControl;
        use yii\filters\VerbFilter;
        use yii\helpers\Json;
        use yii\web\BadRequestHttpException;
        use yii\web\Controller;
        use yii\web\NotFoundHttpException;
    
        /**
         * Site controller
         */
        class PlacesController extends Controller
        {
            /**
             * @param \yii\base\Action $action
             *
             * @return bool
             * @throws BadRequestHttpException
             */
            public function beforeAction($action)
            {
                if (in_array($action->id, ['getgeo'])) {
                    $this->enableCsrfValidation = false;
                    
                }
                return parent::beforeAction($action);
            }
            
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
                $place = Places::find()->where(['slug' => $slug])->one();
                return $this->render('view-place', [
                    'place' => $place
                ]);
            }
            
            /**
             * @return string
             * @throws NotFoundHttpException
             */
            public function actionGetgeo()
            { $town_id  = \Yii::$app->request->get('town_id');
                $places   = Places::find()->where(['town_id' => $town_id, 'active' => 1])->all();
                $features = [];
                foreach ($places as $place) {
                    $cat_slugs_array = [];
                    foreach ($place->cats as $cat) {
                        array_push($cat_slugs_array,$cat->slug);
                    }
                    $geometry    = ['type' => 'Point', 'coordinates' => [$place->lng, $place->lat]];
                    $properties  = [
                        'name'    => $place->name,
                        'town_id' => $town_id,
                        'townName' => $place->town->name,
                        'cats'    => $cat_slugs_array,
                        'slug'=>$place->slug
                    ];
                    $place_array = ['type' => 'Feature', 'properties' => $properties, 'geometry' => $geometry];
                    array_push($features,$place_array);
                }
                $data = ['type' => 'FeatureCollection', 'features' => $features];
                return Json::encode($data, JSON_NUMERIC_CHECK);
                /*if (Yii::$app->request->isAjax) {
                    //Yii::$app->response->format = Response::FORMAT_JSON;
                   
                    
                } else {
                    throw new NotFoundHttpException('Неправильный запрос');
                }*/
            }
            
        }
