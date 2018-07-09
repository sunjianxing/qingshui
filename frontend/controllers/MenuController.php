<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 16-11-23
 * Time: 上午9:30
 */
namespace frontend\controllers;
use frontend\models\AdminUser;
use frontend\models\leaveRecord;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
class MenuController extends Controller{
    //判断是否登录
    public function beforeAction($action)
    {
        $session = Yii::$app->session;
        $userInfo=$session->get('userInfo');
        if (!isset($userInfo)){
            echo "<script>alert('您还没有登录，请登录');window.location='/index/login';</script>";
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
    //请假记录列表
    public function actionIndex(){
        $leave_model = new leaveRecord();
        $session = Yii::$app->session;
        $userInfo=$session->get('userInfo');
        if ($userInfo['department'] == 1 || $userInfo['department'] == 2){
            $data = $leave_model->selectAll();
        }elseif ($userInfo['department'] == 3 && $userInfo['level'] == 2){
            $data = $leave_model->departmentSelect($userInfo['department']);
        }elseif ($userInfo['department'] == 4 && $userInfo['level'] == 2){
            $data = $leave_model->departmentSelect($userInfo['department']);
        }elseif ($userInfo['department'] == 5 && $userInfo['level'] == 2){
            $data = $leave_model->departmentSelect($userInfo['department']);
        }elseif ($userInfo['department'] == 6 && $userInfo['level'] == 2){
            $data = $leave_model->departmentSelect($userInfo['department']);
        }elseif ($userInfo['department'] == 7 && $userInfo['level'] == 2){
            $data = $leave_model->departmentSelect($userInfo['department']);
        }else{
            $data = $leave_model->UserIdSelect($userInfo['id']);
        }
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => '20']);
        $model = $data->offset($pages->offset)->limit($pages->limit)->All();
        return $this->render('index',['model'=>$model,'pages'=>$pages,'userInfo'=>$userInfo]);
    }
    //添写请假条
    public function actionAdd(){
        return $this->render('add');
    }
    public function actionInsert(){
        $leave_record = Yii::$app->request->post();
        $session = Yii::$app->session;
        $userInfo=$session->get('userInfo');
        $leave_record['user_id'] = $userInfo['id'];
        $leave_record['start_time'] = strtotime($leave_record['start_time']);
        $leave_record['end_time'] = strtotime($leave_record['end_time']);
        $leave_record['add_time'] = time()+8*60*60;
        $model = new leaveRecord();
        $re = $model->insertLeaveRecord($leave_record);
        if ($re){
            echo "<script>alert('填写请假条成功');window.location='/menu/index';</script>";
        }else{
            echo "<script>alert('填写请假条失败,请重新添加');window.location='/menu/add';</script>";
        }
    }
    //添加员工
    public function actionAddUser(){
        return $this->render('addUser');
    }
    public function actionInsertUser(){
        $user = Yii::$app->request->post();
        $user['pwd'] = md5($user['pwd']);
        $model = new AdminUser();
        $re = $model->insertUser($user);
        if ($re){
            echo "<script>alert('填加员工成功');window.location='/menu/index';</script>";
        }else{
            echo "<script>alert('填加员工失败');window.location='/menu/add-user';</script>";
        }
    }
    //审核
    public function actionCheck(){
        $id = Yii::$app->request->get('id');
        $act = Yii::$app->request->get('act');
        $auth = Yii::$app->request->get('auth');
        $model = new leaveRecord();
        if ($act == "company"){
            $check['company_leader_auth'] = $auth;
            $re = $model->Check($check, $id);
            if ($re){
                echo "<script>alert('审核完成');window.location='/menu/index';</script>";
            }else{
                echo "<script>alert('审核失败');window.location='/menu/index';</script>";
            }
        }elseif ($act == "department"){
            $check['department_leader_auth'] = $auth;
            $re = $model->Check($check, $id);
            if ($re){
                echo "<script>alert('审核完成');window.location='/menu/index';</script>";
            }else{
                echo "<script>alert('审核失败');window.location='/menu/index';</script>";
            }
        }
    }
    //查看请假条详细记录
    public function actionSelect(){
        $id = Yii::$app->request->get('id');
        $model = new leaveRecord();
        $user_leave_record = $model->IdSelect($id);
        return $this->render('select',['user_leave_record'=>$user_leave_record]);
    }
    //删除请假条
    public function actionDelete(){
        $id = Yii::$app->request->get('id');
        $is_delete = 1;
        $model = new leaveRecord();
        $re = $model->deleteLeaveRecord($is_delete,$id);
        if ($re){
            echo "<script>alert('删除成功');window.location='/menu/index';</script>";
        }else{
            echo "<script>alert('删除失败');window.location='/menu/index';</script>";
        }
    }
    //准备导出的数组，名称，头信息
    Public function actionExportData(){
        $time = Yii::$app->request->post();
        $front_time = strtotime($time['front_time']);
        $back_time = strtotime($time['back_time']);
        $model = new leaveRecord();
        $res = $model->TimeAreaSelect($front_time,$back_time);
        $data = array();
        foreach ($res as $k1=>$v1){
            $data[$k1]['id'] = $v1['id'];
            $data[$k1]['username'] = $v1['username'];
            if ($v1['department'] == 1){
                $department = "管理层";
            }elseif($v1['department'] == 2){
                $department = "人力资源部";
            }elseif($v1['department'] == 3){
                $department = "技术部";
            }elseif($v1['department'] == 4){
                $department = "产品部";
            }elseif($v1['department'] == 5){
                $department = "设计部";
            }elseif($v1['department'] == 6){
                $department = "运营部";
            }elseif($v1['department'] == 7){
                $department = "市场部";
            }
            $data[$k1]['department'] = $department;
            if ($v1['level'] == 1){
                $level = "公司领导";
            }elseif($v1['level'] == 2){
                $level = "部门主管";
            }elseif($v1['level'] == 3){
                $level = "普通员工";
            }
            $data[$k1]['level'] = $level;
            if ($v1['type'] == 1){
                $type = "事假";
            }elseif($v1['type'] == 2){
                $type = "病假";
            }elseif($v1['type'] == 3){
                $type = "婚假";
            }elseif($v1['type'] == 4){
                $type = "丧假";
            }elseif($v1['type'] == 5){
                $type = "产假";
            }elseif($v1['type'] == 6){
                $type = "其他";
            }
            $data[$k1]['type'] = $type;
            $data[$k1]['start_time'] = date('Y-m-d H:i',$v1['start_time']);
            $data[$k1]['end_time'] = date('Y-m-d H:i',$v1['end_time']);
            $data[$k1]['leave_duration'] = $v1['leave_duration'];
            if ($v1['department_leader_auth'] == 0){
                $department_leader_auth = "未审批";
            }elseif($v1['department_leader_auth'] == 1){
                $department_leader_auth = "已审批";
            }elseif($v1['department_leader_auth'] == 2){
                $department_leader_auth = "审批未通过";
            }
            $data[$k1]['department_leader_auth'] = $department_leader_auth;
            if ($v1['company_leader_auth'] == 0){
                $company_leader_auth = "未审批";
            }elseif($v1['company_leader_auth'] == 1){
                $company_leader_auth = "已审批";
            }elseif($v1['company_leader_auth'] == 2){
                $company_leader_auth = "审批未通过";
            }
            $data[$k1]['company_leader_auth'] = $company_leader_auth;
            $data[$k1]['reason'] = $v1['reason'];
            $data[$k1]['add_time'] = date('Y-m-d H:i:s',$v1['add_time']);

            if ($v1['is_delete'] == 0){
                $is_delete = '有效';
            }elseif($v1['is_delete'] == 1){
                $is_delete = '无效';
            }
            $data[$k1]['is_delete'] = $is_delete;
        }
        $headArr=array();
        foreach ($data as $k2=>$v2){
            if($k2 == 'id'){
                $headArr[]='编号';
            }
            if($k2 == 'username'){
                $headArr[]='真实姓名';
            }
            if($k2 == 'department'){
                $headArr[]='部门';
            }
            if($k2 == 'level'){
                $headArr[]='级别';
            }
            if($k2 == 'type'){
                $headArr[]='请假类型';
            }
            if($k2 == 'start_time'){
                $headArr[]='请假开始时间';
            }
            if($k2 == 'end_time'){
                $headArr[]='请假结束时间';
            }
            if($k2 == 'leave_duration'){
                $headArr[]='请假时长';
            }
            if($k2 == 'department_leader_auth'){
                $headArr[]='部门主管审批';
            }
            if($k2 == 'company_leader_auth'){
                $headArr[]='公司领导审批';
            }
            if($k2 == 'reason'){
                $headArr[]='请假原因';
            }
            if($k2 == 'add_time'){
                $headArr[]='请假条填写时间';
            }
            if($k2 == 'is_delete'){
                $headArr[]='请假条是否有效';
            }
        }
        $filename="请假条记录";
        //调用导出到Excel的函数
        $this->getExcel($filename,$headArr,$data);
    }
    //导出进Excel
    public function GetExcel($fileName,$headArr,$data){
        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";
        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
        //设置表头
        $key = ord("A");
        $key2 = ord("@");
        foreach($headArr as $v){
            if($key>ord("Z")){
                $key2 += 1;
                $key = ord("A");
                $colum = chr($key2).chr($key);//超过26个字母时才会启用
            }else{
                if($key2>=ord("A")){
                    $colum = chr($key2).chr($key);
                }else{
                    $colum = chr($key);
                }
            }
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }
        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            $span2 = ord("@");
            foreach($rows as $keyName=>$value){// 列写入
                if($span>ord("Z")){
                    $span2 += 1;
                    $span = ord("A");
                    $j = chr($span2).chr($span);//超过26个字母时才会启用
                }else{
                    if($span2>=ord("A")){
                        $j = chr($span2).chr($span);
                    }else{
                        $j = chr($span);
                    }
                }
                //$j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }
        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
}