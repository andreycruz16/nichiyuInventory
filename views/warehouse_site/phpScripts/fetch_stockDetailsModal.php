<?php
//Include database connection
require '../../../database.php';
if($_POST['history_id']) {
    $history_id = $_POST['history_id']; //escape string
    // Run the Query
    $sql = "SELECT 
            tbl_item_history.history_id,
            tbl_item_history.timestamp,
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
            tbl_itemType.itemTypeName,
            tbl_itemType.partOrUnit
            FROM tbl_item_history
            INNER JOIN tbl_item
            ON tbl_item_history.item_id = tbl_item.item_id
            INNER JOIN tbl_reference
            ON tbl_item_history.reference_id = tbl_reference.reference_id
            INNER JOIN tbl_users
            ON tbl_item_history.user_id = tbl_users.user_id
            INNER JOIN tbl_itemType
            ON tbl_item.itemType_id = tbl_itemType.itemType_id
            WHERE  tbl_item_history.history_id = ".$history_id.";";
    $result = mysqli_query($conn, $sql);
    // Fetch Records
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
            $history_id = $row[0];
            $timestamp = $row[1];
            $date = $row[2];
            $description = $row[3];
            $referenceType = $row[4];
            $referenceNumber = $row[5];
            $receivingReport = $row[6];
            $partNumber = $row[7];
            $quantity = $row[8];
            $customerName = $row[9];
            $details = $row[10];
            $transferType = $row[11];
            $firstName = $row[12];
            $lastName = $row[13];
            $comment = $row[14];
            $itemType = $row[15];
            $partOrUnit = $row[16];
		}
	}
    // Echo the data you want to show in modal
 } else {
    header("Location: ../index.php"); // Redirecting to All Records Page
 }
?>
<!--  HISTORY DETAILS MODAL -->

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel"><?php echo $description; ?> (<?php echo $partNumber; ?>)</h4>
</div>
<div class="modal-body">
      <div class="container-fluid">
        <div class="row">
            <div class="text-center"><strong>TIMESTAMP:</strong> <?php echo date('m/d/Y | h:i:s A', strtotime($timestamp)); ?></div>
            <div class="col-md-6">
              <br>
              <strong>ID:</strong> <?php echo $history_id; ?><br>
              <strong>DATE:</strong> <?php echo date('m/d/Y', strtotime($timestamp)); ?><br>
              <?php 
                  if($partOrUnit == 0) {
                    echo "<strong>PART NUMBER:</strong> " . $partNumber . "<br>";
                    echo "<strong>DESCRIPTION:</strong> " . $description . "<br>";
                  } else {
                    echo "<strong>MODEL/BRAND/SPECIFICATION:</strong> " . $partNumber . "<br>";
                    echo "<strong>SERIAL NUMBER:</strong> " . $description . "<br>";
                  }
              ?>
              <strong>DOCUMENT TYPE:</strong> <?php echo $referenceType; ?><br>
              <strong>REFERENCE #:</strong> <?php echo $referenceNumber; ?><br>
              <strong>RECEIVING REPORT:</strong> <?php echo $receivingReport; ?><br>
              <strong>TRANSFER TYPE:</strong> <?php echo $transferType . ' (' . $quantity . ')';?><br>
              <strong>CUSTOMER NAME:</strong> <?php echo $customerName; ?><br>
              <strong>DETAILS:</strong> <?php echo $details; ?><br>
            </div>
            <div class="col-md-6">
              <br>                                 
              <strong>UPDATE BY:</strong> <?php echo $firstName . ' ' . $lastName; ?><br><br>
              <strong>COMMENT:</strong> <?php echo '&quot;'.$comment.'&quot;'; ?><br>
            </div>
        </div>
      </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

