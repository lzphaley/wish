<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class BasicController extends CommonController{
    public function index(){
        $result = D("Basic")->select();
//        dump($result);exit;
        //填充到模板
        $this->assign('vo',$result);
        $this->display();
    }
    public function add(){
        if($_POST){
            if(!$_POST['title']){
                return show(0,'站点信息不能为空');
            }
            if(!$_POST['keywords']){
                return show(0,'站点关键词不能为空');
            }
            if(!$_POST['description']){
                return show(0,'站点描述不能为空');
            }
            D("Basic")->save($_POST);//插入数据
            return show(1,'配置成功');
        }else{
            return show(0,'没有提交的数据');
        }
    }
    /*
     * 缓存管理
     */
    public function cache(){
        $this->assign('type',2);

        $this->display();
    }
}