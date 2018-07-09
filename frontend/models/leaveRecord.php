<?php
/**
 * Created by PhpStorm.
 * User: sun
 * Date: 16-11-17
 * Time: 下午4:49
 */
namespace frontend\models;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\db\Query;
use Yii;
class leaveRecord extends ActiveRecord{
    //查询请假条记录联查user表
    public function selectAll(){
        $query = new Query();
        $leave_record=$query
            ->select(['leave_record.*','username','department','level'])
            ->from('leave_record')
            ->leftJoin('user','user.id=leave_record.user_id')
            ->orderBy('add_time desc');
        return $leave_record;
    }
    //按leave_record表id联查user表
    public function IdSelect($id){
        $user_leave = (new Query())
            ->select(['leave_record.*','username','department','level'])
            ->from('leave_record')
            ->leftJoin('user','user.id = leave_record.user_id')
            ->where('leave_record.id ='.$id)
            ->one();
        return $user_leave;
    }
    //按部门联查leave_record表
    public function departmentSelect($department){
        $query = new Query();
        $leave_record=$query
            ->select(['leave_record.*','username','department','level'])
            ->from('leave_record')
            ->leftJoin('user','user.id=leave_record.user_id')
            ->where('user.department ='.$department)
            ->orderBy('add_time desc');
        return $leave_record;
    }
    //按user表id联查leave_record表
    public function UserIdSelect($user_id){
        $query = new Query();
        $leave_record=$query
            ->select(['leave_record.*','username','department','level'])
            ->from('leave_record')
            ->leftJoin('user','user.id=leave_record.user_id')
            ->where('user.id ='.$user_id)
            ->orderBy('add_time desc');
        return $leave_record;
    }
    //添加请假条
    public function insertLeaveRecord($leave_record){
        $re=Yii::$app->db->createCommand()->insert('leave_record',$leave_record)->execute();
        return $re;
    }
    //审核
    public function Check($check,$id){
        $re=Yii::$app->db->createCommand()->update('leave_record',$check,'id='.$id)->execute();
        return $re;
    }
    //查询一个时间段的请假条
    public function TimeAreaSelect($front_time,$back_time){
        $query = new Query();
        $leave_record=$query
            ->select(['leave_record.*','username','department','level'])
            ->from('leave_record')
            ->leftJoin('user','user.id=leave_record.user_id')
            ->where(['and','is_delete=0',['between','start_time',$front_time,$back_time]])
            ->orderBy('start_time asc')
            ->all();
        return $leave_record;
    }
    //逻辑删除请假条
    public function deleteLeaveRecord($is_delete,$id){
        $re=Yii::$app->db->createCommand()->update('leave_record',['is_delete'=>$is_delete],'id='.$id)->execute();
        return $re;
    }
}
