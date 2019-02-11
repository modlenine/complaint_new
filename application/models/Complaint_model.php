<?php

class Complaint_model extends CI_Model {//main

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');

        require("PHPMailer_5.2.0/class.phpmailer.php");
    }

    public function addcomplaint() {
        
    }

    public function gettopic() {//select หัวข้อของ Complaint ออกมาจาก Database 
        $sql = "SELECT topic_name , topic_cat_name  FROM complaint_topic LEFT JOIN complaint_topic_catagory ON complaint_topic.topic_cat_id = complaint_topic_catagory.topic_cat_id";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getCPno() { //สร้าง Auto complaint number
        $query = $this->db->query("select cp_no from complaint_main"); //ไปนับแถวของ cp_no ก่อน
        $numrow = $query->num_rows(); //ไปนับแถวของ cp_no ก่อน
        $year_cur = date("Y"); //กำหนด ปีปัจจุบันใส่ตัวแปร year_cur
        $cut_year_cur = substr($year_cur, 2, 2); // ตัดจากเดิม 2018 เหลือ 18

        if ($numrow == 0) { //นับแถวของข้อมูล ถ้าเท่ากับ 0
            $cp_no = "CP" . $cut_year_cur . "001"; // กำหนดค่าลงไปเลย
        } else { // ถ้าไม่เป็นตามเงื่อนไขบน
            $query2 = $this->db->query("select cp_no from complaint_main order by SUBSTR(cp_no,5) desc LIMIT 1"); //ไป query เอา cp_no มาโดยตัดเอาแค่ 3 ตัวหลังตัวล่าสุดมา 1 ตัว

            foreach ($query2->result_array() as $rs) { //ไปวิ่งเช็คข้อมูล
                $cal = $rs['cp_no']; //ตรงนี้เราจะได้ค่า CP18100
            }
            $cut_yold = substr($cal, 2,2);//ตัดปี 2 ตัวท้าย
            $cut_cp = substr($cal, 2); // 18100
            $cut_cp ++;
            $set_y = str_replace($cut_yold, "CP".$cut_year_cur, $cut_cp); //ทำการ Get Year ของปัจจุบันลงไป
                       
            $cp_no = $set_y;
            
        }
        return $cp_no; // ส่งค่ากลับไป
    }
    
    
public function getStatus($sql){
    return $this->queryData($sql);
}


public function checkdept($sql){
    $c_dept = $this->queryData($sql);
    
    return $c_dept->result_array();
}

public function get_file_upload($sql){
    $g_f_upload = $this->queryData($sql);
    $g_f_upload_r = $g_f_upload->result_array();
    return $g_f_upload_r;
}

public function get_dept_name($sql){
    $g_d_name = $this->queryData($sql);
    $g_d_name_r = $g_d_name->result_array();
    return $g_d_name_r;
}
    
    

    public function getPriority($sql) { //คำสั่ง Query Database โดยรับค่า $sql 
        $query = $this->db->query($sql);
        return $query;
    }

    public function queryData($sql) {
        $query = $this->db->query($sql);
        return $query;
    }

    public function set_activeEmail() {
        $lab = $this->input->post("lab");
        $admin = $this->input->post("admin");
        $hr = $this->input->post("hr");
        $account = $this->input->post("account");
        $qc = $this->input->post("qc");
        $maintenance = $this->input->post("maintenance");
        $pd = $this->input->post("pd");
        $sales = $this->input->post("sales");
        $warehouse = $this->input->post("warehouse");
        $planning = $this->input->post("planning");
        $it = $this->input->post("it");
        $pu = $this->input->post("pu");
        $qmr = "1099";

        //เช็คว่ามีการติ๊กเลือกแผนกเพื่อส่ง Email หรือไม่ ถ้าไม่มีจะขึ้นการแจ้งเตือน
        if ($lab == "" and $admin == "" and $hr == "" and $account == "" and $qc == "" and $maintenance == "" and $pd == "" and $sales == "" and $warehouse == "" and $planning == "" and $it == "" && $pu == "") {
            echo "please choose department for sent email";
            exit();
        } else {//ถ้ามีการติ๊กเลือก ให้ดำเนินการปรับ สถานะ
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$lab' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$admin' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$hr' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$account' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$qc' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$maintenance' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$pd' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$sales' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$warehouse' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$planning' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$it' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$pu' ");
            $this->queryData("update maillist set cp_mail_active = 1 where deptcode = '$qmr' ");
        }
    }

    public function set_deactiveEmail() {
        $this->queryData("update maillist set cp_mail_active = 0");
    }

    public function smtpmail($email, $subject, $body) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้ 
        $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
        $mail->Host = "mail.saleecolour.com";  // specify main and backup server
        $mail->Port = 587; // พอร์ท
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "websystem@saleecolour.com";  // SMTP username
        $mail->Password = "Ae8686#"; // SMTP password

        $mail->From = "websystem@saleecolour.com";
        $mail->FromName = "Salee Colour WEB System";
        $mail->AddAddress($email);
// $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
        $mail->WordWrap = 50;                                 // set word wrap to 50 characters
// $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
        $mail->IsHTML(true);                                  // set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $result = $mail->send();
        return $result;
    }

    public function cp_submit() {
        $getuser = $this->login_model->getuser();
        
        
        /****Main Table***/
        $cp_no = $this->input->post("cp_no");
        $cp_topic = $this->input->post("cp_topic_hide");
        $cp_topic_cat = $this->input->post("cp_topic_cat");
        $cp_priority = $this->input->post("sum_score");
        $cp_user_name = $this->input->post("cp_user_name");
        $cp_user_empid = $this->input->post("cp_user_empid");
        $cp_user_dept = $this->input->post("cp_user_dept");
        $cp_cus_name = $this->input->post("cp_cus_name");
        $cp_cus_ref = $this->input->post("cp_cus_ref");
        $cp_invoice_no = $this->input->post("cp_invoice_no");
        $cp_pro_code = $this->input->post("cp_pro_code");
        $cp_pro_lotno = $this->input->post("cp_pro_lotno");
        $cp_pro_qty = $this->input->post("cp_pro_qty");
        $cp_detail = $this->input->post("cp_detail");
        $cp_status = $this->input->post("cp_status");
        
        /**Department Table***/
        $lab_code = $this->input->post("lab");
        $admin_code = $this->input->post("admin");
        $hr_code = $this->input->post("hr");
        $account_code = $this->input->post("account");
        $qc_code = $this->input->post("qc");
        $maintenance_code = $this->input->post("maintenance");
        $pd_code = $this->input->post("pd");
        $sales_code = $this->input->post("sales");
        $warehouse_code = $this->input->post("warehouse");
        $planning_code = $this->input->post("planning");
        $it_code = $this->input->post("it");
        $pu_code = $this->input->post("pu");
        
        
        
        //อัพโหลดไฟล์แบบหลายไฟล์ลง Folderโดย+วันที่+เวลาต่อท้ายไฟล์
        $date = date("d-m-Y-H-i-s");//ดึงวันที่และเวลามาก่อน
        foreach($_FILES['file']['tmp_name'] as $key => $val)//สั่งวนลูป
	{
		$file_name = $_FILES['file']['name'][$key];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = str_replace(".","-".$date.".", $file_name_cut);
                
		$file_size =$_FILES['file']['size'][$key];
		$file_tmp =$_FILES['file']['tmp_name'][$key];
		$file_type=$_FILES['file']['type'][$key];  
		move_uploaded_file($file_tmp,"asset/".$file_name_date);
                
                print_r($file_name);
                
                $up_file = array(
                    "file_cp_no" => $cp_no,
                    "file_name" => $file_name_date
                );
                
                $this->db->insert("complaint_file_upload",$up_file);
	}
	echo "<br>"."Copy/Upload Complete"."<br>";


        if($this->input->post('cp_topic_cat')== "Safety" || $this->input->post('cp_topic_cat')== "System" || $this->input->post('cp_topic_cat')== "Environment"){
            
            /*  -------------------------SEND--EMAIL------------------------------------------   */
        $sqlEmail = "SELECT email FROM maillist WHERE cp_mail_active = 1 "; //1=it , 2=sales , 3=cs
        $query = $this->queryData($sqlEmail);

        foreach ($query->result_array() as $fetch) {

            $email = $fetch['email'];

            $subject = "New Complaint";
            $body = "<h2>You have new complaint for validation.</h2>";
            $body .= "<strong>Complaint No. : </strong>" . $this->input->post('cp_no') . "&nbsp;&nbsp;<strong>Date : </strong>" . $this->input->post('cp_date') . "<br>";
            $body .= "<strong>Topic : </strong>" . $this->input->post('cp_topic_hide') . "&nbsp;&nbsp;<strong>Category : </strong>" . $this->input->post('cp_topic_cat') . "<br>";
            $body .="<strong>Status : </strong>" . $this->input->post('cp_status')."<br>";

            $body .= "<strong><h2>Priority</h2></strong>";
            $body .= "<strong>Customer Satisfaction : </strong>" . $this->input->post('pri1_name') . "<br>";
            $body .= "<strong>Production Loss : </strong>" . $this->input->post('pri2_name') . "<br>";
            $body .= "<strong>Business Disruption : </strong>" . $this->input->post('pri3_name') . "<br>";
            $body .= "<strong>Machinery performance : </strong>" . $this->input->post('pri4_name') . "<br>";
            $body .= "<strong>The image of enterprise : </strong>" . $this->input->post('pri5_name') . "<br>";
            $body .= "<strong>Complaints : </strong>" . $this->input->post('pri6_name') . "<br>";
            $body .= "<strong>Impact on personal : </strong>" . $this->input->post('pri7_name') . "<br>";
            $body .= "<strong>Summary Score : </strong>" . $this->input->post('sum_score') . "&nbsp;&nbsp;<strong>Complaint Priority is :</strong>" . $this->input->post('') . "<br>";

            $body .= "<h2>User Information</h2>";
            $body .= "<strong>Complaint Person :</strong>" . $this->input->post('cp_user_name') . "&nbsp;&nbsp;<strong>Employee ID :</strong>" . $this->input->post('cp_user_empid') . "&nbsp;&nbsp;<strong>Department :</strong>" . $this->input->post('cp_user_dept');

            $body .= "<h2>Details of Complaint / Damages</h2>";
//            $body .= "<strong>Customer Name : </strong>" . $this->input->post('cp_cus_name') . "<br>";
//            $body .= "<strong>Customer Ref. : </strong>" . $this->input->post('cp_cus_ref') . "<br>";
//            $body .= "<strong>Invoice Number : </strong>" . $this->input->post('cp_invoice_no') . "<br>";
//            $body .= "<strong>Product Code : </strong>" . $this->input->post('cp_pro_code') . "<br>";
//            $body .= "<strong>Lot No. : </strong>" . $this->input->post('cp_pro_lotno') . "<br>";
//            $body .= "<strong>Quantity : </strong>" . $this->input->post('cp_pro_qty') . "<br>";
            $body .= "<strong>Complaint Detail : </strong>" . $this->input->post('cp_detail') . "<br>";
            
            $get_filename = $this->queryData("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            foreach ($get_filename->result_array() as $gf){
                $gff = $gf['file_name'];
            
            
            $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint_new/asset/$gff>" .$gff. "</a>" . "<br>";
            }
            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint_new/complaint/investigation/".$cp_no.">" . "Go to Page</a>";
            $this->smtpmail($email, $subject, $body);
        }
            
        }else{
            
            /*  -------------------------SEND--EMAIL------------------------------------------   */
        $sqlEmail = "SELECT email FROM maillist WHERE cp_mail_active = 1 "; //1=it , 2=sales , 3=cs
        $query = $this->queryData($sqlEmail);

        foreach ($query->result_array() as $fetch) {

            $email = $fetch['email'];

            $subject = "New Complaint";
            $body = "<h2>You have new complaint for validation.</h2>";
            $body .= "<strong>Complaint No. : </strong>" . $this->input->post('cp_no') . "&nbsp;&nbsp;<strong>Date : </strong>" . $this->input->post('cp_date') . "<br>";
            $body .= "<strong>Topic : </strong>" . $this->input->post('cp_topic_hide') . "&nbsp;&nbsp;<strong>Category : </strong>" . $this->input->post('cp_topic_cat') . "<br>";
            $body .="<strong>Status : </strong>" . $this->input->post('cp_status');

            $body .= "<strong><h2>Priority</h2></strong>";
            $body .= "<strong>Customer Satisfaction : </strong>" . $this->input->post('pri1_name') . "<br>";
            $body .= "<strong>Production Loss : </strong>" . $this->input->post('pri2_name') . "<br>";
            $body .= "<strong>Business Disruption : </strong>" . $this->input->post('pri3_name') . "<br>";
            $body .= "<strong>Machinery performance : </strong>" . $this->input->post('pri4_name') . "<br>";
            $body .= "<strong>The image of enterprise : </strong>" . $this->input->post('pri5_name') . "<br>";
            $body .= "<strong>Complaints : </strong>" . $this->input->post('pri6_name') . "<br>";
            $body .= "<strong>Impact on personal : </strong>" . $this->input->post('pri7_name') . "<br>";
            $body .= "<strong>Summary Score : </strong>" . $this->input->post('sum_score') . "&nbsp;&nbsp;<strong>Complaint Priority is :</strong>" . $this->input->post('') . "<br>";

            $body .= "<h2>User Information</h2>";
            $body .= "<strong>Complaint Person :</strong>" . $this->input->post('cp_user_name') . "&nbsp;&nbsp;<strong>Employee ID :</strong>" . $this->input->post('cp_user_empid') . "&nbsp;&nbsp;<strong>Department :</strong>" . $this->input->post('cp_user_dept');

            $body .= "<h2>Details of Complaint / Damages</h2>";
            $body .= "<strong>Customer Name : </strong>" . $this->input->post('cp_cus_name') . "<br>";
            $body .= "<strong>Customer Ref. : </strong>" . $this->input->post('cp_cus_ref') . "<br>";
            $body .= "<strong>Invoice Number : </strong>" . $this->input->post('cp_invoice_no') . "<br>";
            $body .= "<strong>Product Code : </strong>" . $this->input->post('cp_pro_code') . "<br>";
            $body .= "<strong>Lot No. : </strong>" . $this->input->post('cp_pro_lotno') . "<br>";
            $body .= "<strong>Quantity : </strong>" . $this->input->post('cp_pro_qty') . "<br>";
            $body .= "<strong>Complaint Detail : </strong>" . $this->input->post('cp_detail') . "<br>";

             $get_filename = $this->queryData("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            foreach ($get_filename->result_array() as $gf){
                $gff = $gf['file_name'];
                
            $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint_new/asset/$gff>" .$gff. "</a>" . "<br>";
            }
            
            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint_new/complaint/investigation/".$cp_no.">" . "Go to page</a>";
            $this->smtpmail($email, $subject, $body);
        }
            
        }
        
        
        
        

//    if (!$send) {
//        echo "Message could not be sent.";
//        echo "Mailer Error: " . $mail->ErrorInfo;
//        exit;
//    }
        /*  ------------------------SEND----EMAIL----------------------------------------------------   */

        
        
        
        /* -----------INSERT--TO--DATABASE-------------- */
        $query = $this->db->query("insert into complaint_main (cp_no , cp_date , cp_topic , cp_topic_cat , cp_priority , cp_user_name , cp_user_empid , cp_user_dept , cp_cus_name , cp_cus_ref , cp_invoice_no , cp_pro_code , cp_pro_lotno , cp_pro_qty , cp_detail , cp_status ) VALUES ('$cp_no',CURDATE(), '$cp_topic' , '$cp_topic_cat' , '$cp_priority' , '$cp_user_name' , '$cp_user_empid' , '$cp_user_dept' , '$cp_cus_name' , '$cp_cus_ref' , '$cp_invoice_no' , '$cp_pro_code' , '$cp_pro_lotno' , '$cp_pro_qty' , '$cp_detail' , '$cp_status') ");
        /* -----------INSERT--TO--DATABASE-------------- */

        
        
        /*  Insert priority to priority table  */
        $ar1 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri1_val"),
            "cp_pri_use_group" => $this->input->post("pri1_group"),
            "cp_pri_use_name" => $this->input->post("pri1_name")
        );

        $ar2 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri2_val"),
            "cp_pri_use_group" => $this->input->post("pri2_group"),
            "cp_pri_use_name" => $this->input->post("pri2_name")
        );

        $ar3 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri3_val"),
            "cp_pri_use_group" => $this->input->post("pri3_group"),
            "cp_pri_use_name" => $this->input->post("pri3_name")
        );

        $ar4 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri4_val"),
            "cp_pri_use_group" => $this->input->post("pri4_group"),
            "cp_pri_use_name" => $this->input->post("pri4_name")
        );

        $ar5 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri5_val"),
            "cp_pri_use_group" => $this->input->post("pri5_group"),
            "cp_pri_use_name" => $this->input->post("pri5_name")
        );

        $ar6 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri6_val"),
            "cp_pri_use_group" => $this->input->post("pri6_group"),
            "cp_pri_use_name" => $this->input->post("pri6_name")
        );

        $ar7 = array(
            "cp_pri_use_cpno" => $cp_no,
            "cp_pri_use_score" => $this->input->post("pri7_val"),
            "cp_pri_use_group" => $this->input->post("pri7_group"),
            "cp_pri_use_name" => $this->input->post("pri7_name")
        );

        $this->db->insert("complaint_priority_use", $ar1);
        $this->db->insert("complaint_priority_use", $ar2);
        $this->db->insert("complaint_priority_use", $ar3);
        $this->db->insert("complaint_priority_use", $ar4);
        $this->db->insert("complaint_priority_use", $ar5);
        $this->db->insert("complaint_priority_use", $ar6);
        $this->db->insert("complaint_priority_use", $ar7);
         /*  Insert priority to priority table  */
        
        
        
        /*  Insert department to department table  */
        
        $dept_code1 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $lab_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code2 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $admin_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code3 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $hr_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code4 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $account_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code5 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $qc_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code6 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $maintenance_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code7 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $pd_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code8 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $sales_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code9 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $warehouse_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code10 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $planning_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code11 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $it_code,
            "cp_dept_sum_status" => 0
        );
        $dept_code12 = array(
            "cp_dept_cp_no" => $cp_no,
            "cp_dept_code" => $pu_code,
            "cp_dept_sum_status" => 0
        );
        
        if($lab_code != ""){
            $this->db->insert("complaint_department",$dept_code1);
        }else{}
        if($admin_code != ""){
            $this->db->insert("complaint_department",$dept_code2);
        }else{}
        if($hr_code != ""){
            $this->db->insert("complaint_department",$dept_code3);
        }else{}
        if($account_code != ""){
            $this->db->insert("complaint_department",$dept_code4);
        }else{}
        if($qc_code != ""){
            $this->db->insert("complaint_department",$dept_code5);
        }else{}
        if($maintenance_code != ""){
            $this->db->insert("complaint_department",$dept_code6);
        }else{}
        if($pd_code != ""){
            $this->db->insert("complaint_department",$dept_code7);
        }else{}
        if($sales_code != ""){
            $this->db->insert("complaint_department",$dept_code8);
        }else{}
        if($warehouse_code != ""){
            $this->db->insert("complaint_department",$dept_code9);
        }else{}
        if($planning_code != ""){
            $this->db->insert("complaint_department",$dept_code10);
        }else{}
        if($it_code != ""){
            $this->db->insert("complaint_department",$dept_code11);
        }else{}
        if($pu_code != ""){
            $this->db->insert("complaint_department",$dept_code12);
        }else{}
        /*  Insert department to department table  */
        
        
        
        
        /* Insert File Upload to file upload table */
