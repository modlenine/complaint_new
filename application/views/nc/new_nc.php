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
                    <h1 style="text-align: center;width: 80%;">ใบรายงานปัญหา / ข้อบกพร่อง NC</h1><hr>
                    <div class="card border-info mb-3" style="max-width: 80%;">
                        <div class="card-header">1. รายละเอียดปัญหา/ข้อบกพร่อง สำหรับผู้พบปัญหา</div>
                        <div class="card-body text-info">
                            <h5 class="card-title">เรียน ผู้จัดการฝ่าย xxx</h5><br>
                            <p class="card-text"><span><strong>Transfrom Complaint NO.</strong>&nbsp;<a href='http://192.190.10.27/complaint_new/complaint/investigation/<?php echo $rs['cp_no']; ?>'><?php echo $rs['cp_no']; ?></a></span></p>

                            <p class="card-text"><span><strong>Details Of Complaint / Damages : </strong></span><span class="nc_color_font"><?php echo $rs['cp_detail']; ?></span></p>
                            <p class="card-text"><span><strong>Details Of Investigate : </strong></span><span class="nc_color_font"><?php echo $rs['cp_detail_inves']; ?></span></p>
                            <p class="card-text"><span><strong>Summary of Investigation : </strong></span><span class="nc_color_font"><?php echo $rs['cp_sum_inves']; ?></span></p>


                            <p class="card-text">
                                <?php foreach ($get_upload_file as $guf): ?>
                                    <span><strong>เอกสารประกอบ : </strong></span><label><a href="http://192.190.10.27/complaint_new/asset/<?php echo $guf['file_name']; ?>" target="_blank"><?php echo $guf['file_name']; ?></a></label><br>
                                <?php endforeach; ?>
                            </p>


                            <hr>
                            <p class="card-text"><span><strong>ผู้แจ้ง :</strong></span><span class="nc_color_font"><?php echo $rs['cp_user_name']; ?></span>&nbsp;<span><strong>วันที่แจ้ง :</strong></span><span class="nc_color_font"><?php echo $rs['cp_date']; ?></span> | <span><strong>ผู้อนุมัติ :</strong></span><span class="nc_color_font"><?php echo $rs['cp_sum_inves_signature']; ?></span>&nbsp;<span><strong>วันที่อนุมัติ :</strong></span><span class="nc_color_font"><?php echo $rs['cp_sum_inves_date']; ?></span></p>
                        </div>
                    </div>

                    <div class="card border-success mb-3" style="max-width: 80%;">
                        <div class="card-header">2. สำหรับฝ่ายบริหาร (พิจารณาและกำหนดฝ่ายที่รับผิดชอบ แล้วส่งให้ MR. ดำเนินการ)</div>
                        <div class="card-body text-success">
                            <p class="card-text"><span><strong>ฝ่ายที่รับผิดชอบในการปฎิบัติการแก้ไขและป้องกันปัญหา ได้แก่ </strong>
                                    <?php foreach ($get_rela_dept->result() as $grd): ?>
                                        <span class="nc_color_font"><?php echo $grd->cp_dept_main_name; ?></span>
                                    <?php endforeach; ?>   
                                </span></p>
                            <p class="card-text"><span><strong>ลงชื่อฝ่ายบริหาร : </strong></span><span class="nc_color_font"><?php echo $rs['cp_sum_inves_signature']; ?></span><span>&nbsp;<strong>วันที่</strong>&nbsp;</span><span class="nc_color_font"><?php echo $rs['cp_sum_inves_date']; ?></span></p>
                        </div>
                    </div>


                    <!-- ************************ Zone3 ***************************** -->                          
                    <form name="zone3" action="<?php echo base_url(); ?>nc/save_nc_zone3/<?php echo $rs['cp_no']; ?>" method="post" enctype="multipart/form-data"> 

                        <input type="text" name="nc_id" id="nc_id" hidden="" value="<?php echo $rs['cp_no']; ?>"/>


                        <div class="card border-info mb-3" style="max-width: 80%;">
                            <div class="card-header">3. สำหรับฝ่ายที่รับผิดชอบให้หาสาเหตุ. วิธีแก้ไขและป้องกันและกำหนดแผนการปฎิบัติการแก้ไข</div>
                            <div class="card-body text-info">

                                <div class="col-md-12">
                                    <div class="row">


                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12 card-text"><p class=""><span>3.1 สาเหตุ</span><br>
                                                        <?php if ($get_nc['nc_motive'] == "") { ?>
                                                            <textarea rows='5' class="form-control" name='nc_motive' id="nc_motive"></textarea>
                                                        <?php } else { ?>  
                                                            <textarea readonly="" rows='5' class="form-control" name='nc_motive' id="nc_motive"><?php echo $get_nc['nc_motive']; ?></textarea>
                                                        <?php } ?>
                                                    </p></div><br>


                                                <div class="col-md-12 card-text"><p class=""><span>3.2 วิธีแก้ไข</span><br>
                                                        <?php if ($get_nc['nc_corrective'] == "") { ?>
                                                            <textarea rows='5' class="form-control" name='nc_corrective' id="nc_corrective"></textarea>
                                                    <div class="form-inline"><label class="form-group">กำหนดเสร็จ :</label>&nbsp;<input type="date" name="nc_corrective_date" id="nc_corrective_date" class="form-control form-group"/></div>
                                                    <?php } else { ?>
                                                        <textarea readonly="" rows='5' class="form-control" name='nc_corrective' id="nc_corrective"><?php echo $get_nc['nc_corrective']; ?></textarea>
                                                        <div class="form-inline"><label class="form-group">กำหนดเสร็จ :</label>&nbsp;<input readonly="" value="<?php echo $get_nc['nc_corrective_date']; ?>" type="date" name="nc_corrective_date" id="nc_corrective_date" class="form-control form-group"/></div>
                                                    <?php } ?>


                                                    </p></div><br>

                                                <div class="col-md-12 card-text"><p class="card-text"><span>3.3 วิธีป้องกัน</span><br>

                                                        <?php if ($get_nc['nc_preventive'] == "") { ?>
                                                            <textarea rows='5' class="form-control" name='nc_preventive' id="nc_preventive"></textarea>
                                                    <div class="form-inline"><label class="form-group">กำหนดเสร็จ :</label>&nbsp;<input type="date" name="nc_preventive_date" id="nc_preventive_date" class="form-control form-group" /></div>
                                                    <?php } else { ?>
                                                        <textarea readonly="" rows='5' class="form-control" name='nc_preventive' id="nc_preventive"><?php echo $get_nc['nc_preventive']; ?></textarea>
                                                        <div class="form-inline"><label class="form-group">กำหนดเสร็จ :</label>&nbsp;<input readonly="" value="<?php echo $get_nc['nc_preventive_date']; ?>" type="date" name="nc_preventive_date" id="nc_preventive_date" class="form-control form-group" /></div>
                                                    <?php } ?>



                                                    </p></div>

                                                <div class="col-md-12">
                                                    <label>ผู้รับผิดชอบ : </label>&nbsp;<label class="nc_color_font"><?php echo $getuser['username']; ?></label>&nbsp;<label>วันที่ : &nbsp;</label><label class="nc_color_font"><?php echo date("d-m-Y") ?></label>
                                                    <input type="text" name="nc_owner" id="nc_owner" hidden="" />
                                                </div>
                                                <div class="col-md-12 btn3">
                                                    <input type="submit" name="btn3" id="btn3" class="btn btn-primary"/>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- ************************ Zone3 ***************************** -->  

                                        <!--          <div class="col-md-6">
                                                      <div class="row">
                                                          <div class="col-md-12 card-text"><p class=""><span>3.1 สาเหตุ</span><br>
                                                          <textarea rows='5' class="form-control" name='cause_text' id="cause_text"></textarea>
                                                      </p></div><br>
                                                           
                                        
                                              <div class="col-md-12 card-text"><p class=""><span>3.2 วิธีแก้ไข</span><br>
                                                      <textarea rows='5' class="form-control" name='edit_text' id="edit_text"></textarea>
                                                  <div class="form-inline"><label class="form-group">กำหนดเสร็จ :</label>&nbsp;<input type="date" name="end_date1" class="form-control form-group"/></div>
                                                  </p></div><br>
                                              
                                              <div class="col-md-12 card-text"><p class=""><span>3.3 วิธีป้องกัน</span><br>
                                                      <textarea rows='5' class="form-control" name='protect_text' id="protect_text"></textarea>
                                                  <div class="form-inline"><label class="form-group">กำหนดเสร็จ :</label>&nbsp;<input type="date" name="end_date2" class="form-control form-group" /></div>
                                              </p></div>
                                                  
                                                  <div class="col-md-12">
                                                      <label>ผู้รับผิดชอบ : </label>&nbsp;<label><?php echo date("d-m-Y") ?></label>
                                                  </div>
                                                      </div>
                                                  </div>-->
                                    </div>


                                </div>   

                            </div>
                        </div>

                    </form>


                    <div class="card border-success mb-3 zone4" style="max-width: 80%;">
                        <div class="card-header">4. สำหรับฝ่ายที่เกี่ยวข้อง (เพื่อติดตามและปิดสรุป)</div>
                        <div class="card-body text-success">

                            <!-- **********************Follow up 1***************************************** -->
                            <form name="follow1" action="<?php echo base_url(); ?>nc/save_nc_follow1/<?php echo $rs['cp_no']; ?>" method="post" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <p class="card-text">ผลการติดตามครั้งที่ 1</p>

                                    <?php if ($get_nc['nc_followup1'] == "") { ?>

                                        <p><textarea class="form-control" rows='5' name='followup1_text' id="followup1_text"></textarea></p>
                                        <p><label>เอกสารประกอบ :</label><input name="file_follow1" id="file_follow1" type="file" class="form-control form-control-sm"/></p>
                                        <p><label>ปิดสรุป : </label><input type="radio" name="followup1_radio" id="followup1_radio" value="0"/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup1_radio" id="followup1_radio" value="1"/></p>
                                        <div class="form-inline"><label class="form-group">กำหนดติดตามผลครั้งที่ 2 :</label>&nbsp;<input type="date" name="followup1_date" id="followup1_date" class="form-group form-control" /></div>
                                        <p><input type="submit" name="btn-follow1" id="btn-follow1" class="btn btn-primary"/></p>

                                    <?php } else { ?>

                                        <p><textarea readonly="" class="form-control" rows='5' name='followup1_text' id="followup1_text"><?php echo $get_nc['nc_followup1']; ?></textarea></p>
                                        <p><label>เอกสารประกอบ :</label><label><a href="<?php echo base_url(); ?>asset/nc/<?php echo $get_nc['nc_followup1_file']; ?>" target="_blank"><?php echo $get_nc['nc_followup1_file']; ?></a></label></p>

                                        <?php if ($get_nc['nc_followup1_status'] == 1) { ?>
                                            <p><label>ปิดสรุป : </label><input type="radio" name="followup1_radio" id="followup1_radio" />&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup1_radio" id="followup1_radio"  checked=""/></p>
                                        <?php } else { ?>
                                            <p><label>ปิดสรุป : </label><input type="radio" name="followup1_radio" id="followup1_radio"  checked=""/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup1_radio" id="followup1_radio" /></p>
                                        <?php } ?>

                                        <div class="form-inline"><label class="form-group">กำหนดติดตามผลครั้งที่ 2 :</label>&nbsp;<input readonly="" type="date" name="followup1_date" id="followup1_date" class="form-group form-control" value="<?php echo $get_nc['nc_followup1_date']; ?>"/></div>

                                    <?php } ?>

                                </div><hr>
                            </form>
                            <!-- **********************Follow up 1***************************************** -->



                            <!-- **********************Follow up 2***************************************** -->

                            <form name="follow2" action="<?php echo base_url(); ?>nc/save_nc_follow2/<?php echo $rs['cp_no']; ?>" method="post" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <p class="card-text">ผลการติดตามครั้งที่ 2</p>

                                    <?php if ($get_nc['nc_followup2'] == "") { ?>
                                            <?php if($get_nc['nc_followup1'] == "" || $get_nc['nc_followup1_status'] == 0){
                                                $read = ' readonly="" ';
                                                $hidden = ' hidden="" ';
                                                
                                            }else{
                                                $read = '';
                                                $hidden = '';
                                            }
                                            ?>
                                        <p><textarea class="form-control" rows='5' name='followup2_text' id="followup2_text" <?php echo $read; ?>></textarea></p>
                                        <p><label>เอกสารประกอบ :</label><input <?php echo $read; ?> name="file_follow2" id="file_follow2" type="file" class="form-control form-control-sm"/></p>
                                        <p><label>ปิดสรุป : </label><input type="radio" name="followup2_radio" id="followup2_radio" value="0"/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup2_radio" id="followup2_radio" value="1"/></p>
                                        <div class="form-inline"><label class="form-group">กำหนดติดตามผลครั้งที่ 3 :</label>&nbsp;<input <?php echo $read ?> type="date" name="followup2_date" id="followup2_date" class="form-group form-control" /></div>
                                        <p><input <?php echo $hidden; ?> type="submit" name="btn-follow2" id="btn-follow2" class="btn btn-primary"/></p>

                                    <?php } else { ?>
                                        <p><textarea readonly="" class="form-control" rows='5' name='followup2_text' id="followup2_text"><?php echo $get_nc['nc_followup2']; ?></textarea></p>
                                        <p><label>เอกสารประกอบ :</label><label><a href="<?php echo base_url(); ?>asset/nc/<?php echo $get_nc['nc_followup2_file']; ?>" target="_blank"><?php echo $get_nc['nc_followup2_file']; ?></a></label></p>
                                        
                                        <?php if($get_nc['nc_followup2_status'] == 1){ ?>
                                        <p><label>ปิดสรุป : </label><input type="radio" name="followup2_radio" id="followup2_radio"/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup2_radio" id="followup2_radio" checked=""/></p>
                                        <?php }else{ ?>
                                        <p><label>ปิดสรุป : </label><input type="radio" name="followup2_radio" id="followup2_radio" checked=""/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup2_radio" id="followup2_radio"/></p>
                                        <?php } ?>
                                        
                                        <div class="form-inline"><label class="form-group">กำหนดติดตามผลครั้งที่ 3 :</label>&nbsp;<input readonly="" type="date" name="followup2_date" id="followup2_date" class="form-group form-control" value="<?php echo $get_nc['nc_followup2_date']; ?>"/></div>
                                        
                                    <?php } ?>



                                </div><hr>
                            </form>
                            <!-- **********************Follow up 2***************************************** -->



                            <!-- **********************Follow up 3***************************************** --> 
                            <form name="follow3" action="<?php echo base_url(); ?>nc/save_nc_follow3/<?php echo $rs['cp_no']; ?>" method="post" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <p class="card-text">ผลการติดตามครั้งที่ 3</p>
                                    
                                    <?php if ($get_nc['nc_followup3'] == "") { ?>
                                    <?php if($get_nc['nc_followup2'] == "" || $get_nc['nc_followup2_status'] == 0){
                                                $read2 = ' readonly="" ';
                                                $hidden2 = ' hidden="" ';
                                                
                                            }else{
                                                $read2 = '';
                                                $hidden2 = '';
                                            }
                                            ?>
                                    <p><textarea class="form-control" rows='5' name='followup3_text' id="followup3_text" <?php echo $read2; ?>></textarea></p>
                                    <p><label>เอกสารประกอบ :</label><input <?php echo $read2; ?> name="file_follow3" id="file_follow3" type="file" class="form-control form-control-sm"/></p>
                                    <p><label>ปิดสรุป : </label><input type="radio" name="followup3_radio" id="followup3_radio" value="0"/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup3_radio" id="followup3_radio" value="1"/></p>
                                    <p><input <?php echo $hidden2; ?> type="submit" name="btn-follow3" id="btn-follow3" class="btn btn-primary"/></p>
                                    
                                    <?php }else{ ?>
                                    <p><textarea readonly="" class="form-control" rows='5' name='followup3_text' id="followup3_text"><?php echo $get_nc['nc_followup3']; ?></textarea></p>
                                    <p><label>เอกสารประกอบ :</label><label><a href="<?php echo base_url(); ?>asset/nc/<?php echo $get_nc['nc_followup3_file']; ?>" target="_blank"><?php echo $get_nc['nc_followup3_file']; ?></a></label></p>
                                    <?php if($get_nc['nc_followup3_status'] == 1){ ?>
                                    <p><label>ปิดสรุป : </label><input type="radio" name="followup3_radio" id="followup3_radio"/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup3_radio" id="followup3_radio" checked=""/></p>
                                    <?php }else{ ?>
                                    <p><label>ปิดสรุป : </label><input type="radio" name="followup3_radio" id="followup3_radio" checked=""/>&nbsp;&nbsp;<label>ไม่ปิดสรุป : </label><input type="radio" name="followup3_radio" id="followup3_radio" /></p>
                                    <?php } ?>
                                    
                                    <?php } ?>
                                    
                                    
                                    
                                </div><hr>
                            </form>
                            <!-- **********************Follow up 3***************************************** -->

                        </div><!-- Card body -->
                    </div><!-- Main Card -->

                    <?php if($get_nc['nc_followup3_status'] == 1){
                        $weak = " ( Weak ! ) ";
                    }else{ $weak = "" ;} ?>
                    
                    <?php  
                        if($get_nc['nc_followup1_status'] == ""){
                            $read3 = ' readonly="" ';
                            $hidden3 = ' hidden="" ';
                        }else if ($get_nc['nc_followup1_status'] == 0){
                            $read3 = '';
                            $hidden3 = '';
                        }else if ($get_nc['nc_followup1_status'] == 1 && $get_nc['nc_followup2_status'] == ""){
                            $read3 = ' readonly="" ';
                            $hidden3 = ' hidden="" ';
                        }else if ($get_nc['nc_followup1_status'] == 1 && $get_nc['nc_followup2_status'] == 0){
                            $read3 = '';
                            $hidden3 = '';
                        }else if ($get_nc['nc_followup1_status'] == 1 && $get_nc['nc_followup2_status'] == 1 && $get_nc['nc_followup3_status'] == ""){
                            $read3 = ' readonly="" ';
                            $hidden3 = ' hidden="" ';
                        }else if ($get_nc['nc_followup3_status'] == 0 || $get_nc['nc_followup3_status'] == 1){
                            $read3 = '';
                            $hidden3 = '';
                        }
                    ?>
                    <form name="nc_conclusion" action="<?php echo base_url(); ?>nc/save_nc_conclusion/<?php echo $rs['cp_no']; ?>" method="post" enctype="multipart/form-data">
                    <div class="card border-info mb-3 nc_conclusion" style="max-width:80%;">
                        <div class="card-header">Conclusion Of NC &nbsp;<span style="color:red;"><?php echo $weak; ?></span></div>
                        <div class="card-body text-info">
                            <div class="col-md-6">
                                
                                <?php if($get_nc['nc_conclusion'] == ""){ ?>
                                    <p class="card-text"><textarea class="form-control" rows='5' name='nc_conclusion' id="nc_conclusion" <?php echo $read3; ?>></textarea></p>
                                <div class="form-inline"><label>ลงชื่อ :</label><label class="nc_color_font"><?php echo $getuser['username']; ?></label>&nbsp;<label class="form-group">วันที่ :</label>&nbsp;<label class="nc_color_font"><?php echo date("d-m-Y"); ?></label></div><br>
                                
                                <input hidden="" type="text" name="nc_conclusion_user" id="nc_conclusion_user" value="<?php echo $getuser['username']; ?>" />
                                <input <?php echo $read3; ?> type="text" name="nc_conclusion_date" id="nc_conclusion_date" hidden="" value="<?php echo date("d-m-Y"); ?>"/>
                                <p><input <?php echo $hidden3; ?> type="submit" name="btn-con-nc" id="btn-con-nc" class="btn btn-primary"/></p>
                                <?php }else{ ?>
                                <p class="card-text"><textarea readonly="" class="form-control" rows='5' name='nc_conclusion' id="nc_conclusion"><?php echo $get_nc['nc_conclusion']; ?></textarea></p>
                                <div class="form-inline"><label>ลงชื่อ :</label><label class="nc_color_font"><?php echo $get_nc['nc_conclusion_user']; ?></label>&nbsp;<label class="form-group">วันที่ :</label>&nbsp;<label class="nc_color_font"><?php echo $get_nc['nc_conclusion_date']; ?></label></div><br>
                                <?php } ?>
                                
                                
                                
                            </div>
                            

                        </div>
                    </div>
                        </form>




                </div><!-- END Section Main area  -->

            </div>

    </body>
</html>
