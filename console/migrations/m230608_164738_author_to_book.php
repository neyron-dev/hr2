<?php

use yii\db\Migration;

/**
 * Class m230608_164738_author_to_book
 */
class m230608_164738_author_to_book extends Migration
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

        $this->createTable('{{%author_to_book}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-author_to_book-author_id',
            'author_to_book',
            'author_id'
        );

        $this->addForeignKey(
            'fk-author_to_book-author_id',
            'author_to_book',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-author_to_book-book_id',
            'author_to_book',
            'book_id'
        );

        
        $this->addForeignKey(
            'fk-author_to_book-book_id',
            'author_to_book',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->dropForeignKey(
            'fk-author_to_book-author_id',
            'author_to_book'
        );

        
        $this->dropIndex(
            'idx-author_to_book-author_id',
            'author_to_book'
        );

        $this->dropForeignKey(
            'fk-author_to_book-book_id',
            'author_to_book'
        );

        $this->dropIndex(
            'idx-author_to_book-book_id',
            'author_to_book'
        );
        $this->dropTable('{{%author_to_book}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230608_164738_author_to_book cannot be reverted.\n";

        return false;
    }
    */
}
