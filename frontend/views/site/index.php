<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mt-4 mb-4">Books</h2>
        </div>
        <?foreach($books as $book):?>
            <div class="col-md-6 col-lg-4">
                <!-- Bootstrap 5 card box -->
                <div class="card-box">
                    <div class="card-thumbnail">
                        <img src="/<?=$book->image_path;?>" class="img-fluid" alt="">
                    </div>
                    <h3><a href="#" class="mt-2 text-danger"><?=$book->title;?></a></h3>
                    <p class="text-secondary"><?=substr($book->description,0,150);?>...</p>
                    <p class="text-secondary">Released: <?=$book->release_year;?></p>
                    <a href="#" class="btn btn-sm btn-danger float-right">Read more >></a>
                </div>
            </div>
        <?endforeach;?>
        

</div>
