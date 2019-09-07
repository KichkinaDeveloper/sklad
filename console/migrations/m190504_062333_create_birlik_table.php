<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%birlik}}`.
 */
class m190504_062333_create_birlik_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%birlik}}', [
            'id' => $this->primaryKey(),
            'nomi' => $this->string()->notNull(),
            'cat_id' => $this->integer()->notNull() 
        ]);

        $this->addForeignKey(
            'kategory_birlik',
            'birlik',
            'cat_id',
            'kategory',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%birlik}}');
    }
}
