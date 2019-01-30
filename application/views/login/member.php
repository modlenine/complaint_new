<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 


if(isset($_SESSION['username'])== ""){
    echo "Session ว่าง";
}else echo "Session ไม่ว่าง";


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <span>Welcome : </span><?php echo $getuser['Fname']; ?>&nbsp;<?php echo $getuser['Lname']; ?>
        <a href="http://192.190.10.27/complaint_new/login/logout"><input type="submit" name="logout" value="logout" /></a>
    </body>
</html>
