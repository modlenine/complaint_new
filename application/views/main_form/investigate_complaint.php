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
                        <div class="form-cp-main">
                            
                            <h3 style="text-align: center;padding:10px ;background-color: #33CC00;">Investigation : <?php echo $rs['cp_no']; ?></h3>
                            <div class="card border-light mb-3">
                                <div class="card-header"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Basic Information</b></h4></div>
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
                                            <label><?php echo $getuser['ecode']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label><b>Department :</b></label>
                                            <label><?php echo $getuser['Dept']; ?></label>
                                        </div>
                                        
                                        
                                        <div class="col-md-3">
                                            <label><b>Status :</b></label>
                                            <label><b style="color:blue;"><?php echo $rs['cp_status']; ?></b></label>
                                            <input type="text" name="status_check" id="status_check" hidden="" value="<?php echo $rs['cp_status']; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="card border-light mb-3">
                                <div class="card-header"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Priority</b></h4></div>
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
                            </div>
                            
<!-- *******Details of Complaint*********************Details of Complaint*********************Details of Complaint************ -->
                            <div class="card border-light mb-3">
                                <div class="card-header"><h4><b><i class="far fa-id-card"></i>&nbsp;&nbsp;Details of Complaint / Damages</b></h4></div>
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
                                            if($rs['cp_status']=="Investigating" || $rs['cp_status']=="Investigated" || $rs['cp_status']=="Normal Complaint" || $rs['cp_status']=="Close Complaint" || $rs['cp_status']=="Transfered To NC"){
                                                $detail_of_cp = ' readonly="" ';
                                            }else{
                                                $detail_of_cp = "";
                                            }
                                        ?>
                                    <div class="form-row">
                                        <div class="col-md-8 form-group">
                                            <label><b>Detail of complaint :</b></label>
                                            <textarea <?php echo $detail_of_cp; ?> class="form-control" rows="3" name="detail_of_complaint" id="detail_of_compltint"><?php echo $rs['cp_detail']; ?></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <?php foreach ($get_upload_file as $guf): ?>
                                            <label><b>Attached file :</b></label>
                                            <label><a href="http://192.190.10.27/complaint_new/asset/<?php echo $guf['file_name']; ?>" target="_blank"><?php echo $guf['file_name']; ?></a></label><br>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="col-md-3">

                                        </div>
                                    </div>
                                </div>
                            </div><hr>


<!-- *******Details of Complaint*********************Details of Complaint*********************Details of Complaint************ -->                                        
                                        
                                        

