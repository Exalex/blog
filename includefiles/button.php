<?php
    include "/module/page.php";
?>
<style>
.bottom{width: 100%;margin: 0 auto;background: #474747;height:80px; padding-top: 20px;color: white}
.bottom a{color: #ffffff;text-decoration: none;}
.bottom a:hover{text-decoration: underline;}

</style>

<div class="bottom">
    <P>友情链接:

    <?php
        $get_links=get_frindLinks();//调用获取友情链接的方法，获得一个数组
    if(empty($get_links)){
        exit();
    }
    ?>

    <?php foreach ($get_links as $link):  /*方便的循环取值方法*/?>
        <a href="http://<?php echo $link[furl]?>" target="<?php echo $link[target]?>"><?php echo $link[fname]?></a>
    <?php endforeach;?>

    </P>
    <P>Copyright 2012-2013 粤ICP备188888号</P>
</div>

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>