<?php
/**
 * Created by PhpStorm.
 * User: pnpeng
 * Date: 2016/12/13
 * Time: 9:55
 */
class Home extends CI_Controller{

    public function index(){
        if($this->session->userdata('userName')){//已经登陆
            $this->load->view("admin/home");
        }else{//没有登陆 跳回登陆界面
            redirect('admin/user/login');
        }
    }
}