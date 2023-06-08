<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $release_year
 * @property string $description
 * @property string|null $isbn_code
 * @property string $image_path

 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    //Поле под загрузку изображений
    public $imageFile;

    public $author_ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        
        return [
            [['title', 'release_year', 'description', 'isbn_code','author_ids'], 'required'],
            ['author_ids', 'each', 'rule' => ['exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_ids' => 'id']], 'skipOnEmpty' => false],
            [['release_year'], 'integer', 'min'=>1300,'max'=>date("Y")],
            [['description'], 'string'],
            [['title', 'image_path'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['isbn_code'], 'match', 'pattern'=>'/^\d{10}(\d{3})?$/', 'message'=>'The ISBN code must consist of 10 or 13 digits'],
            [['isbn_code'], 'unique'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on'=>'create'],

            
        ];
    }

    
    //Загрузка изображения на сервер
    public function upload()
    {
        if ($this->validate()) {
            if(empty($this->imageFile))
                return true;

            $savePath = 'uploads/' . time() . '.' . $this->imageFile->extension;
            if($this->imageFile->saveAs("@frontend/web/".$savePath,false))
            {
                $this->image_path = $savePath;
                return true;
            }
        } 
        
        return false;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'release_year' => 'Release Year',
            'description' => 'Description',
            'isbn_code' => 'Isbn Code',
            'image_path' => 'Image Path',
            'author_ids' => 'Authors'
        ];
    }
    
    public function afterSave($insert, $changedAttributes) {
        
        //Сохраняем отношение авторов к книге в соответстующую таблицу. 
        //В случае неудачи, удаляем все значения и саму книгу.

        
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if(!$insert)
            {
               \Yii::$app->db->createCommand()->delete('author_to_book',  ["book_id" => $this->id])->execute();
        
            }
            foreach($this->author_ids as $author_id)
            {
                $authorToBookModel = new AuthorToBook();
                $authorToBookModel->author_id = $author_id;
                $authorToBookModel->book_id = $this->id;

                if(!$authorToBookModel->save())
                {
                    throw new \Exception("Author to book is not saved");
                }
            }

            $transaction->commit();

        } catch (\Exception $e) {
            $transaction->rollBack();

            if($insert)
                $this->delete();
        }
        
        parent::afterSave($insert, $changedAttributes);
       
    }

    public function getAuthorToBook()
    {
        return $this->hasMany(AuthorToBook::class, ['book_id' => 'id']);
    }
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->via('authorToBook');
    }

    public function loadAuthorIds()
    {
        foreach($this->authors as $author)
        {
            $this->author_ids[] = $author->id;
        }
    }

    public static function GetAllYears()
    {
        $yearItems = [];
        $result = self::find()->select('release_year')->groupBy('release_year')->orderBy('release_year DESC')->all();
        foreach($result as $item)
        {
           $yearItems[] = $item->release_year;
        }

        return $yearItems;
    }
}
