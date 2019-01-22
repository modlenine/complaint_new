<?php
class Login_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('Login_model');
    }
    public function escape_string(){
        return mysqli_connect("localhost", "root", "1234", "saleecolour");
    }
    
    public function queryData($sql){
        return $this->db->query($sql);
    }
    
    
    public function checkLogin(){
        
        $username = mysqli_escape_string($this->escape_string(),isset($_POST['username']) ?($_POST['username']) : '');
        $password = mysqli_escape_string($this->escape_string(),isset($_POST['password']) ?($_POST['password']) : '');
        
        $checkuser = $this->queryData(sprintf("select * from member where `username` = '%s' and `password` = '%s' ", $username, $password
));
        $checkdata = $checkuser->num_rows();
        
        if($checkdata == 0){
            echo "<h2 style='color:red;text-align:center;margin-top:30px;'>Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</h2>";
            header("refresh:2; url=http://localhost/complaint_new/");
        }else{
            echo "<h2 style='text-align:center;color:green;margin-top:30px;'>เข้าสู่ระบบสำเร็จ กรุณารอสักครู่ระบบกำลังพาท่านเข้าสู่หน้าโปรแกรม</h2>";
            foreach ($checkuser->result_array() as $r){
                $_SESSION['username'] = $r['username'];
                $_SESSION['password'] = $r['password'];
                $_SESSION['Fname'] = $r['Fname'];
                $_SESSION['Lname'] = $r['Lname'];
                session_write_close();
                
                if($r['posi']==75){
                    echo "<h3 style='color:green;text-align:center;'>"."Welcome ".$r['Fname']."Permission : Admin"."</h3>";
                    header("refresh:2; url=http://localhost/complaint_new/complaint");
                }else if($r['posi']==15){
                    echo "<h3 style='color:green;text-align:center;'>"."Welcome ".$r['Fname']."Permission : user"."</h3>";
                    header("refresh:2; url=http://localhost/complaint_new/complaint");
                }
            }
        }
         
    }
    
    public function callLogin(){
        if (isset($_SESSION['username']) == "") {
            echo "<h1 style='text-align:center;margin-top:50px;'>กรุณา Login เข้าสู่ระบบ</h1>";
    header("refresh:2; url=http://localhost/complaint_new/");
    die();
}
    }
    
    
    public function getuser(){
        $result = $this->queryData("select * from member where username = '".$_SESSION['username']."' ");
        foreach ($result->result_array() as $gu){
            $gu['Fname'];
            $gu['Lname'];
            $gu['ecode'];
            $gu['Dept'];
            $gu['username'];
            $gu['DeptCode'];
        }

        return $gu;
    }
    
    public function logout(){
        session_destroy();
	header("location:http://localhost/complaint_new/login");
    }
    
    
}



?>