//       $up_file = array(
//           "file_cp_no" => $cp_no,
//           "file_name" => $this->input->post("file[]")
//       );
        /* Insert File Upload to file upload table */
        
       
       
        
        $this->set_deactiveEmail();

        if (!$query) {
            echo "บันทึกข้อมูลไม่สำเร็จ";
        } else {
            echo "บันทึกข้อมูลสำเร็จ";
            header("refresh:1; url=http://192.190.10.27/complaint_new/complaint/");
        }
//redirect("computer","refresh");

        /* -----------INSERT--TO--DATABASE-------------- */
    }
    
    
    
/****** *********************GET DATA**************  **************** ******/    
    public function getDataAll(){
        return $getdataall = $this->queryData("select * from complaint_main order by cp_no desc");
    }
    
    public function getStrPriority(){
        
    }
/****** *********************GET DATA**************  **************** ******/  
    
    
    
    /*********************************EDIT DATA****************************************/
    public function edit_complaint($cp_no){
        $rs = $this->db->query("select * from complaint_main where cp_no = '$cp_no' ");
        $rss = $rs->row_array();
        
        return $rss;
    }
    
    public function editPriority($sql){
        $g_pri = $this->db->query($sql);
        $g_prii = $g_pri->row_array();
        return $g_prii;
    }
    
    public function updateStatus($cp_no){
       return $this->db->query("UPDATE complaint_main SET cp_status='Pending' where cp_no='$cp_no' ");
    }
    /*********************************EDIT DATA****************************************/
    
    
