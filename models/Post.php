<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $desc
 * @property string|null $article
 * @property string|null $author
 * @property string|null $img
 * @property int $categoryId
 * @property string|null $updated_at
 * @property string|null $created_at
 *
 * @property Category $category
 */
class Post extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article'], 'string'],
            [['categoryId'], 'required'],
            [['categoryId'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['desc'], 'string', 'max' => 200],
            [['author', 'img'], 'string', 'max' => 255],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'desc' => 'Desc',
            'article' => 'Article',
            'author' => 'Author',
            'img' => 'Img',
            'categoryId' => 'Category ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function fields()
    {

        return array_merge(parent::fields(), ['category' => function ($model) {
            /** @var Post $model */
            return $model->category;
        }]);
    }


    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }
}
