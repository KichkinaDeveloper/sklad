<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m190514_155238_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'count' => $this->integer()->notNull(),
            'created_at' => $this->date()->notNull(),
            'xabar' =>$this->string(20)->notNull()->default("Sotildi"),
            'Qoldi' => $this->integer()->default(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
