<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property int $count
 * @property string $created_at
 * @property string $update_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'name', 'count', 'created_at'], 'required'],
            [['product_id', 'count', 'Qoldi'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'Xabar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'count' => 'Count',
            'created_at' => 'Created At',
        ];
    }
}