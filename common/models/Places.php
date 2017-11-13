<?php
    
    namespace common\models;
        
        use yii\behaviors\TimestampBehavior;
    
        /**
         * This is the model class for table "places".
         *
         * @property int    $id
         * @property int    $cat_id
         * @property array  $cat_ids
         * @property int    $town_id
         * @property string $slug        Категория
         * @property string $name        Название
         * @property double $lng         Долгота
         * @property double $lat         Широта
         * @property string $title       Title - заголовок браузера
         * @property string $meta_descr  Meta description tag
         * @property string $short_descr Короткое описание
         * @property string $descr       Полное описание
         * @property string $image       Главное изображение
         * @property int    $updated_at  Дата обновления
         * @property int    $created_at  Дата создания
         * @property int    $sort        Порядок вывода
         * @property int    $status      Статус
         * @property int    $active      Активный
         *
         * @property Towns $town Город
         * @property Cats[] $cats Категории
         */
        class Places extends \yii\db\ActiveRecord
        {
            
            
            /**
             * @inheritdoc
             */
            public static function tableName()
            {
                return 'places';
            }
            
            /**
             * @inheritdoc
             */
            public function behaviors()
            {
                return [
                    [
                        'class'     => \voskobovich\linker\LinkerBehavior::className(),
                        'relations' => [
                            'cat_ids' => 'cats',
                        ],
                    ],
                    TimestampBehavior::className(),
                ];
            }
            
            /**
             * @inheritdoc
             */
            public function rules()
            {
                return [
                    [['cat_id', 'town_id', 'updated_at', 'created_at', 'sort', 'status', 'active'], 'integer'],
                    [['lng', 'lat'], 'number'],
                    [['cat_ids'], 'safe'],
                    [['short_descr', 'descr'], 'string'],
                    [['image'], 'safe'],
                    [['image'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'on' => ['insert', 'update']],
                    [['slug', 'name', 'title', 'meta_descr'], 'string', 'max' => 255],
                ];
            }
            
            /**
             * @return \yii\db\ActiveQuery
             */
            public function getTown()
            {
                return $this->hasOne(Towns::className(), ['id' => 'town_id']);
            }
            
            /**
             * @return \yii\db\ActiveQuery
             */
            public function getCats()
            {
                return $this->hasMany(Cats::className(), ['id' => 'cat_id'])->viaTable('places_cats', ['place_id' => 'id']);
            }
            
            /*public function afterSave($insert, $changedAttributes)
            {
                $cats = [];
                foreach ($this->cat_ids as $cat_name) {
                    $cat = Cats::getTagByName($cat_name);
                    if ($cat) {
                        $cats[] = $cat;
                    }
                }
                $this->linkAll('cats', $cats);
                parent::afterSave($insert, $changedAttributes);
            }*/
            
            /**
             * @inheritdoc
             */
            public function attributeLabels()
            {
                return [
                    'id'          => 'ID',
                    'cat_id'      => 'Cat ID',
                    'town_id'     => 'Город',
                    'slug'        => 'ЧПУ',
                    'name'        => 'Название',
                    'lng'         => 'Долгота',
                    'lat'         => 'Широта',
                    'title'       => 'Title - заголовок браузера',
                    'meta_descr'  => 'Meta description tag',
                    'short_descr' => 'Короткое описание',
                    'descr'       => 'Полное описание',
                    'image'       => 'Главное изображение',
                    'updated_at'  => 'Дата обновления',
                    'created_at'  => 'Дата создания',
                    'sort'        => 'Порядок вывода',
                    'status'      => 'Статус',
                    'active'      => 'Активный',
                ];
            }
            
            /**
             * @inheritdoc
             * @return \common\models\query\PlacesQuery the active query used by this AR class.
             */
            public static function find()
            {
                return new \common\models\query\PlacesQuery(get_called_class());
            }
            
            
        }
