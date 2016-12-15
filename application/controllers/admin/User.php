<?php
/**
 * Created by PhpStorm.
 * User: pnpeng
 * Date: 2016/12/8
 * Time: 10:29
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    /**
     * User Constructor
     */
    public $userinfo;

    public function __construct(){
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
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
            $username = trim($this->input->post('inputEmail'));
            $this->userinfo = $this->User_Model->getUserByUsername($username);
            $this->form_validation->set_rules('inputEmail','邮箱','required|callback_username_check');
            $this->form_validation->set_rules('inputPassword','密码','required|callback_password_check');
            if($this->form_validation->run() == false){
                $this->load->view('admin/login');
            }else{

                $this->session->set_userdata('userName',$username);
                redirect('admin/home');
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
    public function username_check($username){
        $userinfo = $this->User_Model->getUserByUsername($username);
        if($username == ''){
            $this->form_validation->set_message('username_check','用户名不能为空');
            return false;
        }else if(empty($userinfo)){
            $this->form_validation->set_message('username_check','用户不存在');
            return false;
        }else{
            return true;
        }
    }

    //判断用户的密码是否正确
    public function password_check($inputpwd){
        if(password_verify($inputpwd,$this->userinfo['password'])){
            return true;
        }
        $this->form_validation->set_message('password_check','密码错误');
        return false;
    }

    //退出
    public function logOut(){

        $this->session->sess_destroy();//销毁当前 session 。
        redirect('admin/user/login');
    }


}