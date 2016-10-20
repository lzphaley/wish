<?php
namespace Home\Controller;
use Think\Controller;

class DetailController extends CommonController {
    public function index(){
        $id = intval($_GET['id']);
        if(!$id||$id<0){
            $this->error("ID不合适");
        }
        $news = D("News")->find($id);
        if(!$news||$news['status']!=1){
            return $this->error("ID不存在或者资询文章被删除");
        }
        $count = intval($news['count'])+1;
        D("News")->updateCount($id,$count);

        $content = D("NewsContent")->find($id);
        $news['content'] = htmlspecialchars_decode($content['content']);

        $adNews = D("PositionContent")->select(array('status'=>1,'position_id'=>5),2);
        $rankNews = $this->getRank();

        $this->assign('result',array(
            'adNews'=>$adNews,
            'rankNews'=>$rankNews,
            'catId'=>$news['catid'],
            'news'=>$news,
        ));
        $this->display("Detail/index");
    }
    //页面预览
    public function view(){
        if(!getLoginUsername()){
            $this->error("您没有权限访问该页面");
        }
        $this->index();
    }
}