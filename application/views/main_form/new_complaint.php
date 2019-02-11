<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
            <div class="row"><!-- Section Main area  -->

                <!-- Nav Left Menu From view folder -->
                <div class="col-md-2">
                    <?php $this->load->view("head/navleft"); ?>
                </div>
                <!-- Nav Left Menu From view folder -->

                <div class="col-md-10 ct-col10">

                    <form name="frmMain" action="../complaint/saveData" method="post" enctype="multipart/form-data">
                        <div class="form-cp-main">
                            <h1 style="text-align: center;">Complaint Form</h1><hr>


                            <div class="card border-info mb-3">
                                <div class="card-header text-white bg-info"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Topic</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <label><b>ID</b></label>
                                            <input type="text" name="cp_no" id="cp_no" class="form-control form-control-sm form-width" readonly="" placeholder="CP NO." value="<?php echo $get_cp_no; ?>"/>
                                        </div>
                                        <div class="col-md-2">
                                            <label><b>Date</b></label>
                                            <input type="text" name="cp_date" id="cp_date" class="form-control form-control-sm form-width" value="<?php echo date('d/m/Y'); ?>" readonly=""/>
                                        </div>

                                        <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->                                   
                                        <script language="JavaScript">
                                            function resutName(strCusName)
                                            {
                                                frmMain.cp_topic_hide.value = strCusName.split("|")[0];
                                                frmMain.cp_topic_cat.value = strCusName.split("|")[1];
                                            }
                                        </script>
                                        <!-- Code สำหรับการ ตัดคำที่ดึงมา 2 Value และคั่นด้วย | -->   
                                        <div class="col-md-3">
                                            <label><b>Topic</b></label>
                                            <select name="cp_topic" id="cp_topic" class="form-control form-control-sm" OnChange="resutName(this.value);" required="">
                                                <option selected="">Please choose topic</option>
                                                <?php foreach ($topic->result_array() as $t): ?>
                                                    <option value="<?php echo $t['topic_name']; ?>|<?php echo $t['topic_cat_name']; ?>"><?php echo $t['topic_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        

                                        <div class="col-md-3">
                                            <label><b>Catagory</b></label>
                                            <input type="text" name="cp_topic_hide" id="cp_topic_hide" class="form-control form-control-sm" hidden=""/><!-- Topicname -->
                                            <input type="text" name="cp_topic_cat" id="cp_topic_cat" class="form-control form-control-sm" readonly=""/><!-- Topic catagory -->

                                        </div>
                                        

                                        <div class="col-md-2">
                                            <label hidden=""><b>Status</b></label>
                                            <input type="text" name="cp_status" id="cp_status" value="New Complaint" hidden=""/>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            
                            
                            <div class="card border-success mb-3">
                                <div class="card-header text-white bg-success"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Priority</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName1(strCusName)
                                            {
                                                frmMain.pri1_val.value = strCusName.split("|")[0];
                                                frmMain.pri1_group.value = strCusName.split("|")[1];
                                                frmMain.pri1_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                        
                                            <label ><b>Customer Satisfaction</b></label>
                                            <select class="form-control form-control-sm" name="pri1" id="pri1" OnChange="resutName1(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach ($get_cp_priority1->result_array() as $g1):?>
                                                <option value="<?php echo $g1['cp_pri_score']; ?>|<?php echo $g1['cp_pri_group']; ?>|<?php echo $g1['cp_pri_name']; ?>"><?php echo $g1['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri1_val" id="pri1_val" hidden=""/>
                                            <input type="text" name="pri1_group" id="pri1_group" hidden=""/>
                                            <input type="text" name="pri1_name" id="pri1_name" hidden=""/>
                                        </div>
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName2(strCusName)
                                            {
                                                frmMain.pri2_val.value = strCusName.split("|")[0];
                                                frmMain.pri2_group.value = strCusName.split("|")[1];
                                                frmMain.pri2_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                            
                                            <label><b>Production Loss</b></label>
                                            <select class="form-control form-control-sm" name="pri2" id="pri2" OnChange="resutName2(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach ($get_cp_priority2->result_array() as $g2): ?>
                                                <option value="<?php echo $g2['cp_pri_score']; ?>|<?php echo $g2['cp_pri_group']; ?>|<?php echo $g2['cp_pri_name']; ?>"><?php echo $g2['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri2_val" id="pri2_val" hidden=""/>
                                            <input type="text" name="pri2_group" id="pri2_group" hidden=""/>
                                            <input type="text" name="pri2_name" id="pri2_name" hidden=""/>
                                        </div>
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName3(strCusName)
                                            {
                                                frmMain.pri3_val.value = strCusName.split("|")[0];
                                                frmMain.pri3_group.value = strCusName.split("|")[1];
                                                frmMain.pri3_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                            
                                            <label><b>Business Disruption</b></label>
                                            <select class="form-control form-control-sm" name="pri3" id="pri3" OnChange="resutName3(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach ($get_cp_priority3->result_array() as $g3): ?>
                                                <option value="<?php echo $g3['cp_pri_score']; ?>|<?php echo $g3['cp_pri_group']; ?>|<?php echo $g3['cp_pri_name']; ?>"><?php echo $g3['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri3_val" id="pri3_val" hidden=""/>
                                            <input type="text" name="pri3_group" id="pri3_group" hidden=""/>
                                            <input type="text" name="pri3_name" id="pri3_name" hidden=""/>
                                        </div>
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName4(strCusName)
                                            {
                                                frmMain.pri4_val.value = strCusName.split("|")[0];
                                                frmMain.pri4_group.value = strCusName.split("|")[1];
                                                frmMain.pri4_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                            
                                            <label><b>Machinery performance</b></label>
                                            <select class="form-control form-control-sm" name="pri4" id="pri4" OnChange="resutName4(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach ($get_cp_priority4->result_array() as $g4): ?>
                                                <option value="<?php echo $g4['cp_pri_score']; ?>|<?php echo $g4['cp_pri_group']; ?>|<?php echo $g4['cp_pri_name']; ?>"><?php echo $g4['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri4_val" id="pri4_val" hidden=""/>
                                            <input type="text" name="pri4_group" id="pri4_group" hidden=""/>
                                            <input type="text" name="pri4_name" id="pri4_name" hidden=""/>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName5(strCusName)
                                            {
                                                frmMain.pri5_val.value = strCusName.split("|")[0];
                                                frmMain.pri5_group.value = strCusName.split("|")[1];
                                                frmMain.pri5_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                            
                                            <label><b>The image of enterprise</b></label>
                                            <select class="form-control form-control-sm" name="pri5" id="pri5" OnChange="resutName5(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach($get_cp_priority5->result_array() as $g5): ?>
                                                <option value="<?php echo $g5['cp_pri_score']; ?>|<?php echo $g5['cp_pri_group']; ?>|<?php echo $g5['cp_pri_name']; ?>"><?php echo $g5['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri5_val" id="pri5_val" hidden=""/>
                                            <input type="text" name="pri5_group" id="pri5_group" hidden=""/>
                                            <input type="text" name="pri5_name" id="pri5_name" hidden=""/>
                                        </div>
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName6(strCusName)
                                            {
                                                frmMain.pri6_val.value = strCusName.split("|")[0];
                                                frmMain.pri6_group.value = strCusName.split("|")[1];
                                                frmMain.pri6_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                            
                                            <label><b>Complaints</b></label>
                                            <select class="form-control form-control-sm" name="pri6" id="pri6" OnChange="resutName6(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach($get_cp_priority6->result_array() as $g6): ?>
                                                <option value="<?php echo $g6['cp_pri_score']; ?>|<?php echo $g6['cp_pri_group']; ?>|<?php echo $g6['cp_pri_name']; ?>"><?php echo $g6['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri6_val" id="pri6_val" hidden=""/>
                                            <input type="text" name="pri6_group" id="pri6_group" hidden=""/>
                                            <input type="text" name="pri6_name" id="pri6_name" hidden=""/>
                                        </div>
                                        <div class="col-md-3">
                                            
                                            <script language="JavaScript">
                                            function resutName7(strCusName)
                                            {
                                                frmMain.pri7_val.value = strCusName.split("|")[0];
                                                frmMain.pri7_group.value = strCusName.split("|")[1];
                                                frmMain.pri7_name.value = strCusName.split("|")[2];
                                            }
                                            </script>
                                            
                                            <label><b>Impact on personal</b></label>
                                            <select class="form-control form-control-sm" name="pri7" id="pri7" OnChange="resutName7(this.value);" required="">
                                                <option>Please choose value</option>
                                                <?php foreach($get_cp_priority7->result_array() as $g7): ?>
                                                <option value="<?php echo $g7['cp_pri_score']; ?>|<?php echo $g7['cp_pri_group']; ?>|<?php echo $g7['cp_pri_name']; ?>"><?php echo $g7['cp_pri_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="text" name="pri7_val" id="pri7_val" hidden=""/>
                                            <input type="text" name="pri7_group" id="pri7_group" hidden=""/>
                                            <input type="text" name="pri7_name" id="pri7_name" hidden=""/>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                var sumnumber , sumlast;
                                                
                                                $("#pri1,#pri2,#pri3,#pri4,#pri5,#pri6,#pri7").change(function(){
                                                    
                                                    sumnumber = parseFloat($("#pri1 option:selected").val()) + parseFloat($("#pri2 option:selected").val()) + parseFloat($("#pri3 option:selected").val()) + parseFloat($("#pri4 option:selected").val()) + parseFloat($("#pri5 option:selected").val()) + parseFloat($("#pri6 option:selected").val()) + parseFloat($("#pri7 option:selected").val());
                                                    sumlast = sumnumber / 7;
                                                    
                                                    $('#sum_score').val(sumlast.toFixed( 2 ));
                                                    
                                                });
                                            });
                                        </script>
                                        
                                        <div class="col-md-3">
                                            <label><b>Summary Score</b></label>
                                            <input type="text" id="sum_score" name="sum_score" class="form-control form-control-sm" readonly="" /><!-- ค่าเฉลี่ยของคะแนนทั้งหมด -->
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            


                            <div class="card border-info mb-3">
                                <div class="card-header text-white bg-info"><h4><b><i class="fas fa-user-circle"></i>&nbsp;&nbsp;User Information</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label><b>Complaint Person</b></label>
                                            <input type="text" name="cp_user_name" id="cp_id" class="form-control form-control-sm form-width" readonly="" placeholder="Complaint Person" value="<?php echo $getuser['username']; ?>"/>
                                        </div>

                                        <div class="col-md-3">
                                            <label><b>Employee ID</b></label>
                                            <input type="text" name="cp_user_empid" id="cp_date" class="form-control form-control-sm form-width" readonly="" placeholder="Employee ID" value="<?php echo $getuser['ecode']; ?>"/>
                                        </div>

                                        <div class="col-md-3">
                                            <label><b>Department</b></label>
                                            <input type="text" name="cp_user_dept" id="cp_user_dept" class="form-control form-control-sm form-width" readonly="" placeholder="Department" value="<?php echo $getuser['Dept']; ?>"/>
                                        </div>

                                        <div class="col-md-3">

                                        </div>
                                    </div>

                                </div>
                            </div><br>


                            <div class="card border-success mb-3">
                                <div class="card-header text-white bg-success"><h4><b><i class="far fa-id-card"></i>&nbsp;&nbsp;Details of Complaint / Damages</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3" id="h_username">
                                            <a href="#"><i class="fas fa-plus-circle iconcolor"></i></a>&nbsp;<label><b>Customer Name</b></label>
                                            <input type="text" name="cp_cus_name" id="cp_cus_name" class="form-control form-control-sm form-width"  placeholder="Customer Name" required=""/>
                                        </div>

                                        <div class="col-md-3" id="h_cusref">
                                            <label><b>Customer Ref.</b></label>
                                            <input type="text" name="cp_cus_ref" id="cp_cus_ref" class="form-control form-control-sm form-width"  placeholder="Customer Ref." required=""/>
                                        </div>

                                        <div class="col-md-3" id="h_inv">
                                            <label><b>Invoice Number</b></label>
                                            <input type="text" name="cp_invoice_no" id="cp_invoice_no" class="form-control form-control-sm form-width"  placeholder="Invoice Number" required=""/>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col-md-4" id="h_procode">
                                            <label><b>Product Code</b></label>
                                            <input type="text" name="cp_pro_code" id="cp_pro_code" class="form-control form-control-sm form-width"  placeholder="Product Code"/>
                                        </div>

                                        <div class="col-md-4" id="h_lotno">
                                            <label><b>Lot No.</b></label>
                                            <input type="text" name="cp_pro_lotno" id="cp_pro_lotno" class="form-control form-control-sm form-width"  placeholder="Lot No."/>
                                        </div>

                                        <div class="col-md-4" id="h_qty">
                                            <label><b>Quantity</b></label>
                                            <input type="text" name="cp_pro_qty" id="cp_pro_qty" class="form-control form-control-sm form-width"  placeholder="Quantity"/>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col-md-12 form-group">
                                            <textarea name="cp_detail" class="form-control form-control-sm" type="textarea" id="message" placeholder="Message" maxlength="2000" rows="7" required=""></textarea>
                                            <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('.add_more').click(function (e) {
                                                    e.preventDefault();
                                                    $(this).before("<p><input name='file[]' type='file' class='form-control form-control-sm'/></p>");
                                                });
                                            });
                                        </script>
                                        <div class="col-md-6">
                                            <p><input name="file[]" id="file" type="file" class="form-control form-control-sm"/></p>
                                            <p><button type='button' class="add_more">Add More Files</button></p>
                                        </div>
                                        <div class="col-md-3">

                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $('#characterLeft').text('2000 characters left');
                                            $('#message').keydown(function () {
                                                var max = 2000;
                                                var len = $(this).val().length;
                                                if (len >= max) {
                                                    $('#characterLeft').text('You have reached the limit');
                                                    $('#characterLeft').addClass('red');
                                                    $('#btnSubmit').addClass('disabled');
                                                } else {
                                                    var ch = max - len;
                                                    $('#characterLeft').text(ch + ' characters left');
                                                    $('#btnSubmit').removeClass('disabled');
                                                    $('#characterLeft').removeClass('red');
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>

                            

                            <div class="card border-light mb-3">
                                <div class="card-header"><h4><b><i class="fas fa-envelope-open"></i>&nbsp;&nbsp;Related Department</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="lab" id="lab" value="1015" />
                                            <label for="lab"><b>LAB</b></label>
                                            <br>
                                            <i for="lab" class="fas fa-flask fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="admin" id="admin" value="1001"/>
                                            <label for="admin"><b>ADMIN</b></label>
                                            <br>
                                            <i class="fas fa-building fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="hr" id="hr" value="1005"/>
                                            <label for="hr"><b>HR</b></label>
                                            <br>
                                            <i class="fas fa-male fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="account" id="account" value="1003"/>
                                            <label for="ac"><b>ACCOUNT & FINANCE</b></label>
                                            <br>
                                            <i class="far fa-credit-card fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="qc" id="qc" value="1014"/>
                                            <label for="qc"><b>QC</b></label>
                                            <br>
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="maintenance" id="maintenance" value="1009"/>
                                            <label for="maintenance"><b>MAINTENANCE</b></label>
                                            <br>
                                            <i class="fas fa-screwdriver fa-2x"></i>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="pd" id="pd" value="1007"/>
                                            <label for="pd"><b>PD</b></label>
                                            <br>
                                            <i class="fas fa-industry fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="sales" id="sales" value="1006"/>
                                            <label for="sales"><b>SALES</b></label>
                                            <br>
                                            <i class="fas fa-hand-holding-usd fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="warehouse" id="warehouse" value="1013"/>
                                            <label for="warehouse"><b>WAREHOUSE</b></label>
                                            <br>
                                            <i class="fas fa-warehouse fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="planning" id="planning" value="1010"/>
                                            <label for="planning"><b>PLANNING</b></label>
                                            <br>
                                            <i class="far fa-calendar-alt fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="it" id="it" value="1002"/>
                                            <label for="it"><b>IT</b></label>
                                            <br>
                                            <i class="fas fa-laptop fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="pu" id="pu" value="1004"/>
                                            <label for="pu"><b>PU</b></label>
                                            <br>
                                            <i class="far fa-money-bill-alt fa-2x"></i>
                                        </div>
                                    </div>

                                </div>
                            </div><hr>


                            <div class="form-row">
                                <div class="col-md-6"><input type="submit" name="save" class="btn btn-success btn-block"/></div>
                                <div class="col-md-6"><input type="reset" name="reset" class="btn btn-danger btn-block"/></div>
                            </div>


                        </div>
                    </form>

                </div><!-- END Section Main area  -->

            </div>

    </body>
</html>
