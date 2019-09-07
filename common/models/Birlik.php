<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "birlik".
 *
 * @property int $id
 * @property string $name
 * @property int $cat_id
 *
 * @property Kategory $cat
 */
class Birlik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'birlik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomi', 'cat_id'], 'required'],
            [['cat_id'], 'integer'],
            [['nomi'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomi' => 'Nomi',
            'cat_id' => 'Kategoriya nomi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Kategory::className(), ['id' => 'cat_id']);
    }
}
