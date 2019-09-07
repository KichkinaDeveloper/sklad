<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kategory".
 *
 * @property int $id
 * @property string $name
 *
 * @property Birlik[] $birliks
 */
class Kategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBirliks()
    {
        return $this->hasMany(Birlik::className(), ['cat_id' => 'id']);
    }
}
