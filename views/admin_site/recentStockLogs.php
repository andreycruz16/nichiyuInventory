<?php
    include('session.php');
    require '../../database.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/header.php") ?>
<style>
 #historyDetailsWarehouse .modal-header {
      background-color: #3c8dbc;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }    

 #historyDetailsServices .modal-header {
      background-color: #3c8dbc;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }
</style>
</head>
<body>
    <div id="wrapper">
        <!-- TOP NAVIGATION -->        
        <?php include("includes/topNavigation.php") ?>
        <!-- SIDE NAVIGATION --> 
        <?php include("includes/sideNavigation.php") ?>

        <!-- WRAPPER START  -->
        <!-- WRAPPER START  -->
        <!-- WRAPPER START  -->

		<div id="page-wrapper">
            <div class="header"> 
                <h2 class="page-header">
                    <code class="text-success">RECENT STOCK LOGS</code>
                </h2>
                <ol class="breadcrumb">
                    <li><a href="index.php">Recent Stock Logs</a></li>
                </ol>
            </div>
            <div id="page-inner">
                <div class="row">
                    <!-- Recent Stock Logs RECORD warehouse -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Recent Stock Logs
                            </div>
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover" id="warehouseHistory">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="155">TIMESTAMP</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Date&nbsp;(M/D/Y)</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;Type</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;#</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="5">Transfer&nbsp;Type</th>
                                                    <!-- <th class="text-center" bgcolor="#f2ba7f" width="5">Update&nbsp;By</th> -->
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Action</th> 
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="155">TIMESTAMP</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Date&nbsp;(M/D/Y)</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;Type</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;#</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Transfer&nbsp;Type</th>
                                                    <!-- <th bgcolor="#f2ba7f" width="5">Update&nbsp;By</th> -->
                                                    <td class="text-center" bgcolor="#f2ba7f" width=""></td> 
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php 
                                                require '../../database.php';
                                                $sql = "SELECT 
                                                       tbl_item_history.history_id, 
                                                       tbl_item_history.timestamp, 
                                                       tbl_item_history.date, 
                                                       tbl_item.description, 
                                                       tbl_reference.referenceType,
                                                       tbl_item_history.referenceNumber, 
                                                       tbl_item.partNumber, 
                                                       tbl_item_history.quantity, 
                                                       tbl_item_history.transferType,
                                                       tbl_users.firstName, 
                                                       tbl_users.lastName 
                                                       FROM tbl_item_history 
                                                       INNER JOIN tbl_reference ON tbl_item_history.reference_id = tbl_reference.reference_id
                                                       INNER JOIN tbl_users ON tbl_item_history.user_id = tbl_users.user_id
                                                       INNER JOIN tbl_item ON tbl_item.item_id = tbl_item_history.item_id
                                                       WHERE tbl_item_history.dept_id = 1
                                                       ORDER BY tbl_item_history.history_id DESC;";   
                                                // echo $sql;
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                        $history_id = $row[0];
                                                        $timestamp = $row[1];
                                                        $date = $row[2];
                                                        $description = $row[3];
                                                        $referenceType = $row[4];
                                                        $referenceNumber = $row[5];
                                                        $partNumber = $row[6];
                                                        $quantity = $row[7];
                                                        $transferType = $row[8];
                                                        $firstName = $row[9];
                                                        $lastName = $row[10];
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $history_id; ?></td>
                                                    <td class="text-center" style="white-space:nowrap;" title="<?php  echo date('h:i:s A', strtotime($timestamp)); ?>"><?php  echo date('m/d/Y | h:i:s A', strtotime($timestamp)); ?></td>
                                                    <td class="text-center"><?php echo date('m/d/Y', strtotime($date)); ?></td>
                                                    <td class="text-center"><?php echo $description; ?></td>
                                                    <td class="text-center"><?php echo $referenceType; ?></td>
                                                    <td class="text-center"><?php echo $referenceNumber; ?></td>
                                                    <td class="text-center"><?php echo $partNumber; ?></td>
                                                    <td class="text-center"><?php echo $quantity; ?></td>
                                                    <td class="text-center"><?php echo $transferType; ?></td>
                                                    <!-- <td class="text-center"><?php echo $firstName . ' ' . $lastName; ?></td> -->
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs" title="Details" data-toggle="modal" data-target="#historyDetailsWarehouse" data-id="<?php echo $history_id; ?>">Details <span class="glyphicon glyphicon-list-alt"></span></button>
                                                    </td>
                                                </tr>
                                            <?php 
                                                    }
                                                }
                                                    mysqli_close($conn);
                                            ?>                                          
                                            </tbody>                                            
                                        </table>
                                    </div>                                                
                            </div>
                        </div>
                    <!-- Recent Stock Logs RECORD services -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Recent Stock Logs
                            </div>
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover" id="serviceHistory">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="155">TIMESTAMP</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Date&nbsp;(M/D/Y)</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;Type</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;#</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="5">Transfer&nbsp;Type</th>
                                                    <!-- <th class="text-center" bgcolor="#f2ba7f" width="5">Update&nbsp;By</th> -->
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Action</th> 
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="155">TIMESTAMP</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Date&nbsp;(M/D/Y)</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;Type</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Reference&nbsp;#</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Transfer&nbsp;Type</th>
                                                    <!-- <th bgcolor="#f2ba7f" width="5">Update&nbsp;By</th> -->
                                                    <td class="text-center" bgcolor="#f2ba7f" width=""></td> 
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php 
                                                require '../../database.php';
                                                $sql = "SELECT 
                                                       tbl_item_history.history_id, 
                                                       tbl_item_history.timestamp, 
                                                       tbl_item_history.date, 
                                                       tbl_item.description, 
                                                       tbl_reference.referenceType,
                                                       tbl_item_history.referenceNumber, 
                                                       tbl_item.partNumber, 
                                                       tbl_item_history.quantity, 
                                                       tbl_item_history.transferType,
                                                       tbl_users.firstName, 
                                                       tbl_users.lastName 
                                                       FROM tbl_item_history 
                                                       INNER JOIN tbl_reference ON tbl_item_history.reference_id = tbl_reference.reference_id
                                                       INNER JOIN tbl_users ON tbl_item_history.user_id = tbl_users.user_id
                                                       INNER JOIN tbl_item ON tbl_item.item_id = tbl_item_history.item_id
                                                       WHERE tbl_item_history.dept_id = 2
                                                       ORDER BY tbl_item_history.history_id DESC;";   
                                                // echo $sql;
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                        $history_id = $row[0];
                                                        $timestamp = $row[1];
                                                        $date = $row[2];
                                                        $description = $row[3];
                                                        $referenceType = $row[4];
                                                        $referenceNumber = $row[5];
                                                        $partNumber = $row[6];
                                                        $quantity = $row[7];
                                                        $transferType = $row[8];
                                                        $firstName = $row[9];
                                                        $lastName = $row[10];
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $history_id; ?></td>
                                                    <td class="text-center" style="white-space:nowrap;" title="<?php  echo date('h:i:s A', strtotime($timestamp)); ?>"><?php  echo date('m/d/Y | h:i:s A', strtotime($timestamp)); ?></td>
                                                    <td class="text-center"><?php echo date('m/d/Y', strtotime($date)); ?></td>
                                                    <td class="text-center"><?php echo $description; ?></td>
                                                    <td class="text-center"><?php echo $referenceType; ?></td>
                                                    <td class="text-center"><?php echo $referenceNumber; ?></td>
                                                    <td class="text-center"><?php echo $partNumber; ?></td>
                                                    <td class="text-center"><?php echo $quantity; ?></td>
                                                    <td class="text-center"><?php echo $transferType; ?></td>
                                                    <!-- <td class="text-center"><?php echo $firstName . ' ' . $lastName; ?></td> -->
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-info btn-xs" title="Details" data-toggle="modal" data-target="#historyDetailsServices" data-id="<?php echo $history_id; ?>">Details <span class="glyphicon glyphicon-list-alt"></span></button>
                                                    </td>
                                                </tr>
                                            <?php 
                                                    }
                                                }
                                                    mysqli_close($conn);
                                            ?>                                          
                                            </tbody>                                            
                                        </table>
                                    </div>                                                
                            </div>
                        </div>                  
                </div>            
				<?php include("includes/footer.php") ?>
            </div>
        </div>

        <!-- WRAPPER END  -->
        <!-- WRAPPER END  -->
        <!-- WRAPPER END  -->

    <!-- HISTORY DETAILS SERVICES-->                                                     
    <div id="historyDetailsServices" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="fetched-data-historyDetailsModal"></div>
            </div>
        </div>
    </div> 

    <!-- HISTORY DETAILS WAREHOUSE-->                                                     
    <div id="historyDetailsWarehouse" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="fetched-data-historyDetailsModal"></div>
            </div>
        </div>
    </div>     

    </div>
    <?php include("includes/scripts.php") ?>
    <script>
            // HISTORY DETAILS SERVICE
            $(document).ready(function(){
                $('#historyDetailsServices').on('show.bs.modal', function (e) {
                    var history_id = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'phpScripts/fetch_stockDetailsServicesModal.php', //Here you will fetch records 
                        data :  'history_id=' + history_id, //Pass $id
                        success : function(data){
                        $('.fetched-data-historyDetailsModal').html(data);//Show fetched data from database
                        }
                    });
                 });
            });

            // HISTORY DETAILS WAREHOUSE
            $(document).ready(function(){
                $('#historyDetailsWarehouse').on('show.bs.modal', function (e) {
                    var history_id = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'phpScripts/fetch_stockDetailsWarehouseModal.php', //Here you will fetch records 
                        data :  'history_id=' + history_id, //Pass $id
                        success : function(data){
                        $('.fetched-data-historyDetailsModal').html(data);//Show fetched data from database
                        }
                    });
                 });
            });            


            $(document).ready(function () {
                $('#warehouseHistory').dataTable({
                'iDisplayLength': 15, 
                'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
                'bSort': false
                 });

                $('#serviceHistory').dataTable({
                'iDisplayLength': 15, 
                'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
                'bSort': false
                 });
            });

            $(document).ready(function() {
                var table = $('#warehouseHistory').DataTable();
             
                $("#warehouseHistory tfoot th").each( function ( i ) {
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            table.column( i )
                                .search( $(this).val() )
                                .draw();
                        } );
             
                    table.column( i ).data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );

                var table = $('#serviceHistory').DataTable();
             
                $("#serviceHistory tfoot th").each( function ( i ) {
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            table.column( i )
                                .search( $(this).val() )
                                .draw();
                        } );
             
                    table.column( i ).data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );       
            } );             

            $('.form_date').datetimepicker({
                // language:  'fr',
                format:'yyyy-mm-dd',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            }); 
    </script>
</body>
</html>