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
    
    public function save_nc_zone3(){
        
        $data = array(
            "nc_id" => $this->input->post("nc_id"),
            "nc_motive" => $this->input->post("nc_motive"),
            "nc_corrective" => $this->input->post("nc_corrective"),
            "nc_preventive" => $this->input->post("nc_preventive"),
            "nc_corrective_date" => $this->input->post("nc_corrective_date"),
            "nc_preventive_date" => $this->input->post("nc_preventive_date"),
            "nc_zone3_owner" => $this->input->post("nc_zone3_owner")
        );
       
        $result = $this->db->insert("nc_main",$data);
        
        if(!$result){
            echo "บันทึกข้อมูลไม่สำเร็จ";
        }else{
            echo "บันทึกข้อมูลสำเร็จ";
        }
        
        
    }
    
    public function get_nc($cp_no){
        $query = $this->db->query("SELECT * FROM nc_main WHERE nc_id ='$cp_no' ");
        
        return $query->row_array();
    }
    
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
                
                $followup1 = array(
                    "nc_followup1" => $this->input->post("followup1_text"),
                    "nc_followup1_file" => $file_name_date,
                    "nc_followup1_status" => $this->input->post("followup1_radio"),
                    "nc_followup1_date" => $this->input->post("followup1_date")
                    
                );
                
                
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
                
                $followup2 = array(
                    "nc_followup2" => $this->input->post("followup2_text"),
                    "nc_followup2_file" => $file_name_date,
                    "nc_followup2_status" => $this->input->post("followup2_radio"),
                    "nc_followup2_date" => $this->input->post("followup2_date")
                    
                );
                
                
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
