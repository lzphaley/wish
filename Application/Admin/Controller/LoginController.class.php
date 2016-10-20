<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class LoginController extends Controller {

    public function index(){
        if(session('adminUser')){
            $this->redirect('/wish/admin.php?c=index');
        }
        //admin.php
    	return $this->display();
    }
    public function check(){
    	//同步操作处理登录测试
        // echo "check_success";
        // print_r($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!trim($username)){
            return show(0,'用户名不能为空');
        }
        if(!trim($password)){
            return show(0,'密码不能为空');
        }

        $ret = D('Admin')->getAdminByUsername($username);
        // print_r($ret);
        if (!$ret) {
        	return show(0,'该用户不存在');
        }
        if($ret['password']!=getMd5Password($password)){
            return show(0,'密码错误');
        }
        session('adminUser',$ret);
        return show(1,'登录成功');
    }
    public function loginOut(){
        session('adminUser',null);
        $this->redirect('/wish/admin.php?c=login');
    }

}