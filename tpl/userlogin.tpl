<script>
    $(document).ready(function () {
        $("#cmdLogin").css("display","inline-block");

        $("#cmdLogin").click(function ()
        {
            if (isBlank("txtUserName",'red'))
            {
                alert("用户名不能为空");
                return false; //组织提交表单
            }
            if (isBlank("txtUserPwd",'blue'))
            {
                alert("密码不能为空");
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
            <th class="righttd">用户登录</th>
        </tr>

        <tr>
            <td class="lefttd">用户名：</td>
            <td class="righttd"><input type="input" name="userName" id="txtUserName" class="text"></td>
        </tr>

        <tr>
            <td class="lefttd">密码：</td>
            <td class="righttd"><input type="password" name="userPwd" id="txtUserPwd" class="text"></td>
        </tr>

        <tr>
            <td></td>
            <td class="righttd">
                <input type="submit" value="提交 " name="cmdLogin" id="cmdLogin" style="display: none">
            </td>
        </tr>
    </table>
</form>