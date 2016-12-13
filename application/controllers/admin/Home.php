<?php
/**
 * Created by PhpStorm.
 * User: pnpeng
 * Date: 2016/12/13
 * Time: 9:55
 */
class Home extends CI_Controller{

    public function index(){
        $this->load->view("admin/");
    }
}