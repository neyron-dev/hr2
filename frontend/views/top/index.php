<?php
/** @var yii\web\View $this */
?>
<h1>Top authors for the year</h1>

<p>
    <ul>
        <?foreach($years as $year):?>
            <li> 
                <a href="/top/authors?year=<?=$year;?>"><?=$year;?></a>
            </li>
        <?endforeach;?>
    </ul>
</p>
