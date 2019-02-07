<?php  
    class Nc extends CI_Controller{
        public function __construct() {
            parent::__construct();
            
            $this->load->model('complaint_model');
            $this->load->model('login_model');
            $this->load->model('nc_model');
        }
        
        
        public function index(){
            $this->login_model->callLogin();
            $data['getuser'] = $this->login_model->getuser();
            $data['transfrom_cp'] = $this->nc_model->transfrom_complaint();
            $data['get_nc2'] = $this->nc_model->get_nc2();
            
            $this->load->view("head/headcode");
            $this->load->view("head/script");
            $this->load->view("nc/index",$data);
        }
        
        public function add_nc($cp_no){
            $this->login_model->callLogin();
            $data['getuser'] = $this->login_model->getuser();
            $data['rs'] = $this->complaint_model->edit_complaint($cp_no);
            $data['transfrom_cp'] = $this->nc_model->transfrom_complaint();
            $data['get_upload_file'] = $this->complaint_model->get_file_upload("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            $data['get_rela_dept'] = $this->nc_model->get_related_dept($cp_no);
            $data['get_nc'] = $this->nc_model->get_nc($cp_no);
            $data['get_rel_dept'] = $this->nc_model->get_rel_dept($cp_no);
            
            
            $this->load->view("head/headcode");
            $this->load->view("head/script");
            $this->load->view("nc/new_nc",$data);
        }
        
        public function save_nc_zone3($cp_no){
            $this->nc_model->save_nc_zone3();
            
            
            redirect('/nc/add_nc/'.$cp_no);
        }
        
        public function save_nc_follow1($cp_no){
            $this->nc_model->save_nc_follow1($cp_no);
            
            redirect('/nc/add_nc/'.$cp_no);
        }
        
        public function save_nc_follow2($cp_no){
            $this->nc_model->save_nc_follow2($cp_no);
            
            redirect('/nc/add_nc/'.$cp_no);
        }
        
        public function save_nc_follow3($cp_no){
            $this->nc_model->save_nc_follow3($cp_no);
            
            redirect('/nc/add_nc/'.$cp_no);
        }
        
        public function save_nc_conclusion($cp_no){
            $this->nc_model->save_nc_conclusion($cp_no);
            
            redirect('/nc/add_nc/'.$cp_no);
        }
        
        
        
        
    }
?>