<?php

namespace frontend\controllers;
use common\models\Author;
use common\models\AuthorToBook;
use common\models\Book;
use InvalidArgumentException;
use yii\db\QueryBuilder;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class TopController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $years = Book::GetAllYears();
        return $this->render('index',[
            'years'=>$years
        ]);
    }

    public function actionAuthors($year)
    {
        if((int)$year != $year)
        {
            throw new NotFoundHttpException("Year must be an integer");
        }
       
        
        $topAuthors = Author::getTopByYear($year,10);
        return $this->render('authors_by_year', [
            'topAuthors' => $topAuthors
        ]);
        
    }
}
