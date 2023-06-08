<?if(empty($topAuthors)):?>
    В заданный год не было выпущено книг
<?else:?>
    <ul>
        <?foreach($topAuthors as $author):?>
            <li><?=$author["full_name"];?> - <?=$author["count"];?> книг</li>
        <?endforeach;?>
    </ul>
<?endif;?>