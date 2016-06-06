<?php
    include "module/webnews.php";
    $getNews=new webnews();
    $result=$getNews->loadNews("","",1,20);
    $result2=$getNews->mysql();
?>

<style>
    .right{height:80px;width:1000px;margin:15px 280px 10px;padding:5px;border:solid 5px white;border-radius:10px;}
</style>

        <?php foreach ($result2 as $news2):?>
        <div class="right">
            <dl >
                <dt>
                    <?php echo $news2[text]; ?>
                </dt>
                <br>
            </dl>
        </div>
        <?php endforeach?>

