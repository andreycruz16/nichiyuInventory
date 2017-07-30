<?php
    include('session.php');
    require '../../database.php';  

    if (!empty($_GET['item_id'])) {
        $item_id = $_GET['item_id'];
        $sql = "SELECT 
                tbl_item_history.item_id,
                tbl_item.description,
                tbl_item.partNumber,
                tbl_item.boxNumber,
                tbl_item.minStockCount,
                SUM(tbl_item_history.quantity),
                tbl_item_history.userType_id,
                tbl_item_history.history_id,
                tbl_itemType.itemTypeName
                FROM tbl_item_history
                INNER JOIN tbl_item
                ON tbl_item.item_id = tbl_item_history.item_id
                INNER JOIN tbl_itemType
                ON tbl_item.itemType_id = tbl_itemType.itemType_id
                WHERE tbl_item_history.userType_id = ".$_SESSION['userType_id']."
                AND tbl_item_history.item_id = ".$item_id."
                AND tbl_item.status = 0
                GROUP By tbl_item_history.item_id;";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result, MYSQL_NUM)) {    
                    $item_id = $row[0];
                    $description = $row[1];
                    $partNumber = $row[2];
                    $boxNumber = $row[3];
                    $minStockCount = $row[4];
                    $quantity = $row[5];
                    $userType_id = $row[6];
                    $history_id = $row[7];
                    $itemType = $row[8];
            }
        } else {
            header("location: index.php");    
        }

    } else {
        header("location: index.php");
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php") ?>
<style>
 #historyDetails .modal-header {
      background-color: #3c8dbc;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }    

  #editHistoryDetails .modal-header {
      background-color: #5bc0de;
      color: #fff;
      font-weight: bold;
      text-align: center;
 } 

  #stockIn .modal-header {
      background-color: #5cb85c;
      color: #fff;
      font-weight: bold;
      text-align: center;
 } 

 #stockOut .modal-header {
      background-color: #d9534f;
      color: #fff;
      font-weight: bold;
      text-align: center;
 } 

  #stockDelete .modal-header {
      background-color: #d9534f;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }

 #historyDelete .modal-header {
      background-color: #d9534f;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }

  #editItemDetails .modal-header {
      background-color: #1b89ae;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }
