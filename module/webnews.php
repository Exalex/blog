<?php
//新闻处理类
include "interface.php";//引入接口

class webnews //新闻处理类的实现
{
    function loadNews($classids,$keyword,$page,$pagesize)//加载新闻列表
    {
        $news1=array(
            "news_title"=>"想实时收到某微博的推送，有什么好的方法实现么？",
            "news_intr"=>"想过两种方法，但是都不太符合需求。 最简单的就是微博买个会员，特别关注分组会实时推送。但微博推送逻辑有点奇怪，而且我只想收到某几个 id 的推送，而特别关注里有几百人，不符合要求。 另外一个就是用 python 抓取信息，把内容保存并用邮件服务发到自己的邮箱。难点是微博反爬好像比较厉害，自己技术菜比较难实现。用处也不是关注女神什么的，财经人士的某些观点，想即时知道，而且有些人会删帖这样。 大家有其他比较好的建议么。",
            "pubtime"=>"2016-5-12",
            "pubuser"=>"GhostEX"
        );
        $news2=array(
            "news_title"=>"爬虫抓取速度自适应问题",
            "news_intr"=>"之前都是抓取大型网站，现在抓取一些小型网站，出现把对方给抓死了（并发数 100 多吧），有什么办法能让抓取速度能够自适应，比如：对方是淘宝，开足马力去抓，如果对方是个小网站，能自动测出一个最合适的请求速度去抓取",
            "pubtime"=>"2016-5-12",
            "pubuser"=>"SlipStupig"
        );
        $news3=array(
            "news_title"=>"爬虫抓取速度自适应问题",
            "news_intr"=>"之前都是抓取大型网站，现在抓取一些小型网站能自动测出一个最合适的请求速度去抓取",
            "pubtime"=>"2016-5-12",
            "pubuser"=>"SlipStupig"
        );


        $newslist[]=$news1;
        $newslist[]=$news2;
        $newslist[]=$news3;

        return $newslist;

    }
    function loadNewsDetail($newsid)//加载新闻详情
    {

    }

    function clickNews($newsid)//新闻点击量计算
    {

    }

    function reviewNews($newsid,$reviewData)//新闻评论
    {

    }
    function loadSpiderNews()//加载爬虫新闻
    {

        //调用数据库
        $this->mysql();

        
    }
    function mysql()
    {
        $servername = "localhost";
        $username = "root";
        $password = "006134";
        $dbname = "spider";
        $news ='';

        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $conn->query("set names utf8");

        $sql = "SELECT id, text FROM news";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 输出每行数据
            while($row = $result->fetch_assoc()) {
                //echo $row[id].$row[text];
                $news[] = $row;
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        return $news;
    }

}
