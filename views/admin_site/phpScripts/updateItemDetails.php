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

		$boxNumber = $_POST['boxNumber'];
		$boxNumber = mysqli_real_escape_string($conn, $boxNumber);
		$boxNumber = trim($boxNumber);		

		$minStockCount = $_POST['minStockCount'];
		$minStockCount = mysqli_real_escape_string($conn, $minStockCount);
		$minStockCount = trim($minStockCount);		

		$sql = "UPDATE
				  tbl_item
				SET
				  tbl_item.partNumber = '".$partNumber."',
				  tbl_item.description = '".$description."',
				  tbl_item.boxNumber = '".$boxNumber."',
				  tbl_item.minStockCount = ".$minStockCount."
				WHERE
				  tbl_item.item_id = ".$item_id.";";

		$retval = mysqli_query($conn, $sql); 
		if ($retval) {
		  echo "<script>alert('ITEM DETAILS SAVED.'); window.location.href = '../index.php'</script>";
		                                                        
		} else {
		  echo "<script>alert('AN ERROR OCCURED. UPDATE NOT SAVED. TRY AGAIN.'); window.location.href = '../index.php'</script>";
		}
	}
	mysqli_close($conn);	
?> 