<?php
namespace Common\Model;
use Think\Model;
class PositionContentModel extends Model{
    private $_db = '';
    public function __construct()
    {
        $this->_db = M('position_content');
    }
    public function select($data = array(),$limit=0){
        if($data['title']){
            $data['title']=array('like','%'.$data['title'].'%');
        }
        $this->_db->where($data)->order('listorder desc,id desc');
        if($limit){
            $this->_db->limit($limit);
        }
        $list = $this->_db->select();
        return $list;
    }
    public function find($id){
        $data = $this->_db->where('id='.$id)->find();
        return $data;
    }
    public function insert($data = array()){
        if(!$data || !is_array($data)){
            return 0;
        }
        if(!$data['create_time']){
            $data['create_time'] = time();
        }

        return $this->_db->add($data);
    }
    public function updateStatusById($id,$status){
        if(!is_numeric($status)){
            throw_exception('status不能为非数字');
        }
        if(!$id||!is_numeric($id)){
            throw_exception('id不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('id='.$id)->save($data);//根据条件更新记录
    }
    public function updateById($id,$data){
        if(!$id||!is_numeric($id)){
            throw_exception('ID不合法');
        }
        if(!$data||!is_array($data)){
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where('id='.$id)->save($data);//根据条件更新记录
    }
    public function updateListorderById($id,$listorder){
        if(!$id||!is_numeric($id)){
            throw_exception('ID不合法');
        }
        $data = array('listorder'=>intval($listorder));
        return $this->_db->where('id='.$id)->save($data);
    }



}