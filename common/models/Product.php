<?php

namespace common\models;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $birlik
 * @property int $count
 * @property int $maximal
 *
 * @property Kategory $kategory
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'birlik', 'count'], 'required'],
            [['category_id', 'count', 'maximal', 'qoshildi', 'user_id'], 'integer'],
            [['name', 'birlik', 'message'], 'string', 'max' => 255],
            [['created_at', 'update_at'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Kategoriya Nomi',
            'name' => 'Mahsulot Nomi',
            'birlik' => 'Mahsulot Birligi',
            'count' => 'Mahsulot Miqdori',
            'maximal' => 'Dastlabki miqdori',
            'created_at' => 'Yaratilgan vaqti',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategory()
    {
        return $this->hasOne(Kategory::className(), ['id' => 'category_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    // if(this)
}
