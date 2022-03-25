<?php

use app\models\Category;
use app\models\Post;
use Faker\Factory;
use yii\db\Migration;

/**
 * Class m220325_131809_fake_posts
 */
class m220325_131809_fake_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create('ru_RU');

//        for ($i = 1; $i <= 30; $i++) {
//            $model = new Category();
//            $model->title = $faker->realText(16);
//            $model->tags =  implode(', ', $faker->words(rand(1, 5), $asText = false));
//            $model->save();
//        }

        for ($i = 1; $i <= 1000; $i++) {
            $model = new Post();
            $model->title = $faker->realText(25);
            $model->article = $faker->realText;
            $model->author = $faker->name;
            $model->img = $faker->imageUrl;
            $model->categoryId = rand(1, 31);
            $model->created_at = $faker->date($format = 'Y-m-d', $max = 'now');
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220325_131809_fake_posts cannot be reverted.\n";

        return true;
    }
}