</style>
<body>
    <div id="wrapper">
      <!-- TOP NAVIGATION -->
      <?php include("includes/topNavigation.php") ?>
      <!-- SIDE NAVIGATION -->
      <?php include("includes/sideNavigation.php") ?>
	    <div id="page-wrapper">
        <div class="header"> 
            <h2 class="page-header">
                <code class="text-success">DESCRIPTION: <?php echo strtoupper($description); ?></code>
                <button type="button" class="btn btn-danger btn-xs" title="Delete" data-toggle="modal" data-target="#stockDelete" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Delete Permanently</button>    
            </h2>
            <ol class="breadcrumb">
                <li><a href="index.php">All Records</a></li>
                <li class="active">Item Details</li>
            </ol>
        </div>
        <div id="page-inner">
            <div class="row">
                <div class="row">
                  <div class="col-md-10">
                      <div class="form-group input-group col-md-12">
                         <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Part Number:</span>
                                <input type="text" name="partNumber" id="partNumber" class="form-control" value="<?php echo $partNumber; ?>" aria-describedby="basic-addon1" disabled readonly required>
                            </div>                                                                                                                                               
                         </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Stock On Hand:</span>
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" value="<?php echo $quantity; ?>" aria-describedby="basic-addon1" disabled readonly>                                                                                           
                            </div>                                                                                                                                               
                         </div>      
                      </div>
                      <div class="form-group input-group col-md-12">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Minimum&nbsp;Stock&nbsp;Count:</span>
                                <input type="text" name="minStockCount" id="minStockCount" class="form-control" value="<?php echo $minStockCount; ?>" aria-describedby="basic-addon1" disabled readonly required>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label>Box Number:</span>
                                <input type="text" name="boxNumber" id="boxNumber" class="form-control"  placeholder="Bo" value="<?php echo $boxNumber; ?>" aria-describedby="basic-addon1" disabled readonly autocomplete="off">                                                                                           
                            </div>                                                                                                                                               
                         </div>
                      </div>
                      <div class="form-group input-group col-md-12">
                         <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Item Type:</span>
                                <input type="text" name="itemType" id="itemType" class="form-control" value="<?php echo $itemType; ?>" aria-describedby="basic-addon1" disabled readonly required>
                            </div>
                           <br>
                              <button type="button" class="btn btn-primary btn-sm" title="Edit" data-toggle="modal" data-target="#editItemDetails" data-id="<?php echo $item_id; ?>"><strong>Edit</strong> <span class="glyphicon glyphicon-edit"></span></button>
                         </div>
                      </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group input-group col-md-12">
                        <div class="text-center">
                        <?php 
                            //set it to writable location, a place for temp generated PNG files
                            $PNG_TEMP_DIR = '../../assets/QrCodes/';
                            $PNG_WEB_DIR = $PNG_TEMP_DIR;

                            include "../../assets/phpqrcode/qrlib.php";
                            
                            if (!file_exists($PNG_TEMP_DIR))
                                mkdir($PNG_TEMP_DIR);

                            $qrValue = $partNumber;
                            $filename = $PNG_TEMP_DIR.$qrValue.'.png';
                            $errorCorrectionLevel = 'H';
                            $matrixPointSize = 10;
                            
                            QRcode::png($qrValue, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                               
                            //display generated file
                            echo '<a href="'.$PNG_WEB_DIR.'generateQrCode.php?PartNumber='.$partNumber.'&Description='.$description.'&BoxNumber='.$boxNumber.'" target="_blank"><img class="img-thumbnail" width="100px" height="100px" title="Right Click > Save image as.. > Save" src="'.$PNG_WEB_DIR.basename($filename).'" /></a>';  
                         ?>                                               
                        </div>                                    
                    </div>                          
                  </div>
                </div>
            </div>            
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button data-toggle="modal" data-target="#stockIn" data-toggle-tooltip="tooltip" title="IN" class="btn btn-success btn-sm" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-plus"></span><strong> IN</strong></button>
                            <button data-toggle="modal" data-target="#stockOut" data-toggle-tooltip="tooltip" title="OUT" class="btn btn-danger btn-sm" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-minus"></span><strong> OUT</strong></button>           
                        Record History (Newest - Oldest)
                    </div>
                    <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hover" id="recordHistory">
                                    <thead>
                                        <tr>
                                            <th class="text-center" bgcolor="#e5e5e5" width="15">ID</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Date&nbsp;(M/D/Y)</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Details</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Customer</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Document&nbsp;Type</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Reference&nbsp;#</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Receiving&nbsp;Report</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Transfer&nbsp;Type</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Quantity</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Stock&nbsp;On&nbsp;Hand</th>
                                            <th class="text-center" bgcolor="#f2ba7f">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center" bgcolor="#e5e5e5" width="15"></th> 
                                            <th class="text-center" bgcolor="#f2ba7f"></th> 
                                            <th class="text-center" bgcolor="#f2ba7f"></th> 
                                            <th class="text-center" bgcolor="#f2ba7f"></th> 
                                            <th class="text-center" bgcolor="#f2ba7f"></th> 
                                            <th class="text-center" bgcolor="#f2ba7f"></th> 
                                            <th class="text-center" bgcolor="#f2ba7f"></th>
                                            <th class="text-center" bgcolor="#f2ba7f"></th>
                                            <th class="text-center" bgcolor="#f2ba7f"></th>
                                            <th class="text-center" bgcolor="#f2ba7f"></th>
                                            <td class="text-center" bgcolor="#f2ba7f"></td> 
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php 
                                        require '../../database.php';
                                        $sql = "SELECT 
                                               tbl_item_history.history_id, 
                                               tbl_item_history.timestamp, 
                                               tbl_item_history.date, 
                                               tbl_reference.referenceType,
                                               tbl_item_history.referenceNumber, 
                                               tbl_item_history.receivingReport, 
                                               tbl_item_history.transferType, 
                                               tbl_item_history.customerName, 
                                               tbl_item_history.details, 
                                               tbl_item_history.quantity, 
                                               tbl_item_history.user_id 
                                               FROM tbl_item_history 
                                               INNER JOIN tbl_reference ON tbl_item_history.reference_id = tbl_reference.reference_id
                                               WHERE item_id = ".$item_id." 
                                               AND userType_id = ".$_SESSION['userType_id']."
                                               AND tbl_reference.reference_id != 0
                                               ORDER BY tbl_item_history.history_id ASC;";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            $stockOnHand = 0;
                                            while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                            $history_id = $row[0];
                                            $timestamp = $row[1];
                                            $date = $row[2];
                                            $referenceType = $row[3];
                                            $referenceNumber = $row[4];
                                            $receivingReport = $row[5];
                                            $transferType = $row[6];
                                            $customerName = $row[7];
                                            $details = $row[8];
                                            $quantity = $row[9];
                                            $user_id = $row[10];
                                            $stockOnHand += $quantity;
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php  echo $history_id ?></td>
                                            <td class="text-center"><?php echo date('m/d/Y', strtotime($date)); ?></td>
                                            <td class="text-center"><?php echo $details; ?></td>
                                            <td class="text-center"><?php echo $customerName; ?></td>
                                            <td class="text-center"><?php echo $referenceType; ?></td>
                                            <td class="text-center"><?php echo $referenceNumber; ?></td>
                                            <td class="text-center"><?php echo $receivingReport; ?></td>
                                            <td class="text-center"><?php echo $transferType ?></td>
                                            <td class="text-center"><?php echo $quantity; ?></td>
                                            <td class="text-center"><?php echo $stockOnHand; ?></td>
                                            <td class="text-center" style="white-space:nowrap;">
                                              <button type="button" class="btn btn-info btn-xs" title="Edit" data-toggle="modal" data-target="#editHistoryDetails" data-qty="<?php echo $stockOnHand; ?>" data-id="<?php echo $history_id; ?>">Edit <span class="glyphicon glyphicon-edit"></span></button>
                                              <button type="button" class="btn btn-primary btn-xs" title="Details" data-toggle="modal" data-target="#historyDetails" data-id="<?php echo $history_id; ?>">Details <span class="glyphicon glyphicon-list-alt"></span></button>                                                      
                                              <button type="button" class="btn btn-danger btn-xs" title="Delete" data-toggle="modal" data-target="#historyDelete" data-id="<?php echo $history_id; ?>"><span class="glyphicon glyphicon-trash"></span></button>
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
    </div>

    <!-- STOCK OUT MODAL -->
    <div id="stockOut" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center">
                <div class="fetched-data-stockOutModal"></div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- STOCK IN MODAL -->                                                     
    <div id="stockIn" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center">
                <div class="fetched-data-stockInModal"></div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div> -->
            </div>
        </div>
    </div>      

    <!-- EDIT HISTORY DETAILS -->                                                     
    <div id="editHistoryDetails" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="fetched-data-editHistoryDetailsModal"></div>
            </div>
        </div>
    </div>        

    <!-- HISTORY DETAILS -->                                                     
    <div id="historyDetails" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="fetched-data-historyDetailsModal"></div>
            </div>
        </div>
    </div> 

    <!-- DELETE ITEM MODAL-->
    <div id="historyDelete" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Delete Item?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1"></div>                     
                        <div class="col-sm-10">       
                            <div class="fetched-data-historyDeleteModal"></div>        
                        </div>
                        <div class="col-sm-1"></div>                     
                    </div>
                </div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
                </div> -->
            </div>
        </div>
    </div>    

    <!-- DELETE ITEM MODAL-->
    <div id="stockDelete" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Delete Item?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1"></div>                     
                        <div class="col-sm-10">       
                            <div class="fetched-data-deleteStockModal"></div>        
                        </div>
                        <div class="col-sm-1"></div>                     
                    </div>
                </div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
                </div> -->
            </div>
        </div>
    </div>    

<!-- EDIT ITEM MODAL-->
    <div id="editItemDetails" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Edit Item</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1"></div>                     
                        <div class="col-sm-10">       
                            <div class="fetched-data-editItemDetailsModal"></div>        
                        </div>
                        <div class="col-sm-1"></div>                     
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
                </div>
            </div>
        </div>
    </div>     

    <?php include("includes/scripts.php") ?>
    <script>
            $(document).ready(function () {
                $('#recordHistory').dataTable({
                'iDisplayLength': 15, 
                'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
                'order': [ 0, 'desc' ],
                'bSort': true
                 });
            });

            $(document).ready(function() {
                var table = $('#recordHistory').DataTable();
             
                $("#recordHistory tfoot th").each( function ( i ) {
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

            if($('#transferType_id').val() == "IN") {
              $('#forTransferTypeOut').remove();
            }            

            // HISTORY DETAILS
            $(document).ready(function(){
                $('#historyDetails').on('show.bs.modal', function (e) {
                    var history_id = $(e.relatedTarget).data('id');
                    $.ajax({
                        type : 'post',
                        url : 'phpScripts/fetch_stockDetailsModal.php', //Here you will fetch records 
                        data :  'history_id=' + history_id, //Pass $id
                        success : function(data){
                        $('.fetched-data-historyDetailsModal').html(data);//Show fetched data from database
                        }
                    });
                 });
            });

          // EDIT HISTORY DETAILS
          $(document).ready(function(){
              $('#editHistoryDetails').on('show.bs.modal', function (e) {
                  var history_id = $(e.relatedTarget).data('id');
                  var stockOnHand = $(e.relatedTarget).data('qty');
                  $.ajax({
                      type : 'post',
                      url : 'phpScripts/fetch_editHistoryDetailsModal.php', //Here you will fetch records 
                      data :  {history_id: history_id, stockOnHand: stockOnHand}, //Pass $id
                      success : function(data){
                      $('.fetched-data-editHistoryDetailsModal').html(data);//Show fetched data from database
                      }
                  });
               });
          });

        $(document).ready(function(){
            $('#stockIn').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_stockInModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-stockInModal').html(data);//Show fetched data from database
                    }
                });
             });
        });

        $(document).ready(function(){
            $('#stockOut').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_stockOutModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-stockOutModal').html(data);//Show fetched data from database
                    }
                });
             });
        });


        $(document).ready(function(){
            $('#historyDelete').on('show.bs.modal', function (e) {
                var history_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_deleteHistoryModal.php', //Here you will fetch records 
                    data :  'history_id=' + history_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-historyDeleteModal').html(data);//Show fetched data from database
                    }
                });
             });
        });

        $(document).ready(function(){
            $('#stockDelete').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_deleteStockModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-deleteStockModal').html(data);//Show fetched data from database
                    }
                });
             });
        });     

        $(document).ready(function(){
            $('#editItemDetails').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_editItemDetailsModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-editItemDetailsModal').html(data);//Show fetched data from database
                    }
                });
             });
        });   
    </script>
</body>
</html>