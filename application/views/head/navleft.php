
<div class="topnav nav flex-column navleft" id="myTopnav">
    <div class="logosalee">Salee Colour</div>
    <span class="align-middle" style="padding:10px;border-bottom: 1px solid #ccc;"><i class="fa fa-user-tie fa-2x"></i>&nbsp;Welcome :<?php echo $getuser['Fname']; ?> <a href="http://localhost/complaint_new/login/logout" class="logout_btn" onclick="javascript:return confirm('คุณต้องการออกจากระบบหรือไม่');"><i class="fas fa-sign-out-alt fa-2x"></i></a></span>
    <a href="<?php echo base_url(); ?>complaint/" class="menuborder"><i class="fas fa-home"></i>&nbsp;Home</a>
    <a href="<?php echo base_url(); ?>complaint/add" class="menuborder"><i class="fas fa-plus-circle"></i>&nbsp;New Complaint</a>
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