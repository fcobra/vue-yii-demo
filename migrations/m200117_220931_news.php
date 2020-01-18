<?php

use yii\db\Migration;

/**
 * Class m200117_220931_news
 */
class m200117_220931_news extends Migration
{
    protected $tableName = '___tableName___';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('news',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(512)->notNull()->comment('Заголовок'),
                'author_id' => $this->integer()->comment('Автор'),
                'date' => $this->dateTime()->comment('Дата'),
                'text' => $this->text()->comment('Текст'),
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('news');
    }
}
