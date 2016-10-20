<?php
/**
 * Created by PhpStorm.
 * User: haley
 * Date: 2016-10-11
 * Time: 9:00
 */
namespace Common\Model;
use Think\Model;

class AdminModel extends Model{
    private $_db = '';
    public function __construct()
    {
        $this->_db = M('admin');
    }

    public function getAdminByUsername($username = ''){
        $ret = $this->_db->where('username="'.$username.'"')->find();
        return $ret;
    }
    public function getAdminByAdminId($adminId = 0){
        $ret = $this->_db->where('admin_id="'.$adminId.'"')->find();
        return $ret;
    }
    public function updateByAdminId($id,$data){
        if(!$id||!is_numeric($id)){
            throw_exception('ID不合法');
        }
        if(!$data||!is_array($data)){
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where('admin_id='.$id)->save($data);
    }
    public function insert($data=array()){
        if(!$data||!is_array($data)){
            return 0;
        }
        return $this->_db->add($data);
    }
    public function getAdmins(){
        $data = array(
            'status'=>array('neq',-1),
        );
        return $this->_db->where($data)->order('admin_id desc')->select();
    }
    public function updateStatusById($id,$status){
        if(!is_numeric($status)){
            throw_exception('status不能为非数字');
        }
        if(!$id||!is_numeric($id)){
            throw_exception('id不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('admin_id='.$id)->save($data);
    }
}