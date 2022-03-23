<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220322_063418_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'tags' => $this->text(),
            'updated_at' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
