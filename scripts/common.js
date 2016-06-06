
function hasFunc(funcName)  //是否存在指定函数
{

      try {
        if (typeof(eval(funcName)) == "function") {
            return true;
        }
    } catch(e) {}
    return false;

}
function hasVar(vname) { //是否存在指定名称的变量
 
        if (typeof(vname) == "undefined")  
        { 
            return false;
        } else {
            return true;
        }

}
function trim(str) //去除空格
{
    return str.replace(/(^\s+)|(\s+$)/g, "");
}
function removeCookie(name) 
{ 
    var exp = new Date(); 
    exp.setTime(exp.getTime() - 1); 
    var cval=getCookie(name); 
    if(cval!=null) 
        document.cookie= name + "="+cval+";expires="+exp.toUTCString(); 
} 
function setCookie(n,v,Days)
{

    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000); 
    document.cookie = n + "="+ escape (v) + ";expires=" + exp.toUTCString()+';path=/'; 
}
function getCookie(cname)
{
var arrstr = document.cookie.split(";"); //把cookie用 分号分割成数组
    if(arrstr.length==0) return null; //如没有cookie则直接返回 null
    for(var i = 0;i < arrstr.length;i ++)
    {
     var temp = arrstr[i].split("=");
  
     if(trim(temp[0])==cname)  //这里要注意，必须trim 否则有空格
     {
        return unescape(temp[1]);
     }
    }
   return null;
}

 $(document).ready(function(){
    //网页初始化工作
    if($(".readyShow").length>0) //隐藏按钮处理
    {
         var getClass=$(".readyShow").attr("class");
         getClass=getClass.replace("readyShow","");
         $(".readyShow").attr("class",getClass);
    }
   // removeCookie("tbwidth");
     // alert(document.cookie)
    //适应表单宽度
    if(screen.width>1024 &&  $(".regtable").length>0)
    {
        var getTbWidth=getCookie("tbwidth");
        if(getTbWidth!=null)
        {
            $(".regtable").css("width",getTbWidth+"px"); 
        }
        else
        {
            //第一次刷新页面
            setCookie("tbwidth","800",2);
            $(".regtable").animate({width:"800px"},900); 
        }
    }
    
    $(".submitbtn").click(function(){
         
        var getFrm=$(this).parents("form");
        var canPost=true;
        if(getFrm.length==1)
        {
            $(getFrm).find(".mustValue").each(function(){
                
                if(trim($(this).val())=="")
                {
                    canPost=false;
                    $(this).addClass("blankred");
                }
            })
            
            if(canPost)
            {
                if(hasFunc("prePost"))
                {
                 
                    var prePostResult=true;
                    eval("prePostResult=prePost();");
                    if(prePostResult)
                    {
                         $(getFrm).submit();
                    }
                    
                }
                else
                   $(getFrm).submit();//手动提交form的方法
            }
            
        }
    })
    
    $(".mustValue").change(function(){
          $(this).removeClass("blankred");
    })
    
 })
 
 var __canpost=true; //是否可以提交 true 代表可以
 function canPost()
 {
    if(__canpost)
    {
        __canpost=false;
        window.setTimeout("__canpost=true",2000)
        return true;
    }
    return false;
 }
 function execServer(type,params,func)
 {
   
    $.post("/server/userSvr.php?type="+type,params,func);
 }
  function execNews(type,params,func,isclick)
 {
   
    if(isclick && !canPost())
    {
       
        return;
    } 
    $.post("/server/newsSvr.php?type="+type,params,func);
 }
 function isCheck(objid)  //是否勾选用户条例
 {
 
    if($("#"+objid).prop("checked"))
     return true;
     return false;
 }
 function isEqual(objid1,objid2)
 {
    if($("#"+objid1).val()==$("#"+objid2).val())
        return true;
    return false;
 }
 function blankBlur(objid)
 {
    //失去焦点时 ，红色框提醒
    $("#"+objid).blur(function(){
         isBlank(objid,"red");
    })
 }
function isBlank(objid,border) //判断是否为空
{
    if($("#"+objid).val().replace(/^\s*$/g,'')=="")
    {
       
        if(border!="")
        {
            $("#"+objid).css("border","solid 1px "+border);
        }
        return true;
    }
    return false;

}
function hasChinese(id) //是否包含中文
{
    var pattern=/.*[\u4e00-\u9fa5]+.*$/;
    if(pattern.test($("#"+id).val())) 
     return true;
     return false;
}
function IsEmail(id,border)//文本框的值 是否是Email格式
{
    var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
      if(myreg.test($("#"+id).val())) 
      return true;
        if(border!="")
        {
            $("#"+id).css("border","solid 1px "+border);
        }
      return false;
}