/******************************************Investigate****************************************/

/******Change status of investigate old = new complaint , change to investigation *******/
    public function changeStatus($cp_no){
         $this->db->query("UPDATE complaint_main SET cp_status='Complaint Analyzed' WHERE cp_no='$cp_no' ");
         
    }
    
    public function emailChangeStatus($cp_no){
        $result = $this->db->query("SELECT * FROM complaint_main WHERE cp_no='$cp_no' ");
        $results = $result->row_array();
        
        $deptEmail = $this->db->query("SELECT * FROM complaint_department WHERE cp_dept_cp_no='$cp_no' ");
        foreach ($deptEmail->result_array() as $deptEm){
            $resultDeptEm = $deptEm['cp_dept_code']; 
            
            $getEmail = $this->db->query("select * from maillist where deptcode='$resultDeptEm' ");
            
            foreach ($getEmail->result_array() as $gemail){
               $email = $gemail['email'];
                
                $subject = "Starting Investigation";
            $body = "<h2>Complaint started the investigation</h2>";
            $body .= "<strong>Complaint No. : </strong>" . $cp_no . "<br>";
            $body .= "<strong>CP Status. : </strong>" . $results['cp_status']. "<br>";
            
            $get_filename = $this->queryData("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            foreach ($get_filename->result_array() as $gf){
                $gff = $gf['file_name'];
                
            $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint_new/asset/$gff>" .$gff. "</a>" . "<br>";
            }
            
            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint_new/complaint/investigation/".$cp_no.">" . "Go to Page</a>";
            $sendEmail = $this->smtpmail($email, $subject, $body);

            if(!$sendEmail){
                echo "ส่ง Email ไม่ผ่าน";
            }else{
                echo "ส่ง Email สำเร็จ";
            }
            
            }
        }
    }
