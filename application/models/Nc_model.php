<?php
class Nc_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function transfrom_complaint(){
        return $this->db->query("SELECT * FROM complaint_main WHERE cp_status ='Transfered To NC' ");
    }
    
    
    public function get_related_dept($cp_no){
        return $this->db->query("SELECT complaint_department_main.cp_dept_main_name, complaint_department_main.cp_dept_main_code, complaint_department.cp_dept_cp_no, complaint_department.cp_dept_sum_status FROM complaint_department_main INNER JOIN complaint_department ON complaint_department.cp_dept_code = complaint_department_main.cp_dept_main_code WHERE cp_dept_cp_no = '$cp_no' ");

    }
    
    
    public function nc_check_dept($cp_no){
        return $this->db->query("SELECT * FROM complaint_related_department WHERE cp_rt_dept_cp_no ='$cp_no' ");
        
    }
    
    
    public function update_status1($cp_no){
        $check_status = $this->db->query("SELECT nc_id FROM nc_main WHERE nc_id='$cp_no' ");
        if($check_status->num_rows()== 0){
            
            $insert_status = array(
                "nc_id" => $cp_no,
                "nc_status" => "Transfrom Complaint"
            ); 
            
            $this->db->insert("nc_main",$insert_status);
            $this->db->query("UPDATE complaint_main SET nc_status='Transfrom Complaint' WHERE cp_no='$cp_no' ");
            
        }
    }
    
    
    
    public function save_nc_zone3($cp_no){
        
//        $data = array(
//            "nc_id" => $this->input->post("nc_id"),
//            "nc_status" => "Waiting Action",
//            "nc_motive" => $this->input->post("nc_motive"),
//            "nc_corrective" => $this->input->post("nc_corrective"),
//            "nc_preventive" => $this->input->post("nc_preventive"),
//            "nc_corrective_date" => $this->input->post("nc_corrective_date"),
//            "nc_preventive_date" => $this->input->post("nc_preventive_date"),
//            "nc_zone3_owner" => $this->input->post("nc_zone3_owner"),
//            "nc_zone3_owner_deptcode" => $this->input->post("nc_zone3_owner_deptcode"),
//            "nc_zone3_owner_dept" => $this->input->post("nc_zone3_owner_dept"),
//            "nc_zone3_owner_date" => $this->input->post("nc_zone3_owner_date")
//            
//        );
//       $result = $this->db->where("nc_id",$cp_no);
//        $result = $this->db->update("nc_main",$data);
        
        $nc_status = "Waiting Action";
        $nc_motive = $this->input->post("nc_motive");
        $nc_corrective = $this->input->post("nc_corrective");
        $nc_preventive = $this->input->post("nc_preventive");
        $nc_corrective_date = $this->input->post("nc_corrective_date");
        $nc_preventive_date = $this->input->post("nc_preventive_date");
        $nc_zone3_owner = $this->input->post("nc_zone3_owner");
        $nc_zone3_owner_deptcode = $this->input->post("nc_zone3_owner_deptcode");
        $nc_zone3_owner_dept = $this->input->post("nc_zone3_owner_dept");
        $nc_zone3_owner_date = $this->input->post("nc_zone3_owner_date");
        
        $this->db->query("UPDATE complaint_main SET nc_status='Waiting Action' WHERE cp_no='$cp_no' ");
        
       $result = $this->db->query("UPDATE nc_main SET nc_status='$nc_status', nc_motive='$nc_motive', nc_corrective='$nc_corrective', nc_preventive='$nc_preventive', nc_corrective_date='$nc_corrective_date', nc_preventive_date='$nc_preventive_date', nc_zone3_owner='$nc_zone3_owner', nc_zone3_owner_deptcode='$nc_zone3_owner_deptcode', nc_zone3_owner_dept='$nc_zone3_owner_dept', nc_zone3_owner_date=CURDATE() WHERE nc_id='$cp_no'  ");
        
        if(!$result){
            echo "บันทึกข้อมูลไม่สำเร็จ";
        }else{
            echo "บันทึกข้อมูลสำเร็จ";
        }
        
        
    }
    
    
    /*******GET ZONE************/
    
    public function get_nc($cp_no){
        $query = $this->db->query("SELECT * FROM nc_main WHERE nc_id ='$cp_no' ");
        
        return $query->row_array();
    }
    
    public function get_nc2(){
        $query = $this->db->query("SELECT * FROM nc_main");
        
        return $query->result_array();
    }
    
    
    public function get_rel_dept($cp_no){
        $query = $this->db->query("SELECT complaint_related_department.cp_rt_dept_code, complaint_related_department.cp_rt_dept_id, complaint_related_department.cp_rt_dept_cp_no, complaint_related_department.cp_rt_dept_status, complaint_department_main.cp_dept_main_name FROM complaint_related_department INNER JOIN complaint_department_main ON complaint_department_main.cp_dept_main_code = complaint_related_department.cp_rt_dept_code WHERE cp_rt_dept_cp_no='$cp_no' ");
        return $query->result();
    }
    /*******GET ZONE************/
    
    
    
    public function save_nc_follow1($cp_no){
        
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

	
		$file_name = $_FILES['file_follow1']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['file_follow1']['size'];
		$file_tmp =$_FILES['file_follow1']['tmp_name'];
		$file_type=$_FILES['file_follow1']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/".$file_name_date);
                
                print_r($file_name);
                
                if($this->input->post("followup1_radio")== 0){
                    $followup1 = array(
                    "nc_status" => "Followup_1st Complete",
                    "nc_followup1" => $this->input->post("followup1_text"),
                    "nc_followup1_file" => $file_name_date,
                    "nc_followup1_status" => $this->input->post("followup1_radio"),
                    "nc_followup1_date" => $this->input->post("followup1_date")
                    
                );
                }else{
                    $followup1 = array(
                    "nc_status" => "Followup_1st",
                    "nc_followup1" => $this->input->post("followup1_text"),
                    "nc_followup1_file" => $file_name_date,
                    "nc_followup1_status" => $this->input->post("followup1_radio"),
                    "nc_followup1_date" => $this->input->post("followup1_date")
                    
                );
                }
                
                $this->db->where("nc_id",$cp_no);
                $this->db->update("nc_main",$followup1);
	
	echo "<br>"."Copy/Upload Complete"."<br>";
          
    }
    
    public function save_nc_follow2($cp_no){
        
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

	
		$file_name = $_FILES['file_follow2']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['file_follow2']['size'];
		$file_tmp =$_FILES['file_follow2']['tmp_name'];
		$file_type=$_FILES['file_follow2']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/".$file_name_date);
                
                print_r($file_name);
                
                if($this->input->post("followup2_radio")==0){
                    $followup2 = array(
                    "nc_status" => "Followup_2nd Complete",
                    "nc_followup2" => $this->input->post("followup2_text"),
                    "nc_followup2_file" => $file_name_date,
                    "nc_followup2_status" => $this->input->post("followup2_radio"),
                    "nc_followup2_date" => $this->input->post("followup2_date")
                    
                );
                }else{
                    $followup2 = array(
                    "nc_status" => "Followup_2nd",
                    "nc_followup2" => $this->input->post("followup2_text"),
                    "nc_followup2_file" => $file_name_date,
                    "nc_followup2_status" => $this->input->post("followup2_radio"),
                    "nc_followup2_date" => $this->input->post("followup2_date")
                    
                );
                }
                
                $this->db->where("nc_id",$cp_no);
                $this->db->update("nc_main",$followup2);
	
	echo "<br>"."Copy/Upload Complete"."<br>";
    }
    
        public function save_nc_follow3($cp_no){
        
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน

	
		$file_name = $_FILES['file_follow3']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['file_follow3']['size'];
		$file_tmp =$_FILES['file_follow3']['tmp_name'];
		$file_type=$_FILES['file_follow3']['type'];  
		move_uploaded_file($file_tmp,"asset/nc/".$file_name_date);
                
                print_r($file_name);
                
                $followup3 = array(
                    "nc_followup3" => $this->input->post("followup3_text"),
                    "nc_followup3_file" => $file_name_date,
                    "nc_followup3_status" => $this->input->post("followup3_radio")

                );
                $this->db->where("nc_id",$cp_no);
                $this->db->update("nc_main",$followup3);
	
	echo "<br>"."Copy/Upload Complete"."<br>";
    }
    
    public function save_nc_conclusion($cp_no){
        $nc_conclusion = array(
            "nc_conclusion" => $this->input->post("nc_conclusion"),
            "nc_conclusion_user" => $this->input->post("nc_conclusion_user"),
            "nc_conclusion_date" => $this->input->post("nc_conclusion_date")
        );
        
        $this->db->where("nc_id",$cp_no);
        $this->db->update("nc_main",$nc_conclusion);
        
    }
    
    
    
    
    
}



?>
