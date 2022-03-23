<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m220323_062624_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(64),
            'desc' => $this->string(200),
            'article' => $this->text(),
            'author' => $this->string(),
            'img' => $this->string(),
            'categoryId' => $this->integer()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'fk_post_categoryId',
            'post',
            'categoryId',
            'Category',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_categoryId', '{{%post}}');
        $this->dropTable('{{%post}}');
    }
}
