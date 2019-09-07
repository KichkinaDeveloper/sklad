<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m190423_103107_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'birlik' => $this->string()->notNull(),
            'count' => $this->integer()->notNull(),
            'maximal' => $this->integer()->defaultValue(null),
            'created_at' => $this->date()->notNull(),
            'qoshildi' =>$this->integer()->default(0),
            'user_id' =>$this->integer(),


        ]);

        $this->addForeignKey(
            'product_kategory',
            'product',
            'category_id',
            'kategory',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'product_user',
            'product',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