/******Change status of investigate old = new complaint , change to investigation *******/
    
    
    
    /** Insert Detail of investigate **/
    public function saveDetailInves($cp_no){
        
        $cp_detail_inves_detail = $this->input->post("cp_detail_inves_detail");
        $cp_detail_inves_signature = $this->input->post("cp_detail_inves_signature");
        $cp_detail_inves_dept = $this->input->post("cp_detail_inves_dept");
        
        $this->db->query("UPDATE complaint_main SET cp_detail_inves='$cp_detail_inves_detail' , cp_detail_inves_signature='$cp_detail_inves_signature' , cp_detail_inves_dept='$cp_detail_inves_dept' , cp_detail_inves_date=CURDATE(), cp_status = 'Investigation Complete'  WHERE cp_no='$cp_no' ");
        
         
    }
    
    
    /***********Send Email for update status*******************/
        public function emailChangeStat2($cp_no){
            $result = $this->db->query("SELECT * FROM complaint_main WHERE cp_no='$cp_no' ");
        $results = $result->row_array();
            
            $deptEmail = $this->db->query("SELECT * FROM complaint_department WHERE cp_dept_cp_no='$cp_no' ");
        foreach ($deptEmail->result_array() as $deptEm){
            $resultDeptEm = $deptEm['cp_dept_code']; 
            
            $getEmail = $this->db->query("SELECT * FROM maillist WHERE deptcode='$resultDeptEm' ");
            
            foreach ($getEmail->result_array() as $gemail){
               $email = $gemail['email'];
                
                $subject = "Investigation complete";
            $body = "<h2>The investigation is complete</h2>";
            $body .= "<strong>Complaint No. : </strong>" . $cp_no . "<br>";
            $body .= "<strong>CP Status. : </strong>" . $results['cp_status']. "<br>";
      
            
            $get_filename = $this->queryData("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            foreach ($get_filename->result_array() as $gf){
                $gff = $gf['file_name'];
                
            $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint_new/asset/$gff>" .$gff. "</a>" . "<br>";
            }
            
            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint_new/complaint/investigation/".$cp_no.">" . "Go to Page</a>";
            $sendEmail = $this->smtpmail($email, $subject, $body);

            if(!$sendEmail){
                echo "ส่ง Email ไม่ผ่าน";
            }else{
                echo "ส่ง Email สำเร็จ";
            }
            
            }
        }
        }
        
        
    /***********Send Email for update status*******************/
    /** Insert Detail of investigate **/
    
        
        
    
    /** Insert Summary of investigate **/
    public function saveSuminves($cp_no){
        
        $cp_sum_inves_detail = $this->input->post("cp_sum_inves_detail");
        $cp_sum_inves_signature = $this->input->post("cp_sum_inves_signature");
        $cp_sum_inves_dept = $this->input->post("cp_sum_inves_dept");
        $cp_sum = $this->input->post("cp_sum");
        
        if($cp_sum == "no"){
            $this->db->query("UPDATE complaint_main SET cp_status='Normal Complaint' WHERE cp_no='$cp_no' ");
        }
        if($cp_sum == "yes"){
            $this->db->query("UPDATE complaint_main SET cp_status='Transfered To NC' WHERE cp_no='$cp_no' ");
            $this->db->query("UPDATE complaint_main SET nc_status='Transfrom Complaint' WHERE cp_no='$cp_no' ");
        }
        
        $result = $this->db->query("UPDATE complaint_main SET cp_sum_inves='$cp_sum_inves_detail' , cp_sum_inves_signature='$cp_sum_inves_signature' , cp_sum_inves_dept='$cp_sum_inves_dept' , cp_sum_inves_date=CURDATE() , cp_sum='$cp_sum' WHERE cp_no='$cp_no' ");
        
        
        if(!$result){
            echo "บันทึกข้อมูลไม่สำเร็จ";
            die();
        }else{
            echo "<span style='color:green;'>บันทึกข้อมูลสำเร็จ !!</span>";
            
        }
        
        /*  Insert department to department table  */
        $lab_code_sum = $this->input->post("lab_sum");
        $admin_code_sum = $this->input->post("admin_sum");
        $hr_code_sum = $this->input->post("hr_sum");
        $account_code_sum = $this->input->post("account_sum");
        $qc_code_sum = $this->input->post("qc_sum");
        $maintenance_code_sum = $this->input->post("maintenance_sum");
        $pd_code_sum = $this->input->post("pd_sum");
        $sales_code_sum = $this->input->post("sales_sum");
        $warehouse_code_sum = $this->input->post("warehouse_sum");
        $planning_code_sum = $this->input->post("planning_sum");
        $it_code_sum = $this->input->post("it_sum");
        $pu_code_sum = $this->input->post("pu_sum");
        
        $dept_code1 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $lab_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code2 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $admin_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code3 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $hr_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code4 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $account_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code5 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $qc_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code6 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $maintenance_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code7 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $pd_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code8 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $sales_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code9 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $warehouse_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code10 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $planning_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code11 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $it_code_sum,
            "cp_rt_dept_status" => 1
        );
        $dept_code12 = array(
            "cp_rt_dept_cp_no" => $cp_no,
            "cp_rt_dept_code" => $pu_code_sum,
            "cp_rt_dept_status" => 1
        );
        
        if($lab_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code1);
        }else{}
        if($admin_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code2);
        }else{}
        if($hr_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code3);
        }else{}
        if($account_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code4);
        }else{}
        if($qc_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code5);
        }else{}
        if($maintenance_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code6);
        }else{}
        if($pd_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code7);
        }else{}
        if($sales_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code8);
        }else{}
        if($warehouse_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code9);
        }else{}
        if($planning_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code10);
        }else{}
        if($it_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code11);
        }else{}
        if($pu_code_sum != ""){
            $this->db->insert("complaint_related_department",$dept_code12);
        }else{}
        /*  Insert department to department table  */
         
    }
    
    
    

