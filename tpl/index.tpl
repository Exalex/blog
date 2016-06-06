<?php
    include "module/webnews.php";
    $getNews=new webnews();
    $result=$getNews->loadNews("","",1,20);
    $result2=$getNews->mysql();
?>

<style>
    .right{float:right;height:300px;margin-top:10px;border:solid 5px white;border-radius:10px;text-align:center;}
</style>
<div class="outer">
    <!--左边新闻列表和右边相关新闻-->
    <div class="content">

        <div class="left">
            <?php foreach ($result as $news):?>
            <dl class="newsregion">
                <dt>
                    <?php echo $news[news_title] ?>
                </dt>
                <dd>
                    <?php echo $news[news_intr] ?>
                </dd>
                <dd class="author">
                    <?php echo $news[pubuser] ?>
                </dd>
            </dl>
            <?php endforeach?>
        </div>

        <div class="right">
            暂无新闻
        </div>

    </div>
</div>