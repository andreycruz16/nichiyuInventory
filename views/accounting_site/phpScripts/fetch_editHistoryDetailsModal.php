<?php
//Include database connection
require '../../../database.php';
if($_POST['history_id']) {
    $history_id = $_POST['history_id']; //escape string
    // Run the Query
    $sql = "SELECT 
            tbl_item_history.history_id,
            tbl_item_history.timestamp,
            tbl_item_history.item_id,
            tbl_item_history.date,
            tbl_item.description,
            tbl_reference.referenceType,
            tbl_item_history.referenceNumber,
            tbl_item_history.receivingReport,
            tbl_item.partNumber,
            tbl_item_history.quantity,
            tbl_item_history.customerName,
            tbl_item_history.details,
            tbl_item_history.transferType,
            tbl_users.firstName,
            tbl_users.lastName,
            tbl_item_history.comment,
            tbl_item_history.unitCost
            FROM tbl_item_history
            INNER JOIN tbl_item
            ON tbl_item_history.item_id = tbl_item.item_id
            INNER JOIN tbl_reference
            ON tbl_item_history.reference_id = tbl_reference.reference_id
            INNER JOIN tbl_users
            ON tbl_item_history.user_id = tbl_users.user_id
            WHERE  tbl_item_history.history_id = ".$history_id.";";
    $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
            $history_id = $row[0];
            $timestamp = $row[1];
            $item_id = $row[2];
            $date = $row[3];
            $description = $row[4];
            $referenceType = $row[5];
            $referenceNumber = $row[6];
            $receivingReport = $row[7];
            $partNumber = $row[8];
            $quantity = $row[9];
            $customerName = $row[10];
            $details = $row[11];
            $transferType = $row[12];
            $firstName = $row[13];
            $lastName = $row[14];
            $comment = $row[15];
            $unitCost = $row[16];
    }
  }
    // Echo the data you want to show in modal
 } else {
    header("Location: ../index.php"); // Redirecting to All Records Page
 }
?>

 <script> //php variables to javascript variables
    var customerName = "<?php echo $customerName; ?>";
    var details = "<?php echo $details; ?>";
    var receivingReport = "<?php echo $receivingReport; ?>";
 </script>
<!--  EDIT HISTORY DETAILS MODAL -->

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel"><?php echo $description; ?> (<?php echo $partNumber; ?>)</h4>
</div>
<form role="form" class="form-horizontal" action="phpScripts/updateHistoryDetails.php" method="post">  
  <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="input-group col-md-12">
                <div class="text-center"><strong>TIMESTAMP:</strong> <?php echo date('m/d/Y | h:i:s A', strtotime($timestamp)); ?></div><br>
                <div class=""><strong>ID:</strong> <i><?php echo $history_id; ?></i></div><br>
              </div>
              <div class="col-md-6">
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> Date:</span>
                    <div class="input-group date form_date col-md-12">
                        <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d', strtotime($timestamp)); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                    </div>
                </div><br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1">Transfer Type:</span>
                    <select class="form-control" name="transferType" id="transferType">
                        <option value="OUT" <?php if($transferType == 'OUT') echo "selected"; ?>>OUT</option>
                        <option value="IN" <?php if($transferType == 'IN') echo "selected"; ?>>IN</option>
                    </select> 
                </div><br> 
                <div class="input-group col-md-12">
                  <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> Reference:</span>
                  <select class="form-control" name="reference_id" id="reference_idModal" required>
                    <option value="" selected disabled>Reference Type</option>
                        <?php 
                            $sql = "SELECT * FROM tbl_reference WHERE reference_id != 0;";

                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                    $reference_id = $row[0];
                                    $referenceName = $row[1];
                        ?>
                            <option value="<?php echo $reference_id; ?> " <?php if($referenceType == $referenceName) echo "selected"; ?>><?php echo $referenceName; ?></option>


                        <?php 
                                }
                            }
                            mysqli_close($conn);
                        ?>                    
                  </select>
                </div><br>
                <div class="input-group col-md-12">
                  <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> Reference #:</span>
                  <input type="text" name="referenceNumber" value="<?php echo $referenceNumber; ?>" class="form-control" id="referenceNumberModal" placeholder="Reference Number" aria-describedby="basic-addon1" required autocomplete="off">
                </div><br>
                <div class="input-group col-md-12" id="receivingReportModal">
                  <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> Receiving Report:</span>
                  <input type="text" name="receivingReport" value="<?php echo $receivingReport; ?>" class="form-control" id="receivingReportModal" placeholder="Receiving Report" aria-describedby="basic-addon1" autocomplete="off">
                </div><br>
                <div class="input-group col-md-12" id="receivingReportModal">
                  <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> Unit Cost:</span><span class="input-group-addon" id="basic-addon1">₱</span>
                  <input type="number" min="0" name="unitCost" class="form-control" id="unitCost" placeholder="0.00" value="<?php echo $unitCost; ?>" step="0.01" aria-describedby="basic-addon1" required autocomplete="off">
                </div><br>
              </div>
              <div class="col-md-6">
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> Quantity :</span>
                    <input type="number" name="quantity" value="<?php echo $quantity; ?>" class="form-control" id="quantity" placeholder="0" aria-describedby="basic-addon1" required autocomplete="off">
                </div>
                <div id="forTransferTypeOut"> <br>                                       
                    <div class="input-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Customer Name:</span>
                            <input type="text" name="customerName" value="<?php echo $customerName; ?>" id="customerName" placeholder="Customer Name (Optional)" class="form-control" value="<?php echo $customerName; ?>" aria-describedby="basic-addon1">                                                                                           
                        </div>                                                                                                                                               
                     </div><br>
                     <div class="input-group col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Details:</span>
                            <input type="text" name="details" value="<?php echo $details; ?>" id="details" placeholder="Details" class="form-control" value="<?php echo $details; ?>" aria-describedby="basic-addon1">                                                                                           
                        </div>                                                                                                                                               
                      </div>
                </div>  
                <br>
                <div class="input-group col-md-12">
                      <span class="input-group-addon" id="basic-addon1">Comment:</span>
                    <textarea class="form-control custom-control" name="comment" rows="3" style="resize:none" placeholder="Type in your comment.."><?php echo $comment; ?></textarea>     
                </div>                            
                <input type="hidden" name="history_id" id="history_id" value="<?php echo $history_id; ?>">
                <input type="hidden" name="partNumber" id="partNumber" value="<?php echo $partNumber; ?>">
                <input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>">
                <input type="hidden" name="stockOnHand" id="stockOnHand" value="<?php echo $stockOnHand; ?>">
              </div>
            </div>
          </div>
        </div>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
  </div>
</form>

<script>
    // $(document).ready(function() {
    //   if($('#transferType').val() != 'OUT') {
    //         $('#forTransferTypeOut').fadeOut('fast');
    //         $('#customerName').val("N/A");
    //         $('#details').val("N/A");
    //   }

    //     $('#transferType').change(function(event) {
    //         if($(this).val() == 'OUT') {
    //             $('#forTransferTypeOut').fadeIn('fast');
    //             $('#customerName').val("");
    //             $('#details').val("");
    //         } else {
    //             $('#forTransferTypeOut').fadeOut('fast');
    //             $('#customerName').val(customerName);
    //             $('#details').val(details);
    //         }
    //     });
    // });   
</script>