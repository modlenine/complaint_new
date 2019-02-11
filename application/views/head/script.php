<script>
    $(document).ready(function () {//Start

        /*********************************************************************************************************/
//                                                $("#cp_topic").load(function(){
        var value = $("#cp_topic_cat").val();
        if (value == "Safety" || value == "System" || value == "Environment") {

            $('#h_username').hide();
            $('#h_cusref').hide();
            $('#h_inv').hide();
            $('#h_procode').hide();
            $('#h_lotno').hide();
            $('#h_qty').hide();
        } else {
            $('#h_username').show();
            $('#h_cusref').show();
            $('#h_inv').show();
            $('#h_procode').show();
            $('#h_lotno').show();
            $('#h_qty').show();
        }
//                                                });
        /*********************************************************************************************************/



        /********************************Use In add Controller***************************/
        $("#cp_topic").change(function () {
            var value = $("#cp_topic_cat").val();
            if (value == "Safety" || value == "System" || value == "Environment") {

                $('#h_username').hide();
                $('#cp_cus_name').val("Saleecolour");
                $('#h_cusref').hide();
                $('#h_inv').hide();
                $('#h_procode').hide();
                $('#h_lotno').hide();
                $('#h_qty').hide();
            } else {
                $('#h_username').show();
                $('#h_cusref').show();
                $('#h_inv').show();
                $('#h_procode').show();
                $('#h_lotno').show();
                $('#h_qty').show();
            }
        });
        /***********************************Use In add Controller*****************************************/


/***************************Status check********************************************/
        var value2 = $("#status_check").val();
        if (value2 == "Complaint Analyzed") {

            $('.Summary').hide();
            $('.Conclusion').hide();


        }
        if (value2 == "Investigation Complete") {
            $('#save').hide();
            $('.Conclusion').hide();

        }
        if (value2 == "Close Complaint") {
            $('#comclusion_btn_save').hide();
        }
        if (value2 == "Transfered To NC") {
            $('.Conclusion').hide();
        }
/********************Status check******************************************************/



/*************************Show & Hide***Related Department**********************/
    $("input[name='cp_sum']").change(function(){
        if($(this).val()=="yes"){
            $('.transfer').show();
        }else{$('.transfer').hide();}
        
    });
    
    if($('#status_check').val()=="Transfered To NC" || $('#status_check').val()=="Normal Complaint" || $('#status_check').val()=="Close Complaint"){
        $('.transfer').hide();
    }
/**************************Show & Hide***Related Department**********************/



/**************************NC *************************************/
//var checkPermission = $('#checkPermission').val();
//if(checkPermission == 0){
//    $("#nc_motive").prop("readonly",true);
//    $("#nc_corrective").prop("readonly",true);
//    $("#nc_preventive").prop("readonly",true);
//    $("#nc_corrective_date").prop("readonly",true);
//    $("#nc_preventive_date").prop("readonly",true);
//    $('#btn3').hide();
//    
//    $("#followup1_text").prop("readonly",true);
//    $("#followup2_text").prop("readonly",true);
//    $("#followup3_text").prop("readonly",true);
//    $("#followup1_date").prop("readonly",true);
//    $("#followup2_date").prop("readonly",true);
//    $("#file_follow1").prop("readonly",true);
//    $("#file_follow2").prop("readonly",true);
//    $("#btn-follow1").hide();
//    $("#btn-follow2").hide();
//    $("#btn-follow3").hide();
//}

/**************************NC **************************************/



/********Check Department radio*************/
var deptcode = $("#deptcode").val();
$("#lab").click(function (){
    if(deptcode == $("#lab").val()){
        alert("ไม่สามารถ Complaint แผนกตัวเองได้");
        $("#lab").remove();
    }
});

$("#admin").click(function (){
   if(deptcode == $("#admin").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#admin").remove();
   } 
});

$("#hr").click(function (){
   if(deptcode == $("#hr").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#hr").remove();
   } 
});

$("#account").click(function (){
   if(deptcode == $("#account").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#account").remove();
   } 
});

$("#qc").click(function (){
   if(deptcode == $("#qc").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#qc").remove();
   } 
});

$("#maintenance").click(function (){
   if(deptcode == $("#maintenance").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#maintenance").remove();
   } 
});

$("#pd").click(function (){
   if(deptcode == $("#pd").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#pd").remove();
   } 
});

$("#sales").click(function (){
   if(deptcode == $("#sales").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#sales").remove();
   } 
});

$("#warehouse").click(function (){
   if(deptcode == $("#warehouse").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#warehouse").remove();
   } 
});

$("#planning").click(function (){
   if(deptcode == $("#planning").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#planning").remove();
   } 
});

$("#it").click(function (){
   if(deptcode == $("#it").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#it").remove();
   } 
});


$("#pu").click(function (){
   if(deptcode == $("#pu").val()){
       alert("ไม่สามารถ Complaint แผนกตัวเองได้");
       $("#pu").remove();
   } 
});


/********Check Department radio*************/




/********************Check************************/
var resultCheck = $('#resultCheck').val();
if(resultCheck == false){
    $('#save').hide();
}
/********************Check************************/



/***********NC++ Readonly Zone 3******************/

var nc_zone3_read = $('#dept_check').val();
if(nc_zone3_read == 0){
    $("#nc_motive").prop("readonly",true);
    $("#nc_corrective").prop("readonly",true);
    $("#nc_corrective_date").prop("readonly",true);
    $("#nc_preventive").prop("readonly",true);
    $("#nc_preventive_date").prop("readonly",true);
    $("#btn3").hide();  
}

if($("#nc_preventive").val()!== ""){
    $("#btn3").hide();
}

/***********NC++ Readonly Zone 3******************/



/***********NC++ Readonly Zone 4******************/
/**Check Dept***/
var zone4_permission = $("#deptcodename").val();
if(zone4_permission !== "QMR"){
    /**Followup1**/
    $("#followup1_text").prop("readonly",true);
    $("#file_follow1").prop("readonly",true);
    $("#btn-follow1").hide();
    $("#followup1_date").prop("readonly",true);
    
    /****Followup2*****/
    $("#followup2_text").prop("readonly",true);
    $("#file_follow2").prop("readonly",true);
    $("#btn-follow2").hide();
    $("#followup2_date").prop("readonly",true);
    
    /***Followup3*****/
    $("#followup3_text").prop("readonly",true);
    $("#file_follow3").prop("readonly",true);
    $("#btn-follow3").hide();
    
    /*****Conclusion of NC******/
    $("#nc_conclusion").prop("readonly",true);
    $("#btn-con-nc").hide();
    
}
/**Check Dept***/


var nc_pre = $('#nc_preventive').val();
if(nc_pre == ""){
    $('#followup1_text').prop("readonly",true);
    $("#btn-follow1").hide();
}
/***********NC++ Readonly Zone 4******************/



/******************Check dept view complaint******************/
var chk_dept_cpv = $("#check_dept_view").val();
if(chk_dept_cpv == 0){
    $("#btn_v_cp").hide();
}
/******************Check dept view complaint******************/






    });//End 
</script>