/***********Send Email Change Status********************** */
    public function emailChangeStat3($cp_no){
            $result = $this->db->query("SELECT * FROM complaint_main WHERE cp_no='$cp_no' ");
        $results = $result->row_array();
            
            $deptEmail = $this->db->query("SELECT * FROM complaint_department WHERE cp_dept_cp_no='$cp_no' ");
        foreach ($deptEmail->result_array() as $deptEm){
            $resultDeptEm = $deptEm['cp_dept_code']; 
            
            $getEmail = $this->db->query("SELECT * FROM maillist WHERE deptcode='$resultDeptEm' ");
            
            foreach ($getEmail->result_array() as $gemail){
               $email = $gemail['email'];
                
                $subject = "Summary of complaint completed";
            $body = "<h2>Summary of complaint completed</h2>";
            $body .= "<strong>Complaint No. : </strong>" . $cp_no . "<br>";
            $body .= "<strong>CP Status. : </strong>" . $results['cp_status']. "<br>";
      
            
            $get_filename = $this->queryData("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            foreach ($get_filename->result_array() as $gf){
                $gff = $gf['file_name'];
                
            $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint_new/asset/$gff>" .$gff. "</a>" . "<br>";
            }
            
            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint_new/complaint/investigation/".$cp_no.">" . "Go to Page</a>";
            $sendEmail = $this->smtpmail($email, $subject, $body);

            if(!$sendEmail){
                echo "ส่ง Email ไม่ผ่าน";
            }else{
                echo "ส่ง Email สำเร็จ";
            }
            
            }
        }
        }