<!-- ************ Investigation **************** Investigation ************** Investigation ******* -->
                            <form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_detail_inves/<?php echo $rs['cp_no']; ?>">
                            <div class="card border-light mb-3 Investigation">
                                <div class="card-header"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Investigation</b></h4><br>
                                    <label><b>The relevant departments.</b></label>
                                    <?php foreach ($get_dept_name as $gdn): ?>
                                    &nbsp;&nbsp;<label><?php echo $gdn['Dept']; ?></label>&nbsp;&nbsp;
                                    <?php endforeach; ?>
                                </div>
                                <div class="card-body">
                                    
                                    
                                    <div class="form-row">
                                        <div class="col-md-8">
                                        <label><b>Detail of investigate</b></label>
                                        <?php 
                                            if($rs['cp_status']=="Investigated" || $rs['cp_status']=="Normal Complaint" || $rs['cp_status']=="Close Complaint" || $rs['cp_status']=="Transfered To NC"){
                                                $hh = ' readonly="" ';
                                            }else{
                                                $hh = "";
                                            }
                                        ?>
                                        <textarea <?php echo $hh; ?>  name="cp_detail_inves_detail" id="cp_detail_inves_detail" class="form-control" rows="3"><?php echo $rs['cp_detail_inves']; ?></textarea>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        
                                        <div class="col-md-2">
                                            <?php  
                                                if($rs['cp_status']=="Investigated" || $rs['cp_status']=="Normal Complaint" || $rs['cp_status']=="Close Complaint" || $rs['cp_status']=="Transfered To NC"){
                                            ?>
                                            <label><b>Signature :</b></label>
                                            <label><?php echo $rs['cp_detail_inves_signature']; ?></label>
                                            <input hidden="" type="text" name="cp_detail_inves_signature" id="cp_detail_inves_signature" value="<?php echo $rs['cp_detail_inves_signature']; ?>" />
                                            <?php }else{ ?>
                                            <label><b>Signature :</b></label>
                                            <label><?php echo $getuser['Fname']; ?></label>
                                            <input hidden="" type="text" name="cp_detail_inves_signature" id="cp_detail_inves_signature" value="<?php echo $getuser['Fname']; ?>" />
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php  
                                                if($rs['cp_status']=="Investigated" || $rs['cp_status']=="Normal Complaint" || $rs['cp_status']=="Close Complaint" || $rs['cp_status']=="Transfered To NC"){
                                            ?>
                                            <label><b>Department :</b></label>
                                            <label><?php echo $rs['cp_detail_inves_dept']; ?></label>
                                            <input hidden="" type="text" name="cp_detail_inves_dept" id="cp_detail_inves_dept" value="<?php echo $rs['cp_detail_inves_dept']; ?>" />
                                            <?php }else{ ?>
                                            <label><b>Department :</b></label>
                                            <label><?php echo $getuser['Dept']; ?></label>
                                            <input hidden="" type="text" name="cp_detail_inves_dept" id="cp_detail_inves_dept" value="<?php echo $getuser['Dept']; ?>" />
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php  
                                                if($rs['cp_status']=="Investigated" || $rs['cp_status']=="Normal Complaint" || $rs['cp_status']=="Close Complaint" || $rs['cp_status']=="Transfered To NC"){
                                            ?>
                                            <label><b>Date :</b></label>
                                            <label><?php echo $rs['cp_detail_inves_date']; ?></label>
                                            <input hidden="" type="text" name="cp_detail_inves_date" id="cp_detail_inves_date" value="<?php echo $rs['cp_detail_inves_date']; ?>" />
                                            <?php }else{ ?>
                                            <label><b>Date :</b></label>
                                            <label><?php echo date('d/m/Y'); ?></label>
                                            <input hidden="" type="text" name="cp_detail_inves_date" id="cp_detail_inves_date" value="<?php echo date('d/m/Y'); ?>" />
                                            <?php } ?>
                                        </div>
                                    </div><hr>
                                    
                                    <!-- Check permission for show or hide start investigate button -->
                                    <?php if($rs['cp_status']=="Investigating" && $getuser['username'] != $rs['cp_user_name'] ){ ?>
                                    <div class="col-md-4"><input type="submit" name="save" id="save" value="Submit" class="btn btn-primary btn-block"/></div>
                                    <?php }else{} ?>
                                </div>
                            </div>
                                </form>
<!-- *********Investigation******************Investigation****************Investigation*************** -->


<!-- ********Summary of Investigation***************Summary of Investigation************************Summary of Investigation********* -->
                            <form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_sum_of_inves/<?php echo $rs['cp_no']; ?>">
                            <div class="card border-light mb-3 Summary">
                                <div class="card-header"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Summary of Investigation</b></h4><br>
                                <label><b>The relevant departments. QMR</b></label>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="form-row">
                                        <div class="col-md-8">
                                        <?php if($rs['cp_sum_inves']!=""){ 
                                            $sum_detail = ' readonly="" ';
                                        ?>
                                            
                                        <label><b>Summary of Investigation</b></label>
                                        <textarea <?php echo $sum_detail; ?> name="cp_sum_inves_detail" id="cp_detail_inves_detail" class="form-control" rows="3"><?php echo $rs['cp_sum_inves']; ?></textarea>
                                        <?php }else{ ?>
                                        <textarea name="cp_sum_inves_detail" id="cp_detail_inves_detail" class="form-control" rows="3"></textarea>
                                        <?php } ?>
                                        </div>
                                        
                                    </div><br>
                                    
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <?php if($rs['cp_sum_inves']!=""){ ?>
                                            <label><b>Signature :</b></label>
                                            <label><?php echo $rs['cp_sum_inves_signature']; ?></label>
                                            <input hidden="" type="text" name="cp_sum_inves_signature" id="cp_detail_inves_signature" value="<?php echo $rs['cp_sum_inves_signature']; ?>" />
                                            
                                            <?php }else{ ?>
                                            <label><b>Signature :</b></label>
                                            <label><?php echo $getuser['Fname']; ?></label>
                                            <input hidden="" type="text" name="cp_sum_inves_signature" id="cp_detail_inves_signature" value="<?php echo $getuser['Fname']; ?>" />
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php if($rs['cp_sum_inves']!=""){ ?>
                                            <label><b>Department :</b></label>
                                            <label><?php echo $rs['cp_sum_inves_dept']; ?></label>
                                            <input hidden="" type="text" name="cp_sum_inves_dept" id="cp_detail_inves_dept" value="<?php echo $rs['cp_sum_inves_dept']; ?>" />
                                            
                                            <?php }else{ ?>
                                            <label><b>Department :</b></label>
                                            <label><?php echo $getuser['Dept']; ?></label>
                                            <input hidden="" type="text" name="cp_sum_inves_dept" id="cp_detail_inves_dept" value="<?php echo $getuser['Dept']; ?>" />
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php if($rs['cp_sum_inves']!=""){ ?>
                                            <label><b>Date :</b></label>
                                            <label><?php echo $rs['cp_sum_inves_date']; ?></label>
                                            <input hidden="" type="text" name="cp_sum_inves_date" id="cp_detail_inves_date" value="<?php echo $rs['cp_sum_inves_date']; ?>" />
                                            
                                            <?php }else{ ?>
                                            <label><b>Date :</b></label>
                                            <label><?php echo date('d/m/Y'); ?></label>
                                            <input hidden="" type="text" name="cp_sum_inves_date" id="cp_detail_inves_date" value="<?php echo date('d/m/Y'); ?>" />
                                            <?php } ?>
                                        </div>
                                    </div><br>
                                    

                                    
                                    <div class="form-row">
                                            <?php if($rs['cp_sum_inves']!="" && $rs['cp_sum']=="no"){ ?>
                                        
                                        <div class="col-md-2">
                                            <label><b>ไม่เป็นข้อบกพร่องของบริษัท :</b></label>
                                            <input type="radio" id="cp_sum" name="cp_sum" checked=""/>
                                        </div>
                                        <div class="col-md-2">
                                            <label><b>เป็นข้อบกพร่องของบริษัท :</b></label>
                                            <input type="radio" id="cp_sum" name="cp_sum" />
                                        </div>
                                        
                                            <?php }else if ($rs['cp_sum_inves']!="" && $rs['cp_sum']=="yes"){ ?>
                                        <div class="col-md-2">
                                            <label><b>ไม่เป็นข้อบกพร่องของบริษัท :</b></label>
                                            <input type="radio" id="cp_sum" name="cp_sum" />
                                        </div>
                                        <div class="col-md-2">
                                            <label><b>เป็นข้อบกพร่องของบริษัท :</b></label>
                                            <input type="radio" id="cp_sum" name="cp_sum" checked=""/>
                                        </div> 
                                            <?php }else{ ?>
                                        <div class="col-md-2">
                                            <label><b>ไม่เป็นข้อบกพร่องของบริษัท :</b></label>
                                            <input type="radio" id="cp_sum" name="cp_sum" value="no"/>
                                        </div>
                                        <div class="col-md-2">
                                            <label><b>เป็นข้อบกพร่องของบริษัท :</b></label>
                                            <input type="radio" id="cp_sum" name="cp_sum" value="yes"/>
                                        </div>
                                            <?php } ?>
                                    </div><hr>
                                    
                                                                     
     <!-- ************************************************************************************************* -->                              
                                    <div class="card border-light mb-3 transfer">
                                <div class="card-header"><h4><b><i class="fas fa-envelope-open"></i>&nbsp;&nbsp;Related Department</b></h4></div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="lab_sum" id="lab_sum" value="1015"/>
                                            <label for="lab"><b>LAB</b></label>
                                            <br>
                                            <i for="lab" class="fas fa-flask fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="admin_sum" id="admin_sum" value="1001"/>
                                            <label for="admin"><b>ADMIN</b></label>
                                            <br>
                                            <i class="fas fa-building fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="hr_sum" id="hr_sum" value="1005"/>
                                            <label for="hr"><b>HR</b></label>
                                            <br>
                                            <i class="fas fa-male fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="account_sum" id="account_sum" value="1003"/>
                                            <label for="ac"><b>ACCOUNT & FINANCE</b></label>
                                            <br>
                                            <i class="fas fa-hand-holding-usd fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="qc_sum" id="qc_sum" value="1014"/>
                                            <label for="qc"><b>QC</b></label>
                                            <br>
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="maintenance_sum" id="maintenance_sum" value="1009"/>
                                            <label for="maintenance"><b>MAINTENANCE</b></label>
                                            <br>
                                            <i class="fas fa-screwdriver fa-2x"></i>
                                        </div>
                                    </div><br>
                                    <div class="form-row">
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="pd_sum" id="pd_sum" value="1007"/>
                                            <label for="pd"><b>PD</b></label>
                                            <br>
                                            <i class="fas fa-industry fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="sales_sum" id="sales_sum" value="1006"/>
                                            <label for="sales"><b>SALES</b></label>
                                            <br>
                                            <i class="fas fa-hand-holding-usd fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="warehouse_sum" id="warehouse_sum" value="1013"/>
                                            <label for="warehouse"><b>WAREHOUSE</b></label>
                                            <br>
                                            <i class="fas fa-warehouse fa-2x"></i>
                                        </div>

                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="planning_sum" id="planning_sum" value="1010"/>
                                            <label for="planning"><b>PLANNING</b></label>
                                            <br>
                                            <i class="far fa-calendar-alt fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="it_sum" id="it_sum" value="1002"/>
                                            <label for="it"><b>IT</b></label>
                                            <br>
                                            <i class="fas fa-laptop fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 new_center_text">
                                            <input type="checkbox" name="qmr_sum" id="qmr_sum" value="1099"/>
                                            <label for="it"><b>QMR</b></label>
                                            <br>
                                            <i class="fas fa-laptop fa-2x"></i>
                                        </div>
                                    </div>

                                </div>
                            </div><hr>
   <!-- ************************************************************************************************* -->
                                    
                                    
                                    <?php  
                                        if($getuser['Dept']== "QMR" && $rs['cp_sum_inves']==""){    
                                    ?>
                                    <div class="col-md-4"><input type="submit" name="sum_btn_save" id="sum_btn_save" value="Submit" class="btn btn-primary btn-block"/></div>
                                        <?php 
                                            
                                            }else{ ?>
                                    
                                        <?php } ?>
                                </div>
                            </div>
                                </form>
<!-- ******Summary of Investigation************************Summary of Investigation**********************Summary of Investigation*********** -->


<!-- ************ Conclusion of complaint **************** Conclusion of complaint ************** Conclusion of complaint ******* -->
                            <form name="invesform" method="post" action="<?php echo base_url(); ?>complaint/add_conclusion/<?php echo $rs['cp_no']; ?>">
                            <div class="card border-light mb-3 Conclusion">
                                <div class="card-header"><h4><b><i class="fas fa-flag"></i>&nbsp;&nbsp;Conclusion of Complaint</b></h4><br>
                                    <label><b>The relevant departments. QMR</b></label><br>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <?php 
                                            if($rs['cp_status']== "Close Complaint"){
                                        ?>
                                        <div class="col-md-8">
                                        <label><b>Conclusion of Complaint</b></label>
                                        <textarea readonly="" name="cp_conclu_detail" id="cp_conclu_detail" class="form-control" rows="3"><?php echo $rs['cp_conclu_detail'] ?></textarea>
                                        </div>
                                            <?php  }else{ ?>
                                        <div class="col-md-8">
                                        <label><b>Conclusion of Complaint</b></label>
                                        <textarea name="cp_conclu_detail" id="cp_conclu_detail" class="form-control" rows="3"></textarea>
                                        </div>
                                            <?php  } ?>
                                        
                                    </div><br>
                                    <div class="form-row">
                                        
                                        <div class="col-md-2">
                                            <?php  
                                                if($rs['cp_status']=="Close Complaint"){
                                            ?>
                                            <label><b>Signature :</b></label>
                                            <label><?php echo $rs['cp_conclu_signature']; ?></label>
                                            <input hidden="" type="text" name="cp_conclu_signature" id="cp_conclu_signature" value="<?php echo $rs['cp_conclu_signature']; ?>" />
                                            <?php }else{ ?>
                                            <label><b>Signature :</b></label>
                                            <label><?php echo $getuser['Fname']; ?></label>
                                            <input hidden="" type="text" name="cp_conclu_signature" id="cp_conclu_signature" value="<?php echo $getuser['Fname']; ?>" />
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php  
                                                if($rs['cp_status']=="Close Complaint"){
                                            ?>
                                            <label><b>Department :</b></label>
                                            <label><?php echo $rs['cp_conclu_dept']; ?></label>
                                            <input hidden="" type="text" name="cp_conclu_dept" id="cp_conclu_dept" value="<?php echo $rs['cp_conclu_dept']; ?>" />
                                            <?php }else{ ?>
                                            <label><b>Department :</b></label>
                                            <label><?php echo $getuser['Dept']; ?></label>
                                            <input hidden="" type="text" name="cp_conclu_dept" id="cp_conclu_dept" value="<?php echo $getuser['Dept']; ?>" />
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?php  
                                                if($rs['cp_status']=="Close Complaint"){
                                            ?>
                                            <label><b>Date :</b></label>
                                            <label><?php echo $rs['cp_conclu_date']; ?></label>
                                            <input hidden="" type="text" name="cp_conclu_date" id="cp_conclu_date" value="<?php echo $rs['cp_conclu_date']; ?>" />
                                            <?php }else{ ?>
                                            <label><b>Date :</b></label>
                                            <label><?php echo date('d/m/Y'); ?></label>
                                            <input hidden="" type="text" name="cp_conclu_date" id="cp_conclu_date" value="<?php echo date('d/m/Y'); ?>" />
                                            <?php } ?>
                                        </div>
                                    </div><hr>
                                    
                                    <?php  
                                        if($getuser['Dept']== "QMR"){    
                                    ?>
                                    <div class="col-md-4"><input type="submit" name="comclusion_btn_save" id="comclusion_btn_save" value="Submit" class="btn btn-primary btn-block"/></div>
                                        <?php 
                                            
                                            }else{ ?>
                                    
                                        <?php } ?>
                                </div>
                            </div>
                                </form>
<!-- *********Conclusion of complaint******************Conclusion of complaint****************Conclusion of complaint*************** -->

                        </div>

                </div><!-- END Section Main area  -->

            </div>

    </body>
</html>
