<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    if(isset($_SESSION['username'])!= ""){
    header('Location: http://192.190.10.27/complaint_new/complaint/');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Complaint system</title>
    </head>
    <body>
        <div class="container">
            <div class="mainlogin">
            <p><h1 style="text-align: center;">Form Login</h1></p>
            <form name="frmLogin" method="post" action="http://192.190.10.27/complaint_new/login/checklogin" id="">
            <p><label>Username : </label><input type="text" name="username" id="username" class="form-control"/></p>
            <p><label>Password : </label><input type="password" name="password" id="password" class="form-control"/></p>
            <p><input type="submit" name="btnLogin" ></p>
        </form>
            </div>
            </div>
    </body>
</html>
