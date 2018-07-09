<?php
use yii\helpers\Url;
use frontend\components\GoLinkPager;
?>
<style>
    .page ul{list-style:none;margin-bottom:10px;}
    .page li{list-style:none;float:left; width:60px; margin:0 auto; line-height:30px;background:#fff;border:1px solid #80b4e6;margin-right:5px;color:#0099df;text-align:center;}
    .page a:link   { text-decoration:none;color:#0099df; }
    .page a:visited{text-decoration:none;color:#0099df;}
    .page a:hover  {color:#fff; font-weight:bold; text-decoration:none;background:#0099df;}
    .page a:active{color:#fff; font-weight:bold; text-decoration:none;background:#0099df;}
    .page a  {display:block; text-align:center; height:30px;width:60px;}

    .click{
        display: block;
        float: right;
    }
    .click a{
        text-decoration: none;
        color: #880000;
    }
    .click a:hover{
        text-decoration: underline;
        color: #ff0000;
    }
</style>
<script language="JavaScript" src="/assets/jquery.js"></script>
<script language="JavaScript" src="/assets/laydate.dev.js"></script>
<script>
    function check(){
        if(document.form.front_time.value==""){
            alert("请假开始时间不能为空");
            document.form.front_time.focus();
            return false;
        }else if(document.form.back_time.value==""){
            alert("请假结束时间不能为空");
            document.form.back_time.focus();
            return false;
        }
    }
</script>
<body style="background-color: #CECDCD">
<div>
    <span style="font-size: 20px;color: white;">请假记录表:</span><span class="click">[<?php echo $userInfo['username']?>]<a href="/index/logout"> 注销登录</a></span>
</div>
<div style="padding-top: 20px;">
    <?php if (($userInfo['department'] == 1) || ($userInfo['department'] == 2)){?>
        <div>
            <form name="form" action="<? echo Url::toRoute('menu/export-data') ?>" method="post" onsubmit="return check()">
                导出时间:<input type="text" name="front_time" id="front_time">-><input type="text" name="back_time" id="back_time">
                <button type="submit" style="cursor: pointer">导出请假条</button>
            </form>
        </div>
        <button type="button" onclick="javascript:window.location='add-user'" style="cursor: pointer">添加员工</button>
        <button type="button" onclick="javascript:window.location='add'" style="cursor: pointer">请假条</button>
    <?php }else{?>
        <button type="button" onclick="javascript:window.location='add'" style="cursor: pointer">请假条</button>
    <?php }?>

</div>
<div style="width: 100%;padding-top: 10px;">
    <table border="1"  style="margin:0 auto;width: 100%;">
        <tr >
            <th width="50" style="text-align: center">编号</th>
            <th width="80" style="text-align: center">用户名</th>
            <th width="80" style="text-align: center">请假类型</th>
            <th width="100" style="text-align: center">请假时长</th>
            <th width="100" style="text-align: center">开始时间</th>
            <th width="80" style="text-align: center">部门</th>
            <th width="80" style="text-align: center">级别</th>
            <th width="80" style="text-align: center">添加时间</th>
            <th width="80" style="text-align: center">主管审核</th>
            <th width="80" style="text-align: center">领导审核</th>
            <th width="80" style="text-align: center">是否有效</th>
            <th width="150" style="text-align: center">查看&审核</th>
            <?php if ($userInfo['department'] == 2){?>
                <th width="50" style="text-align: center">删</th>
            <?php }?>
        </tr>
        <?php foreach ($model as $v){?>
            <tr>
                <td align="center"><?php echo $v['id']?></td>
                <td align="center"><?php echo $v['username']?></td>
                <td align="center">
                    <?php if ($v['type'] == 1){
                        echo "事假";
                    }elseif($v['type'] == 2){
                        echo "病假";
                    }elseif($v['type'] == 3){
                        echo "婚假";
                    }elseif($v['type'] == 4){
                        echo "丧假";
                    }elseif($v['type'] == 5){
                        echo "产假";
                    }elseif($v['type'] == 6){
                        echo "其他";
                    }?>
                </td>
                <td align="center"><?php echo $v['leave_duration']?></td>
                <td align="center"><?php echo $start_time = date("Y-m-d H:i", $v['start_time']);?></td>
                <td align="center">
                    <?php if ($v['department'] == 1){
                        echo "管理层";
                    }elseif($v['department'] == 2){
                        echo "人力资源部";
                    }elseif($v['department'] == 3){
                        echo "技术部";
                    }elseif($v['department'] == 4){
                        echo "产品部";
                    }elseif($v['department'] == 5){
                        echo "设计部";
                    }elseif($v['department'] == 6){
                        echo "运营部";
                    }elseif($v['department'] == 7){
                        echo "市场部";
                    }?>
                </td>
                <td align="center">
                    <?php if ($v['level'] == 1){
                        echo "公司领导";
                    }elseif($v['level'] == 2){
                        echo "部门主管";
                    }elseif($v['level'] == 3){
                        echo "普通员工";
                    }?>
                </td>
                <td align="center">
                    <?php $add_time = date('Y-m-d H:i:s', $v['add_time']);
                        echo $add_time;
                    ?>
                </td>
                <td align="center">
                    <?php if ($v['department_leader_auth'] == 0){
                        echo "未审批";
                    }elseif($v['department_leader_auth'] == 1){
                        echo "已审批";
                    }elseif($v['department_leader_auth'] == 2){
                        echo "审批未通过";
                    } ?>
                </td>
                <td align="center">
                    <?php if ($v['company_leader_auth'] == 0){
                        echo "未审批";
                    }elseif($v['company_leader_auth'] == 1){
                        echo "已审批";
                    }elseif($v['company_leader_auth'] == 2){
                        echo "审批未通过";
                    } ?>
                </td>
                <td align="center">
                    <?php if ($v['is_delete'] == 0){
                        echo "有效";
                    }elseif($v['is_delete'] == 1){
                        echo "无效";
                    }?>
                </td>
                <td align="center">
                    <?php if ($userInfo['department'] == 1 && $userInfo['level'] == 1 && $v['company_leader_auth'] == 0){?>
                        <button onClick="javascript:window.location='select?id=<?php echo $v['id']?>'" style="cursor: pointer">查</button>
                        <button onClick="javascript:window.location='check?id=<?php echo $v['id']?>&act=company&auth=1'" style="cursor: pointer">通过</button>
                        <button onClick="javascript:window.location='check?id=<?php echo $v['id']?>&act=company&auth=2'" style="cursor: pointer">驳回</button>
                    <?php }elseif((($userInfo['department'] == 2) || ($userInfo['department'] == 3) || ($userInfo['department'] == 4) || ($userInfo['department'] == 5) || ($userInfo['department'] == 6) || ($userInfo['department'] == 7)) && ($userInfo['level'] == 2) && ($v['department'] == $userInfo['department']) && ($v['department_leader_auth'] == 0)){?>
                        <button onClick="javascript:window.location='select?id=<?php echo $v['id']?>'" style="cursor: pointer">查</button>
                        <button onClick="javascript:window.location='check?id=<?php echo $v['id']?>&act=department&auth=1'" style="cursor: pointer">通过</button>
                        <button onClick="javascript:window.location='check?id=<?php echo $v['id']?>&act=department&auth=2'" style="cursor: pointer">驳回</button>
                    <?php }else{?>
                        <button onClick="javascript:window.location='select?id=<?php echo $v['id']?>'" style="cursor: pointer">查看</button>
                    <?php }?>
                </td>
                <?php if ($userInfo['department'] == 2 && $v['is_delete'] == 0){?>
                    <td align="center">
                        <button onClick="javascript:window.location='delete?id=<?php echo $v['id']?>'" style="cursor: pointer">删</button>
                    </td>
                <?php }elseif($userInfo['department'] == 2 && $v['is_delete'] == 1){?>
                    <td align="center">
                        <span style="color: red;">X</span>
                    </td>
                <?php }?>
            </tr>
        <?php }?>
    </table>
    <div>
        <span style="display: block;margin:0 auto"><?= GoLinkPager::widget(['pagination' => $pages,'go'=>true,'nextPageLabel'=> '下一页','prevPageLabel' => '上一页', 'firstPageLabel' => '首页', 'lastPageLabel' => '尾页','options' => ['class' => 'page']]); ?></span>
    </div>
</div>
</body>
<script >
    laydate({
        elem: '#front_time',
        format: 'YYYY-MM-DD hh:mm',
        istime:true
    });
    laydate({
        elem: '#back_time',
        format: 'YYYY-MM-DD hh:mm',
        istime:true
    });
</script>