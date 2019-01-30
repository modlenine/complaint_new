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
        if (value2 == "Investigating") {

            $('.Summary').hide();
            $('.Conclusion').hide();


        }
        if (value2 == "Investigated") {
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
    
    if($('#status_check').val()=="Transfered To NC"){
        $('.transfer').hide();
    }
/**************************Show & Hide***Related Department**********************/



/**************************NC *************************************/
var check_zone3 = $('#nc_motive').val();
if(check_zone3 != ""){
    $('.btn3').hide();
}else{
    $('.zone4').hide();
    $('.nc_conclusion').hide();
}



/**************************NC **************************************/



    });//End 
</script>
