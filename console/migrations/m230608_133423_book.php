<?php

use yii\db\Migration;

/**
 * Class m230608_133423_book
 */
class m230608_133423_book extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->unique(),
            'release_year' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            //предполагается, что по этому полю не будет сортировки, инче бы использовал bigint
            'isbn_code' => $this->string(13)->unique(), 
            'image_path' => $this->string(255)->notNull(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230608_133423_book cannot be reverted.\n";

        return false;
    }
    */
}
