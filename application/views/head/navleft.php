
<div class="topnav nav flex-column navleft" id="myTopnav">
    <div class="logosalee">Salee Colour</div>
    <span class="align-middle" style="padding:10px;border-bottom: 1px solid #ccc;"><i class="fa fa-user-tie fa-2x"></i>&nbsp;K. <?php echo $getuser['username']; ?> <a href="http://192.190.10.27/complaint_new/login/logout" class="logout_btn" onclick="javascript:return confirm('คุณต้องการออกจากระบบหรือไม่');"><i class="fas fa-sign-out-alt fa-2x"></i></a><br>
    <span>Dept.&nbsp;<?php echo $getuser['Dept']; ?></span>
    <input type="text" name="deptcode" id="deptcode" value="<?php echo $getuser['DeptCode']; ?>" />
    
    
    </span>
    
    <a href="<?php echo base_url(); ?>complaint/" class="menuborder"><i class="fas fa-home"></i>&nbsp;View Complaint</a>
    <a href="<?php echo base_url(); ?>complaint/add" class="menuborder"><i class="fas fa-plus-circle"></i>&nbsp;New Complaint</a>
    <a href="<?php echo base_url(); ?>nc/" class="menuborder"><i class="fas fa-home"></i>&nbsp;View NC</a>
    <a href="#" class="menuborder"><i class="fas fa-history"></i>&nbsp;View History</a>
    <a href="#" class="menuborder"><i class="fas fa-file-export"></i>&nbsp;Report</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>

    <div class="usermenu"><i class="fas fa-user-cog fa-2x"></i>&nbsp;User Menu</div>
    <a><i class="fas fa-info-circle"></i>&nbsp;View Profile</a>
    <a><i class="fas fa-key"></i>&nbsp;Change Password</a>

</div>

<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav nav flex-column navleft") {
            x.className += " responsive";
        } else {
            x.className = "topnav nav flex-column navleft";
        }
    }
</script>