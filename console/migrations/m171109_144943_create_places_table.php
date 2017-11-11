<?php

use yii\db\Migration;

/**
 * Handles the creation of table `places`.
 */
class m171109_144943_create_places_table extends Migration
{
    use common\components\traits\TextTypesTrait;
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%places}}', [
            'id' => $this->primaryKey(),
            'cat_id'  => $this->integer()->defaultValue(null),
            'slug'         => $this->string(255)->comment('Категория'),
            'name'         => $this->string(255)->comment('Название'),
            'lng'         => $this->float(15)->comment('Долгота'),
            'lat'         => $this->float(15)->comment('Широта'),
            'title'        => $this->string(255)->comment('Title - заголовок браузера'),
            'meta_descr'   => $this->string(255)->comment('Meta description tag'),
            'short_descr'   => $this->text()->comment('Короткое описание'),
            'descr'         => $this->longText()->comment('Полное описание'),
            'image'        => $this->string(255)->comment('Главное изображение'),
            'updated_at'   => $this->integer()->defaultValue(null)->comment('Дата обновления'),
            'created_at'   => $this->integer()->defaultValue(null)->comment('Дата создания'),
            'sort'         => $this->integer()->defaultValue(null)->comment('Порядок вывода'),
            'status'       => $this->integer()->defaultValue(1)->comment('Статус'),
            'active'       => $this->integer()->defaultValue(1)->comment('Активный'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%places}}');
    }
}
