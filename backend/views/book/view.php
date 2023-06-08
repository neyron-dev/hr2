<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

   

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'release_year',
            'description:ntext',
            'isbn_code',
            [
                'label' => 'Authors',
                'value' => function($data) {
                    return  implode(", ",\yii\helpers\ArrayHelper::map($data->authors, 'id', 'full_name'));
                }
            ],
            [
                'label' => 'Photo',
                'value' => function($data) {
                    return  '<img src="/'.$data->image_path.'">';
                },
                'format'=>'html'
            ]
           
        ],
    ]) ?>
    

</div>
