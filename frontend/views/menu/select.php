<body style="background-color: #CECDCD">
<span style="font-size: 20px;color: white;padding-left: 20%;"><a href="index">主页</a>:</span>
<div style="width: 60%;padding-top: 30px;padding-left: 30%;text-align: center;">
    <table style="margin:0 auto auto 60px;width: auto;">
        <tr>
            <th align="center">真实姓名:</th>
            <td><?php echo $user_leave_record['username'];?></td>
        </tr>
        <tr>
            <th align="center">部门:</th>
            <td>
                <?php if ($user_leave_record['department'] == 1){
                    echo "管理层";
                }elseif($user_leave_record['department'] == 2){
                    echo "人力资源部";
                }elseif($user_leave_record['department'] == 3){
                    echo "技术部";
                }elseif($user_leave_record['department'] == 4){
                    echo "产品部";
                }elseif($user_leave_record['department'] == 5){
                    echo "设计部";
                }elseif($user_leave_record['department'] == 6){
                    echo "运营部";
                }elseif($user_leave_record['department'] == 7){
                    echo "市场部";
                }?>
            </td>
        </tr>
        <tr>
            <th align="center">级别:</th>
            <td><?php if ($user_leave_record['level'] == 1){
                    echo "公司领导";
                }elseif($user_leave_record['level'] == 2){
                    echo "部门主管";
                }elseif($user_leave_record['level'] == 3){
                    echo "普通员工";
                }?>
            </td>
        </tr>
        <tr>
            <th align="center">请假类别:</th>
            <td><?php if ($user_leave_record['type'] == 1){
                    echo "事假";
                }elseif($user_leave_record['type'] == 2){
                    echo "病假";
                }elseif($user_leave_record['type'] == 3){
                    echo "婚假";
                }elseif($user_leave_record['type'] == 4){
                    echo "丧假";
                }elseif($user_leave_record['type'] == 5){
                    echo "产假";
                }elseif($user_leave_record['type'] == 6){
                    echo "其他";
                } ?>
            </td>
        </tr>
        <tr>
            <th align="center">请假开始时间:</th>
            <td><?php echo $start_time = date("Y-m-d H:i", $user_leave_record['start_time']);?></td>
        </tr>
        <tr>
            <th align="center">请假结束时间:</th>
            <td><?php echo $end_time = date("Y-m-d H:i", $user_leave_record['end_time']);?></td>
        </tr>
        <tr>
            <th align="center">请假时长:</th>
            <td><?php echo $user_leave_record['leave_duration'];?></td>
        </tr>
        <tr>
            <th align="center">请假原因:</th>
            <td><textarea cols="20" rows="5"><?php echo $user_leave_record['reason']?></textarea></td>
        </tr>
        <tr>
            <th align="center">部门主管审核:</th>
            <td>
                <?php if ($user_leave_record['department_leader_auth'] == 0){
                    echo "未审批";
                }elseif($user_leave_record['department_leader_auth'] == 1){
                    echo "已审批";
                }elseif($user_leave_record['department_leader_auth'] == 2){
                    echo "审批未通过";
                }?>
            </td>
        </tr>
        <tr>
            <th align="center">公司领导审核:</th>
            <td>
                <?php if ($user_leave_record['company_leader_auth'] == 0){
                    echo "未审批";
                }elseif($user_leave_record['company_leader_auth'] == 1){
                    echo "已审批";
                }elseif($user_leave_record['company_leader_auth'] == 2){
                    echo "审批未通过";
                }?>
            </td>
        </tr>
        <tr>
            <th align="center">记录添加时间:</th>
            <td><?php echo $add_time = date('Y-m-d H:i:s', $user_leave_record['add_time']);?></td>
        </tr>
        <tr>
            <th align="center">记录是否有效:</th>
            <td>
                <?php if ($user_leave_record['is_delete'] == 0){
                    echo "有效";
                }elseif($user_leave_record['is_delete'] == 1){
                    echo "无效";
                }?>
            </td>
        </tr>
    </table>
</div>
</body>