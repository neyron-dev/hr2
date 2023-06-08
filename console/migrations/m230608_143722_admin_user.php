<?php

use yii\db\Migration;

/**
 * Class m230608_143722_admin_user
 */
class m230608_143722_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}',[
            'username'=>'admin',
            'auth_key'=>'u6Aj9AEGEGLQn1vDr6bx_jKFGtYxlYBI',
            'password_hash'=>'$2y$13$eC9hXm1GZqDKqdkNdSAM/uezt/K/BpUMXTUQj1WsiP9.EY.cqG4sS',
            'email'=>'admin@admin.com',
            'status'=>10
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => "admin"]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230608_143722_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
