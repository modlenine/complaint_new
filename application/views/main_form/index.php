<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    if(isset($_SESSION['username'])== ""){
    header('Location: http://localhost/complaint_new/login/');
    die();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        
<!-- CSS + Javascript => Datatable -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css"/>

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"/>
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
<!-- CSS + Javascript => Datatable -->

         
        
        
    </head>
    <body>
        <div>

            <div class="row"><!-- Section Main area  -->

                <!-- Nav Left Menu From view folder -->
                <div class="col-md-2">
                    <?php $this->load->view("head/navleft"); ?>
                </div>
                <!-- Nav Left Menu From view folder -->

                <div class="col-md-10"><!-- Container  -->
                    <div>
                        <h1 style="text-align: center;">List of complaint</h1>
                        <hr>
                    </div>
                    <table id="mytable" class="table table-hover table-bordered display responsive nowarp" style="width:100%">
                <thead align="center">
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Complaint by.</th>
                        <th>Topic</th>
                        <th>From</th>
                        <th>Status</th>
                        <th>Priority</th>
                    </tr>
                </thead>
                
                <?php foreach ($getdataall->result() as $gda): ?>
                    <tr align="center">
                        <td ><strong><a href="<?php 
                        if($gda->cp_status == "Investigating" || $gda->cp_status == "Investigated" || $gda->cp_status == "Normal complaint"){
                            echo base_url(); ?>complaint/investigation/<?php echo $gda->cp_no;
                        }else{
                            echo base_url(); ?>complaint/viewcomplaint/<?php echo $gda->cp_no;
                        }
                         
                        ?>"><?php echo $gda->cp_no; ?></a></strong></td>
                        <td ><?php echo $gda->cp_date; ?></td>
                        <td ><?php echo $gda->cp_user_name; ?></td>
                        <td ><?php echo $gda->cp_topic; ?></td>
                        <td ><?php echo $gda->cp_cus_name; ?></td>
                        <td ><?php echo $gda->cp_status; ?></td>
                        <td>
                            <?php 
                                if($gda->cp_priority >= 4.00 ){//4.10 -5.00
                                    $str_gda = "<strong style='color:red;'>Very Hight</strong>";
                                }
                                if($gda->cp_priority >= 3.00 and $gda->cp_priority < 4.00){//3.10 - 4.00
                                    $str_gda = "<strong style='color:orange;'>Hight</strong>";
                                }
                                if($gda->cp_priority >= 2.00 and $gda->cp_priority < 3.00){//2.10 - 3.00
                                    $str_gda = "<strong>Normal</strong>";
                                }
                                if($gda->cp_priority >= 1.00 and $gda->cp_priority < 2.00){//1.10 - 2.00
                                    $str_gda = "<strong style='color:#BEBEBE;'>Low</strong>";
                                }
                                if($gda->cp_priority >= 0 and $gda->cp_priority < 1.00){//0 - 1.00
                                    $str_gda = "<strong style='color:#ccc;'>Very Low</strong>";
                                }
                                echo $str_gda;
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>




        <script type="text/javascript">
            $(document).ready(function () {
                $('#mytable').DataTable({
                    "order": [[0, "desc"]]
                });
            });
        </script>

                </div><!-- Container  -->

            </div><!-- END Section Main area  -->

        </div>



    </body>
</html>
