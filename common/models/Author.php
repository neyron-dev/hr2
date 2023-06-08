<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $full_name
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['full_name'], 'string', 'max' => 255],
            [['full_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::class, ['author_id' => 'id']);
    }

    public static function getAllforDropdown()
    {
        $result = [];

        $models = self::find()->all();
        foreach($models as $author)
        {
            $result[$author->id] = $author->full_name;
        }

        return $result;
    }

    public static function getTopByYear($year, $limit)
    {
        $result =  \Yii::$app->db->createCommand('SELECT `a`.`id`,`a`.`full_name`,COUNT(`a`.`id`) as `count` FROM author `a` LEFT JOIN `author_to_book` as `ab` ON `ab`.`author_id` = `a`.`id` LEFT JOIN `book` as `b` ON `b`.`id`=`ab`.`book_id` WHERE `b`.`release_year` = '.$year.' GROUP BY `a`.`id` ORDER BY `count` DESC LIMIT '.$limit.';')
        ->queryAll();

        return $result;
    }
}
