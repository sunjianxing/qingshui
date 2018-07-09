<?php
use yii\helpers\Url;
?>
<script language="JavaScript" src="/assets/jquery.js"></script>
<script>
    function linkage() {
        var department = document.getElementById('department').value;
        if (department == 1){
            $('#level').empty();
            $('#level').append("<option value='1'>公司领导</option>")
        }else {
            $('#level').empty();
            $('#level').append("<option value='2'>部门主管</option><option value='3'>普通员工</option>")
        }
    }
</script>
<script>
    function check(){
        if(document.form.start_time.value==""){
            alert("请假开始时间不能为空");
            document.form.start_time.focus();
            return false;
        }else if(document.form.end_time.value==""){
            alert("请假结束时间不能为空");
            document.form.end_time.focus();
            return false;
        }else if(document.form.leave_duration.value==""){
            alert("请假时长不能为空");
            document.form.leave_duration.focus();
            return false;
        }else if(document.form.reason.value==""){
            alert("请假原因不能为空");
            document.form.reason.focus();
            return false;
        }
    }
</script>
<body style="background-color: #CECDCD">
<span style="font-size: 20px;color: white;padding-left: 20%;"><a href="index">主页</a>:</span>

<div style="width: 60%;padding-top: 30px;padding-left: 30%;text-align: center;">
    <form name="form" action="<? echo Url::toRoute('menu/insert-user') ?>" method="post" onsubmit="return check()">
        <table style="margin:0 auto auto 60px;width: auto;">
            <tr>
                <th align="center">真实姓名:</th>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <th align="center">登录密码:</th>
                <td>
                    <input type="text" name="pwd">
                </td>
            </tr>
            <tr>
                <th align="center">部门:</th>
                <td>
                    <select name="department" id="department" onchange="linkage()">
                        <option value="1">管理层</option>
                        <option value="2">人力资源部</option>
                        <option value="3">技术部</option>
                        <option value="4">产品部</option>
                        <option value="5">设计部</option>
                        <option value="6">运营部</option>
                        <option value="7">市场部</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th align="center">级别:</th>
                <td>
                    <select name="level" id="level">
                        <option value="1">公司领导</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="提交" style="cursor: pointer;">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>