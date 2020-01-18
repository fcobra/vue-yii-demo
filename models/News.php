<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title Заголовок
 * @property int|null $author_id Автор
 * @property string|null $date Дата
 * @property string|null $text Текст
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['author_id'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'author_id' => 'Автор',
            'date' => 'Дата',
            'text' => 'Текст',
        ];
    }
}
