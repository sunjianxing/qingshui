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
class AdminUser extends Model{
    //验证登录用户
    public function GetUserInfo($username,$password){
        $password=md5($password);
        $query = new Query();
        $adminUser=$query
                ->select('*')
                ->from('user')
                ->where(['and','username='."'".$username."'",'pwd='."'".$password."'"])
                ->one();
        return $adminUser;
    }
    //添加员工
    public function insertUser($user){
        $re=Yii::$app->db->createCommand()->insert('user',$user)->execute();
        return $re;
    }
}
