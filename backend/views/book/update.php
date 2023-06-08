<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = 'Update Book: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-update">

 

    <?= $this->render('_form', [
        'model' => $model,
        'authorsList' => $authorsList
    ]) ?>

</div>
