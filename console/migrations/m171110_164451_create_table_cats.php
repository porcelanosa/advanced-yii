<?php

use yii\db\Migration;

/**
 * Class m171110_164451_create_table_cats
 */
class m171110_164451_create_table_cats extends Migration
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
        $this->createTable('{{%cats}}', [
            'id' => $this->primaryKey(),
            'slug'         => $this->string(255)->comment('ЧПУ'),
            'name'         => $this->string(255)->comment('Название'),
            'title'        => $this->string(255)->comment('Title - заголовок браузера'),
            'meta_descr'   => $this->string(255)->comment('Meta description tag'),
            'short_descr'   => $this->text()->comment('Короткое описание'),
            'descr'         => $this->longText()->comment('Полное описание'),
            'image'        => $this->string(255)->comment('Главное изображение'),
            'sort'         => $this->integer()->defaultValue(null)->comment('Порядок вывода'),
            'active'       => $this->integer()->defaultValue(1)->comment('Активный'),
        ], $tableOptions);
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%cats}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171110_164451_create_table_cats cannot be reverted.\n";

        return false;
    }
    */
}