/***********Send Email Change Status********************** */
    /** Insert Summary of investigate **/
  
    
    
/* Insert conclusion complaint */
    public function save_conclusion($cp_no){
        $cp_conclu_detail = $this->input->post("cp_conclu_detail");
        $cp_conclu_signature = $this->input->post("cp_conclu_signature");
        $cp_conclu_dept = $this->input->post("cp_conclu_dept");

        $this->db->query("UPDATE complaint_main SET cp_conclu_detail='$cp_conclu_detail' , cp_conclu_signature='$cp_conclu_signature' , cp_conclu_dept='$cp_conclu_dept' , cp_conclu_date=CURDATE() , cp_status='Close Complaint' WHERE cp_no = '$cp_no' ");
        
    }
    
/******************Change Email Status********************/
    public function emailChangeStat4($cp_no){
        $deptEmail = $this->db->query("SELECT * FROM complaint_department WHERE cp_dept_cp_no='$cp_no' ");
        foreach ($deptEmail->result_array() as $deptEm){
            $resultDeptEm = $deptEm['cp_dept_code']; 
            
            $getEmail = $this->db->query("select * from maillist where deptcode='$resultDeptEm' ");
            
            foreach ($getEmail->result_array() as $gemail){
               $email = $gemail['email'];
                
                $subject = "Close Complaint";
            $body = "<h2>Close Complaint</h2>";
            $body .= "<strong>Complaint No. : </strong>" . $cp_no . "<br>";
      
            
            $get_filename = $this->queryData("select * from complaint_file_upload where file_cp_no ='$cp_no' ");
            foreach ($get_filename->result_array() as $gf){
                $gff = $gf['file_name'];
                
            $body .= "<strong>Link Attached File : </strong>" . "<a href=http://192.190.10.27/complaint_new/asset/$gff>" .$gff. "</a>" . "<br>";
            }
            
            $body .= "<strong>Link Program : </strong>" . "<a href=http://192.190.10.27/complaint_new/complaint/investigation/".$cp_no.">" . "Go to Page</a>";
            $sendEmail = $this->smtpmail($email, $subject, $body);

            if(!$sendEmail){
                echo "ส่ง Email ไม่ผ่าน";
            }else{
                echo "ส่ง Email สำเร็จ";
            }
            
            }
        }
    }
/******************Change Email Status********************/
    
/* Insert conclusion complaint */
    
    
    
    
    
    

}

//main
?>
