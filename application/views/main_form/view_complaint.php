<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php  
    if($rs['cp_status']!="New Complaint"){
        redirect('/complaint/investigation/'.$rs['cp_no']);
    }
?>
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


                        <div class="form-cp-main">
                            <h3 style="text-align: center;padding:10px ;">View Complaint Form : <?php echo $rs['cp_no']; ?></h3>

                            <div class="card border-info mb-3">
                                <div class="card-header bg_blue"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Basic Information</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label><b>ID :</b></label>
                                            <label><?php echo $rs['cp_no']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Date :</b></label>
                                            <label><?php echo date('d/m/Y'); ?></label>
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
                                            <label><b>Topic :</b></label>
                                            <label id="cp_topic"><?php echo $rs['cp_topic']; ?></label>
                                        </div>
                                        

                                        <div class="col-md-3">
                                            <label><b>Catagory :</b></label>
                                            <label><?php echo $rs['cp_topic_cat']; ?></label>
                                            <input type="text" name="cp_topic_cat" id="cp_topic_cat" hidden="" value="<?php echo $rs['cp_topic_cat']; ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label><b>Complaint Person :</b></label>
                                            <label><?php echo $rs['cp_user_name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Employee ID :</b></label>
                                            <label><?php echo $rs['cp_user_empid']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Department :</b></label>
                                            <label><?php echo $rs['cp_user_dept']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Status :</b></label>
                                            <label><b style="color:blue;"><?php echo $rs['cp_status']; ?></b></label>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            
                            
                            <div class="card border-info mb-3">
                                <div class="card-header bg_blue"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Priority</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label><b>Customer Satisfaction</b></label>
                                            <label><?php echo $editpriority1['cp_pri_use_name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Production Loss</b></label>
                                            <label><?php echo $editpriority2['cp_pri_use_name']; ?></label>
                                            </div>
                                        <div class="col-md-3">
                                            <label><b>Business Disruption</b></label>
                                            <label><?php echo $editpriority3['cp_pri_use_name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Machinery performance</b></label>
                                            <label><?php echo $editpriority4['cp_pri_use_name']; ?></label>
                                        </div>
                                    </div><br>
                                    
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label><b>The image of enterprise</b></label>
                                            <label><?php echo $editpriority5['cp_pri_use_name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Complaints</b></label>
                                            <label><?php echo $editpriority6['cp_pri_use_name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Impact on personal</b></label>
                                            <label><?php echo $editpriority7['cp_pri_use_name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Summary Score</b></label>
                                            <label><?php echo $rs['cp_priority']; ?></label>
                                        </div>
                                        
                                    </div><br>
                                    
                                    
                                </div>
                            </div><br>
                            
                            <script>
                                            $(document).ready(function () {
//                                                $("#cp_topic").change(function(){
                                                    var value = $("#cp_topic_cat").val();
                                        if (value == "Safety" || value=="System" || value=="Environment"){
                                            
                                            $('#h_username').hide();
                                            $('#h_cusref').hide();
                                            $('#h_inv').hide();
                                            $('#h_procode').hide();
                                            $('#h_lotno').hide();
                                            $('#h_qty').hide();
                                        }else{
                                            $('#h_username').show();
                                            $('#h_cusref').show();
                                            $('#h_inv').show();
                                            $('#h_procode').show();
                                            $('#h_lotno').show();
                                            $('#h_qty').show();
                                        }
//                                                });
                                            });
                                        </script>

                            <div class="card border-info mb-3">
                                <div class="card-header bg_blue"><h4><b><i class="far fa-id-card"></i>&nbsp;&nbsp;Details of Complaint / Damages</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-3" id="h_username">
                                            <label><b>Customer Name :</b></label>
                                            <label><?php echo $rs['cp_cus_name']; ?></label>
                                        </div>

                                        <div class="col-md-3" id="h_cusref">
                                            <label><b>Customer Ref. :</b></label>
                                            <label><?php echo $rs['cp_cus_ref']; ?></label>
                                        </div>

                                        <div class="col-md-3" id="h_inv">
                                            <label><b>Invoice Number :</b></label>
                                            <label><?php echo $rs['cp_invoice_no']; ?></label>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3" id="h_procode">
                                            <label><b>Product Code :</b></label>
                                            <label><?php echo $rs['cp_pro_code']; ?></label>
                                        </div>

                                        <div class="col-md-3" id="h_lotno">
                                            <label><b>Lot No. :</b></label>
                                            <label><?php echo $rs['cp_pro_lotno']; ?></label>
                                        </div>

                                        <div class="col-md-3" id="h_qty">
                                            <label><b>Quantity :</b></label>
                                            <label><?php echo $rs['cp_pro_qty']; ?></label>
                                        </div>
                                    </div>
                                    <?php  
                                        if($rs['cp_status']== "New Complaint"){
                                            $rr = 'readonly=""';
                                        }else{
                                            $rr = "";
                                        }
                                    ?>
                                    <div class="form-row">
                                        <div class="col-md-8 form-group">
                                            <label><b>Detail of complaint :</b></label>
                                            <textarea <?php echo $rr; ?> class="form-control" rows="3" name="detail_of_complaint" id="detail_of_compltint"><?php echo $rs['cp_detail']; ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <?php foreach ($get_upload_file as $guf): ?>
                                            <label><b>Attached file :</b></label>
                                            <label><a href="http://192.190.10.27/complaint_new/asset/<?php echo $guf['file_name']; ?>" target="_blank"><?php echo $guf['file_name']; ?></a></label><br>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Related Department.</b></label>
                                    <?php foreach ($get_dept_name as $gdn): ?>
                                    &nbsp;&nbsp;<label><?php echo $gdn['Dept']; ?></label>&nbsp;&nbsp;
                                    
                                    <?php endforeach; ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div><hr>
                            
                            <!-- Check permission for show or hide start investigate button -->
                            <?php 
                            $ckd_result = 0;
                        foreach ($check_dept as $ckd){
                            if($ckd['cp_dept_code'] !== $getuser['DeptCode']){
                                continue;
                            }
                            $ckd_result =1 ;
                        }
                            ?>
                            
                            <input hidden="" type="text" name="check_dept_view" id="check_dept_view" value="<?php echo $ckd_result;?>" />
                            
                            <div><a href="<?php echo base_url(); ?>complaint/inves_starting/<?php echo $rs['cp_no']; ?>"><button name="btn_v_cp" id="btn_v_cp" onclick="javascript:return confirm('คุณต้องการเริ่มการสืบสวนใช่หรือไม่');" class="btn btn-primary">Start Investigation</button></a></div>
                            
                             <!-- Check permission for show or hide start investigate button -->
                            <hr>
                            
<!--                            <div class="card border-light mb-3 doi">
                                <div class="card-header"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Detail of Investigate</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        
                                    </div>
                                </div>
                            </div>-->




                        </div><br>

                </div><!-- END Section Main area  -->

            </div>

    </body>
</html>
