<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cats".
 *
 * @property int $id
 * @property string $slug ЧПУ
 * @property string $name Название
 * @property string $title Title - заголовок браузера
 * @property string $meta_descr Meta description tag
 * @property string $short_descr Короткое описание
 * @property string $descr Полное описание
 * @property string $image Главное изображение
 * @property int $sort Порядок вывода
 * @property int $active Активный
 */
class Cats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_descr', 'descr'], 'string'],
            [['sort', 'active'], 'integer'],
            [['slug', 'name', 'title', 'meta_descr', 'image'], 'string', 'max' => 255],
        ];
    }
    
    public static function getTagByName($name)
    {
        $cat = Cats::find()->where(['name' => $name])->one();
        if (!$cat) {
            $cat = new Cats();
            $cat->name = $name;
            $cat->save(false);
        }
        return $cat;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'ЧПУ',
            'name' => 'Название',
            'title' => 'Title - заголовок браузера',
            'meta_descr' => 'Meta description tag',
            'short_descr' => 'Короткое описание',
            'descr' => 'Полное описание',
            'image' => 'Главное изображение',
            'sort' => 'Порядок вывода',
            'active' => 'Активный',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\CatsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CatsQuery(get_called_class());
    }
}