<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Book $model */

$this->title = 'Create Book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">
  

    <?= $this->render('_form', [
        'model' => $model,
        'authorsList' => $authorsList
    ]) ?>

</div>
