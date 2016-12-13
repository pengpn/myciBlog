<?php
/**
 * Created by PhpStorm.
 * User: pnpeng
 * Date: 2016/12/9
 * Time: 15:05
 */
class User_Model extends CI_Model{
    /**
     * User_model constructor.
     */
    public function insert_user($username,$password){
        //构造数据
        $data = array(
            'name' => $username,
            'password' => $password,
            'mail' => $username,
        );
        $this->db->insert('my_user',$data);

    }

    public function getUserByUsername($username){
        if($username != null){
            $query = $this->db->get_where('my_user',array('name'=>$username));
            $row = $query->row();
            if(isset($row)){
                return $row;
            }
            return false;
        }
        return false;
    }

}