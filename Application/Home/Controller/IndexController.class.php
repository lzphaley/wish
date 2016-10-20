<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class IndexController extends CommonController {
    public function index($type=''){
        //获取排行
        $rankNews = $this->getRank();
        //获取首页大图数据
        $topPicNews = D("PositionContent")->select(array('status'=>1,'position_id'=>2),1);
        //获取首页推荐小图
        $topSmallNews = D("PositionContent")->select(array('status'=>1,'position_id'=>3),3);
        //列表图
        $listNews = D("PositionContent")->select(array('status'=>1,'thumb'=>array('neq','')),4);

        //广告位图
        $adNews = D("PositionContent")->select(array('status'=>1,'position_id'=>5),2);
        $this->assign('result',array(
            'topPicNews'=>$topPicNews,
            'topSmallNews'=>$topSmallNews,
            'listNews'=>$listNews,
            'adNews'=>$adNews,
            'rankNews'=>$rankNews,
            'catId'=>0,
        ));
        //生成页面静态化
        if($type == 'buildHtml'){
            $this->buildHtml('index',HTML_PATH,'Index/index');
        }else{
            $this->display();
        }

    }
    //静态页面
    public function build_html(){
        $this->index('buildHtml');
        return show(1,'首页缓存生成成功');
    }
    //定时更新
    public function crontab_build_html(){
        if(APP_CRONTAB !=1){
            die("the_file_must_exec_crontab");
        }
        $result = D("Basic")->select();
        if(!$result['cacheindex']){
            die('系统没有设置开启自动生成首页缓存的内容');
        }
        $this->index('buildHtml');
    }
    public function getCount(){
        if(!$_POST){
            return show(0,'没有任何内容');
        }
        $newsIds = array_unique($_POST);

        try{
            $list = D("News")->getNewsByNewsId($newsIds);
        }catch(Exception $e){
            return show(0,$e->getMessage());;
        }
        if(!$list){
            return show(0,'没有返回值');
        }
        $data = array();
        foreach($list as $k=>$v){
            $data[$v['news_id']] = $v['count'];
        }
        return show(1,'success',$data);
    }
}