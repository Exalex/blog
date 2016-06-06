<?php
interface news //新闻类接口（包含内部新闻、投稿新闻、第三方新闻）接口负责统一管理方法
{
    function loadNews($classids,$keyword,$page,$pagesize);//加载新闻列表
    function loadNewsDetail($newsid);//加载新闻详情

    function clickNews($newsid);//新闻点击量计算

    function reviewNews($newsid,$reviewData);//新闻评论
}

interface users
{

}