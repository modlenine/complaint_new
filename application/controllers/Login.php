<?php
class Login extends CI_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('login_model');
    }
    
    public function index(){
        
        
        $this->load->view("head/headcode");
        $this->load->view("login/index");
    }
    
    public function checklogin(){
        $this->login_model->checkLogin();
        
    }
    
    public function logout(){
        $this->login_model->logout();
    }
    
    public function member(){
    $data['getuser'] = $this->login_model->getuser();
        $this->load->view("login/member",$data);
    }
    
    
    
    
}

?>