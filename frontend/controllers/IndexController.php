<?php
namespace frontend\controllers;

use frontend\models\AdminUser;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class IndexController extends Controller
{
    public function actionIndex(){
        $username=Yii::$app->request->post('username');
        $password=Yii::$app->request->post('password');
        if (empty($username) || empty($password)){
            echo "<script>alert('用户名或密码为空');window.location='/index/login'</script>";
        }else{
            $model=new AdminUser();
            $userInfo=$model->GetUserInfo($username,$password);
            if (!empty($userInfo)){
                $session = Yii::$app->session;
                $session->set('userInfo',$userInfo);
                echo "<script>alert('登录成功');window.location='/menu/index';</script>";
            }else{
                echo "<script>alert('用户名或密码错误，请重新填写');window.location='/index/login';</script>";
            }
        }
        echo $username.$password;die;
    }
    public function actionLogin(){
        return $this->render('login');
    }
    Public function actionLogout(){
        $session = Yii::$app->session;
        $session->removeAll();
        $session->destroy();
        echo "<script>alert('注销成功');window.location='/index/login';</script>";
    }
}