<?php
namespace Common\Model;
use Think\Model;

class MenuModel extends Model{
    private $_db = '';
    public function __construct()
    {
        $this->_db = M('menu');
    }

    public function insert($data = array()){
        if(!$data || !is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }
    //获取数据
    public function getMenus($data,$page,$pageSize=10){
        $data['status'] = array('neq',-1);//获取方式
        $offset = ($page-1)*$pageSize;
        $list = $this->_db->where($data)->order('listorder desc,menu_id desc')->limit($offset,$pageSize)->select();//排序
        return $list;
    }
    //获取总数
    public function getMenusCount($data=array()){
        $data['status'] = array('neq',-1);//获取方式
        return $this->_db->where($data)->count();
    }
    //查找id,进行修改
    public function find($id){
        if(!$id||!is_numeric($id)){
            return array();
        }
        return $this->_db->where('menu_id='.$id)->find();
    }
    //保存更新数据
    public function updateMenuById($id,$data){
        if(!$id||!is_numeric($id)){
            throw_exception('ID不合法');
        }
        if(!$data||!is_array($data)){
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where('menu_id='.$id)->save($data);
    }

    //修改数据为删除状态
    public function updateStatusById($id,$status){
        if(!$id||!is_numeric($id)){
            throw_exception('ID不合法');
        }
        if(!$status||!is_numeric($status)){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('menu_id='.$id)->save($data);
    }
    //执行排序
    public function updateMenuListorderById($id,$listorder){
        if(!$id||!is_numeric($id)){
            throw_exception('ID不合法');
        }

        $data = array(
          'listorder'=>intval($listorder),
        );
        return $this->_db->where('menu_id='.$id)->save($data);
    }
    //侧边栏方法
    public function getAdminMenus(){
        $data = array(
            'status'=>array('neq',-1),
            'type'=>1,
        );
        return $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
    }
    public function getBarMenus(){
        $data = array(
//            'status'=>array('neq',-1),
            'status'=>1,
            'type'=>0,
        );
        $res = $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
        return $res;
    }
}