<script>
  $(document).ready(function () { //页面加载完毕后执行方法
    $("#cmdReg").click(function () {   //点击注册后执行
      if (isBlank("userName","red"))
      {
          return false;
      }
      if (isBlank("userEmail","red"))
      {
        return false;
      }
      if (isBlank("userPwd","red"))
      {
        return false;
      }
      if (isBlank("userPwd2","red"))
      {
        return false;
      }
      if (!isEqual("userPwd","userPwd2"))
      {
        alert("两次密码输入不一致，请重新输入");
        return false;
      }
      if(isCheck("cbRead"))
      {
        alert("请先阅读条款");
        return false;
      }
  })
  })

</script>


<form method="post">
  <style>
    .regtable{width:700px;background:#fff;border-radius:5px;padding-top:30px;padding-bottom:100px;margin:30px auto 30px auto;}
    .regtable .lefttd{text-align: right;width:25%;color:gray;}
    .regtable .righttd{text-align: left;width:75%;}
    .regtable td{padding:6px;}
    .regtable td a{color:green;}
    .regtable th{font-size: 25px;color:#9c9c9c}
    .regtable .text{width:58%;border:solid 1px #ddd;height:34px;line-height:34px;background:#f5f5f5;border-radius:5px;}

    #cmdLogin{width:200px;height:40px;text-align:center;color:#fff;border:0;background:#e96481;border-radius:5px;}
  </style>
<table class="mytable regtable">
  <tr>
    <th></th>
    <th class="righttd">用户名注册</th>
  </tr>

  <tr>
    <td class="lefttd">用户名：</td>
    <td class="righttd"><input type="input" name="userName" id="userName" class="text"></td>
  </tr>

  <tr>
    <td class="lefttd">邮箱：</td>
    <td class="righttd"><input type="input" name="userEmail" id="userEmail" class="text"></td>
  </tr>

  <tr>
    <td class="lefttd">密码：</td>
    <td class="righttd"><input type="password" name="userPwd" id="userPwd" class="text"></td>
  </tr>

  <tr>
    <td class="lefttd">确认密码：</td>
    <td class="righttd"><input type="password" name="userPwd2" id="userPwd2"  class="text"></td>
  </tr>

  <tr>
    <td></td>
    <td class="righttd">
      <input type="checkbox" name="cbRead"><a href="http://www.cityshop.com.cn/aboutus/terms" target="_blank">请先阅读用户条款</a></td>
    </td>
  </tr>

  <tr>
    <td></td>
    <td class="righttd">
      <input type="submit" value="提交 " name="cmdReg" id="cmdReg">
    </td>
  </tr>
</table>
</form>