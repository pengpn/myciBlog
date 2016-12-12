<?php
/**
 * Created by PhpStorm.
 * User: pnpeng
 * Date: 2016/12/8
 * Time: 10:29
 */
class User extends CI_Controller{
    /**
     * User Constructor
     */

    public function __construct(){
        parent::__construct();
        $this->load->model('User_Model');
    }

    public function index(){

        //$this->load->view('admin/login');
        echo "hello";

    }

    public function register(){

        if($this->input->method()=="post"){
            /********先定义表单验证规则*******/
            //导入表单验证类
            $this->load->library('form_validation');
            $this->form_validation->set_rules('inputEmail','邮箱','required');
            $this->form_validation->set_rules('inputPassword','密码','required');
            $username = $this->input->post('userName');

            if($this->form_validation->run() == false){
                $this->load->view('admin/register');
            }else{
                $username = $this->input->post('userName');
                $user = $this->checkUser($username);
                if(!$user){//如果没有这个用户名 可以注册
                    $this->User_Model->insert_user();
                }

                //跳转
                redirect(site_url('admin/user/index'));
            }
        }else{
            $this->load->view('admin/register');
        }


    }

    //ajax判断用户名是否存在
    public function checkUser(){
        $username = $this->input->post("userName");

        $userinfo = $this->User_Model->getUserByUsername($username);

        if(!empty($userinfo) && isset($userinfo)){
            $result = array(
                'status' => 0,
                'msg' => '用户名已经存在，请重新输入',
            );
        }else{
            $result = array(
                'status' => 1,
                'msg' => '用户名可以使用，请继续',
            );
        }
        echo json_encode($result);
    }

    //判断用户的密码是否正确
    private function checkPwd($inputpwd,$pwd){
        if(password_verify($inputpwd,$pwd)){
            return true;
        }else{
            return false;
        }
    }


}