<?php
use yii\helpers\Url;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>数据采集查看系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <style>
        body{
            font-size:13px;
            text-align:center;
            margin-top:0px;
            background-color:#CECDCD;
        }
        .loginDiv{
            width:450px;
            height:300px;
            border:0px solid #990100;
            margin:100px auto 0px auto;
            background-color:#CECDCD;
        }
        .loginDiv1{
            width:440px;
            height:25px;
            color:red;
            text-align:center;
            line-height:25px;
            vertical-align:middle;
            font-size:20px;
            font-weight:bold;
        }
        .loginDiv2{
            width:440px;
            padding-top:45px;
            text-align:center;
        }
        .loginDiv20{
            width:200px;
            float:left;
            height:22px;
            line-height:22px;
            vertical-align:middle;
            text-align:center;
            font-size:18px;
        }
        .loginDiv21{
            width:240px;
            float:left;
            text-align:left;
            color:red;
        }
    </style>
    <script>
        function check(){
            if(document.frm.username.value==""){
                alert("请输入用户名");
                document.frm.username.focus();
                return false;
            }else if(document.frm.password.value==""){
                alert("请输入密码");
                document.frm.password.focus();
                return false;
            }else if(document.frm.checkCode.value==""){
                alert("请输入验证码");
                document.frm.checkCode.focus();
                return false;
            }
        }
    </script>
</head>
<body >
<div class="mainDiv clear">
    <div class="loginDiv">
        <div class="loginDiv1">我是请假条</div>
        <form name="frm" action="<? echo Url::toRoute('index/index') ?>" method="post" onsubmit="return check()">
            <div class="loginDiv2 clear">
                <div class="loginDiv20">用户名:</div>
                <div class="loginDiv21"><input type="text" name="username" maxlength="50"></div>
            </div>
            <div class="loginDiv2 clear">
                <div class="loginDiv20">密码:</div>
                <div class="loginDiv21"><input type="password" name="password"></div>
            </div>
            <div class="loginDiv2 clear">
                <div class="loginDiv20">&nbsp;</div>
                <div class="loginDiv21"><input type="submit" value="登陆" style="cursor:pointer"></div>
            </div>
        </form>
    </div>

</div>
</body>
</html>