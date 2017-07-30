<?php
	session_start();
	require '../../../database.php';

	if(isset($_POST)) {

		$item_id = $_POST['item_id'];
		$item_id = mysqli_real_escape_string($conn, $item_id);
		$item_id = trim($item_id);

		$partNumber = $_POST['partNumber'];
		$partNumber = mysqli_real_escape_string($conn, $partNumber);
		$partNumber = trim($partNumber);

		$description = $_POST['description'];
		$description = mysqli_real_escape_string($conn, $description);
		$description = trim($description);	

		$minStockCount = $_POST['minStockCount'];
		$minStockCount = mysqli_real_escape_string($conn, $minStockCount);
		$minStockCount = trim($minStockCount);		

		$itemType_id = $_POST['itemType_id'];
        $itemType_id = mysqli_real_escape_string($conn, $itemType_id);
        $itemType_id = trim($itemType_id); 

		$sql = "UPDATE
				  tbl_item
				SET
				  tbl_item.partNumber = '".$partNumber."',
				  tbl_item.description = '".$description."',
				  tbl_item.minStockCount = ".$minStockCount.",
				  tbl_item.itemType_id = '".$itemType_id."'
				WHERE
				  tbl_item.item_id = ".$item_id.";";

		$retval = mysqli_query($conn, $sql); 
		if ($retval) {
		  echo "<script>alert('ITEM DETAILS SAVED.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
		                                                        
		} else {
		  echo "<script>alert('AN ERROR OCCURED. UPDATE NOT SAVED. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
		}
	}
	mysqli_close($conn);	
?> 