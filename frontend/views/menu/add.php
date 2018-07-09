<?php
use yii\helpers\Url;
?>
<script language="JavaScript" src="/assets/jquery.js"></script>
<script language="JavaScript" src="/assets/laydate.dev.js"></script>
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
    <form name="form" action="<? echo Url::toRoute('menu/insert') ?>" method="post" onsubmit="return check()">
        <table style="margin:0 auto auto 60px;width: auto;">
            <tr>
                <th align="center">请假类型:</th>
                <td>
                    <select name="type">
                        <option value="1">事假</option>
                        <option value="2">病假</option>
                        <option value="3">婚假</option>
                        <option value="4">丧假</option>
                        <option value="5">产假</option>
                        <option value="6">其他</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th align="center">请假开始时间:</th>
                <td>
                    <input type="text" name="start_time" id="start_time">
                </td>
            </tr>
            <tr>
                <th align="center">请假结束时间:</th>
                <td>
                    <input type="text" name="end_time" id="end_time">
                </td>
            </tr>
            <tr>
                <th align="center">请假时长:</th>
                <td>
                    <input type="text" name="leave_duration">
                </td>
            </tr>
            <tr>
                <th align="center">请假原因:</th>
                <td>
                    <textarea name="reason" cols="20" rows="5"></textarea>
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
<script>
    laydate({
        elem: '#start_time',
        format: 'YYYY-MM-DD hh:mm',
        istime:true
    });
    laydate({
        elem: '#end_time',
        format: 'YYYY-MM-DD hh:mm',
        istime:true
    });
</script>
</body>