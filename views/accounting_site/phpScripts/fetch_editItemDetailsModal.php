<?php
//Include database connection
require '../../../database.php';
if($_POST['item_id']) {
    $item_id = $_POST['item_id']; //escape string
    // Run the Query
    $sql = "SELECT item_id, description, partNumber, boxNumber, minStockCount FROM tbl_item WHERE item_id = ".$item_id.";";
    $result = mysqli_query($conn, $sql);
    // Fetch Records
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
            $item_id = $row[0];
            $description = $row[1];
            $partNumber = $row[2];
            $boxNumber = $row[3];
            $minStockCount = $row[4];

        }
    }
    // Echo the data you want to show in modal
 } else {
    header("Location: ../index.php"); // Redirecting to All Records Page
 }
?>
<form role="form" class="form-horizontal" action="phpScripts/updateItemDetails.php" method="post">
	<input type="hidden" name="item_id" value="<?php echo $item_id;?>"/>
	<div class="form-group">
		<label for="recipient-name" class="control-label">Part Number:</label>
		<input type="text" value="<?php echo $partNumber; ?>" class="form-control" name="partNumber" id="partNumber" placeholder="Part Number" autocomplete="off" required>
	</div>
	<div class="form-group">
		<label for="message-text" class="control-label">Description:</label>
		<input type="text" value="<?php echo $description; ?>" class="form-control" name="description" id="description" placeholder="Description" autocomplete="off" required>
	</div>
	<div class="form-group">
		<label for="message-text" class="control-label">Order Point:</label>
		<input type="text" value="<?php echo $minStockCount; ?>" class="form-control" name="minStockCount" id="orderPoint" placeholder="Order Point" autocomplete="off" required>
	</div>
	<button type="submit" class="btn btn-primary col-sm-8 col-sm-offset-2" ><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>   
</form>