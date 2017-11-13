<?php
    
    namespace common\models;
        
        use backend\components\behaviors\UploadBehavior;
        use common\components\traits\ShowThumbTrait;
    
        /**
         * This is the model class for table "towns".
         *
         * @property int    $id
         * @property string $slug        ЧПУ
         * @property string $name        Название
         * @property double $lng         Долгота
         * @property double $lat         Широта
         * @property string $title       Title - заголовок браузера
         * @property string $meta_descr  Meta description tag
         * @property string $short_descr Короткое описание
         * @property string $descr       Полное описание
         * @property string $link        Ссылка
         * @property string $image       Главное изображение
         * @property int    $sort        Порядок вывода
         * @property int    $status      Статус
         * @property int    $active      Активный
         */
        class Towns extends \yii\db\ActiveRecord
        {
            use ShowThumbTrait;
            protected $uploadPath = '@frontend/web/images/towns';
            
            /**
             * @inheritdoc
             */
            public static function tableName()
            {
                return 'towns';
            }
            
            public function behaviors()
            {
                return [
                    'file' => [
                        'class'           => UploadBehavior::className(),
                        'attributeName'   => 'image',
                        'savePath'        => $this->uploadPath,
                        'generateNewName' => true,
                        'protectOldValue' => true,
                    ],
                ];
            }
            /**
             * @return \yii\db\ActiveQuery
             */
            public function getPlaces()
            {
                return $this->hasMany(Places::className(), ['town_id' => 'id']);
            }
            /**
             * @inheritdoc
             */
            public function rules()
            {
                return [
                    [['lng', 'lat'], 'number'],
                    [['short_descr', 'descr'], 'string'],
                    [['sort', 'status', 'active'], 'integer'],
                    [['image'], 'safe'],
                    [['image'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'on' => ['insert', 'update']],
                    [['slug', 'name', 'title', 'meta_descr', 'link'], 'string', 'max' => 255],
                ];
            }
            
            /**
             * @inheritdoc
             */
            public function attributeLabels()
            {
                return [
                    'id'          => 'ID',
                    'slug'        => 'ЧПУ',
                    'name'        => 'Название',
                    'lng'         => 'Долгота',
                    'lat'         => 'Широта',
                    'title'       => 'Title - заголовок браузера',
                    'meta_descr'  => 'Meta description tag',
                    'short_descr' => 'Короткое описание',
                    'descr'       => 'Полное описание',
                    'link'        => 'Ссылка',
                    'image'       => 'Главное изображение',
                    'sort'        => 'Порядок вывода',
                    'status'      => 'Статус',
                    'active'      => 'Активный',
                ];
            }
            
            /**
             * @inheritdoc
             * @return \common\models\query\TownsQuery the active query used by this AR class.
             */
            public static function find()
            {
                return new \common\models\query\TownsQuery(get_called_class());
            }
        }
