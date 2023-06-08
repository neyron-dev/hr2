<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Author $model */

$this->title = 'Update Author: ' . $model->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="author-update">

  

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
