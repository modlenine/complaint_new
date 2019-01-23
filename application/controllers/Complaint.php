<?php
    class Complaint extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('complaint_model');
            $this->load->model('login_model');
        }

        public function index(){
        $data['getuser'] = $this->login_model->getuser();
        $data['getdataall'] = $this->complaint_model->getDataAll();


            $this->load->view("head/headcode");
            $this->load->view("main_form/index",$data);
        }

        public function add(){
            $data['topic'] = $this->complaint_model->gettopic();
            $data['get_cp_no'] = $this->complaint_model->getCPno();
            $data['get_cp_priority1'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 1");
            $data['get_cp_priority2'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 2");
            $data['get_cp_priority3'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 3");
            $data['get_cp_priority4'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 4");
            $data['get_cp_priority5'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 5");
            $data['get_cp_priority6'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 6");
            $data['get_cp_priority7'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 7");
            $data['getuser'] = $this->login_model->getuser();
            $data['getstatus'] = $this->complaint_model->getStatus("select * from complaint_status");
            

            $this->load->view("head/headcode");
            $this->load->view("main_form/new_complaint",$data);
        }
        
        public function saveData(){
            $this->complaint_model->set_activeEmail();
            $this->complaint_model->cp_submit(); 
            
        }
        
        public function viewComplaint($cp_no){
        $data['topic'] = $this->complaint_model->gettopic();
        $data['rs'] = $this->complaint_model->edit_complaint($cp_no);
        $data['editpriority1'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=1 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority2'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=2 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority3'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=3 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority4'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=4 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority5'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=5 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority6'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=6 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority7'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=7 and cp_pri_use_cpno ='$cp_no' ");
        $data['getuser'] = $this->login_model->getuser();
        $data['get_cp_priority1'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 1");
        $data['check_dept'] = $this->complaint_model->checkdept("select * from complaint_department where cp_dept_cp_no = '$cp_no' ");
        $data['get_upload_file'] = $this->complaint_model->get_file_upload("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            
            
            $this->load->view("head/headcode");
            $this->load->view("main_form/view_complaint",$data);
        }
        
        public function inves_starting($cp_no){
            $this->complaint_model->changeStatus($cp_no);
            $this->complaint_model->emailChangeStatus($cp_no);
            redirect('/complaint/investigation/'.$cp_no);
        }
        
        public function investigation($cp_no){
        $this->login_model->callLogin();
        
        $data['topic'] = $this->complaint_model->gettopic();
        $data['rs'] = $this->complaint_model->edit_complaint($cp_no);
        $data['editpriority1'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=1 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority2'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=2 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority3'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=3 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority4'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=4 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority5'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=5 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority6'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=6 and cp_pri_use_cpno ='$cp_no' ");
        $data['editpriority7'] = $this->complaint_model->editPriority("select * from complaint_priority_use where cp_pri_use_group=7 and cp_pri_use_cpno ='$cp_no' ");
        $data['getuser'] = $this->login_model->getuser();
        $data['get_cp_priority1'] = $this->complaint_model->getPriority("select * from complaint_priority where cp_pri_group = 1");
        $data['check_dept'] = $this->complaint_model->checkdept("select * from complaint_department where cp_dept_cp_no = '$cp_no' ");
        $data['get_upload_file'] = $this->complaint_model->get_file_upload("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
        $data['get_dept_name'] = $this->complaint_model->get_dept_name("SELECT complaint_department.cp_dept_id, complaint_department.cp_dept_code, complaint_department.cp_dept_cp_no, member.Dept FROM complaint_department INNER JOIN member ON member.DeptCode = complaint_department.cp_dept_code WHERE complaint_department.cp_dept_cp_no = '$cp_no' GROUP BY complaint_department.cp_dept_code DESC");
            
            $this->load->view("head/headcode");
            $this->load->view("main_form/investigate_complaint",$data);
        }
        
        
        public function add_detail_inves($cp_no){
            $this->complaint_model->saveDetailInves($cp_no);
            $this->complaint_model->emailChangeStat2($cp_no);
            redirect('/complaint/investigation/'.$cp_no);
            
        }
        
        public function add_sum_of_inves($cp_no){
            $this->complaint_model->saveSuminves($cp_no);
            $this->complaint_model->emailChangeStat3($cp_no);
            redirect('/complaint/investigation/'.$cp_no);
        }

        public function add_conclusion($cp_no){
            $this->complaint_model->save_conclusion($cp_no);
            $this->complaint_model->emailChangeStat4($cp_no);
            redirect('/complaint/investigation/'.$cp_no);
        }
        

        

        
        
        
        
    }


?>
