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
        $this->load->library('form_validation');
    }

    public function index(){

        $this->load->view('admin/login');

    }

    public function register(){

        if($this->input->method()=="post"){
            /********先定义表单验证规则*******/
            $this->form_validation->set_rules('inputEmail','邮箱','required');
            $this->form_validation->set_rules('inputPassword','密码','required');

            if($this->form_validation->run() == false){
                $this->load->view('admin/register');
            }else{
                $username = $this->input->post("inputEmail");
                $password = password_hash($this->input->post("inputPassword"),PASSWORD_DEFAULT);
                $sessionData = array(
                    'username' => $username,
                    'islogin' => true,
                );
                $this->session->set_userdata($sessionData);
                $this->User_Model->insert_user($username,$password);
                //跳转
                redirect(site_url('admin/user/index'));
            }
        }else{
            $this->load->view('admin/register');
        }
    }

    public function login(){
        if($this->input->method() == 'post'){
            $this->form_validation->set_rules('inputEmail','邮箱','required');
            $this->form_validation->set_rules('inputPassword','密码','required');
            if($this->form_validation->run() == false){
                $this->load->view('admin/login');
            }else{

                $username = $this->input->post("inputEmail");
                $password = $this->input->post("inputPassword");
                $userinfo = $this->checkUser($username);

                if($userinfo){
                    $isVaild = $this->checkPwd($password,$userinfo->password);

                    if($isVaild){
                        $this->session->set_userdata('userName',$username);
                        redirect('admin/home');
                    }else{
                        echo "密码不对";
                    }
                }else{
                    echo "没有该用户";
                }
            }
        }else{
            $this->load->view('admin/login');
        }
    }

    //ajax判断用户名是否存在
    public function ajaxCheckUser(){
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

    //判断用户名是否存在
    private function checkUser($username){
        $userinfo = $this->User_Model->getUserByUsername($username);
        if(!empty($userinfo) && isset($userinfo)){
            return $userinfo;
        }
        return false;
    }

    //判断用户的密码是否正确
    private function checkPwd($inputpwd,$pwd){
        if(password_verify($inputpwd,$pwd)){
            return true;
        }
        return false;
    }

    //退出
    public function logOut(){
        if(!empty($this->session->userdata('userName'))){
            $this->session->unset_userdata('userName');
        }
//        $this->session->sess_destroy();//销毁当前 session 。
        redirect('admin/user/login');
    }


}