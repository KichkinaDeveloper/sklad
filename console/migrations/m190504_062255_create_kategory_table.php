<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kategory}}`.
 */
class m190504_062255_create_kategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kategory}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kategory}}');
    }
}
