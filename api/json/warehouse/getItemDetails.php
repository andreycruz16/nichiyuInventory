<?php 

	require '../../../database.php';

	if(!empty($_GET['partNumber'])) {
		$partNumber = $_GET['partNumber'];
		$sql = "SELECT 
		        tbl_item_history.item_id,
		        tbl_item.description,
		        tbl_item.partNumber,
		        tbl_item.boxNumber,
		        tbl_item.minStockCount,
		        SUM(tbl_item_history.quantity),
		        tbl_item_history.dept_id,
		        tbl_item_history.history_id
		        FROM tbl_item_history
		        INNER JOIN tbl_item
		        ON tbl_item.item_id = tbl_item_history.item_id
		        WHERE tbl_item_history.dept_id = 2
		        AND tbl_item.partNumber = ".$partNumber."
		        AND tbl_item.status = 0
		        GROUP By tbl_item_history.item_id;";

		$result = mysqli_query($conn, $sql);
		$rows = array();
		if (mysqli_num_rows($result) > 0) {

			$rows['status'] = "success";
		    while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
				$rows['data']['itemDetails'][] = array(
				  'item_id' => $row[0],
				  'description' => $row[1],
				  'partNumber' => $row[2],
				  'boxNumber' => $row[3],
				  'minStockCount' => $row[4],
				  'quantity' => $row[5]
				);
		    }

		    echo json_encode($rows);
		} else {
			$rows['status'] = "failed";

			echo json_encode($rows);
		}
				
	}

	mysqli_close($conn);

 ?>