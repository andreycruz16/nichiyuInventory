<?php 

	require '../../../../database.php';

	$sql = "SELECT 
		    tbl_item.boxNumber
		    FROM tbl_item_history
		    INNER JOIN tbl_item
		    ON tbl_item.item_id = tbl_item_history.item_id
		    WHERE tbl_item_history.dept_id = 2 AND tbl_item.status = 0
            GROUP BY tbl_item.boxNumber
		    ORDER BY tbl_item.boxNumber";

	$result = mysqli_query($conn, $sql);
	// $rows = "";
	if (mysqli_num_rows($result) > 0) {

		$rows['status'] = "success";
	    while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
			$rows['data']['boxNumber'][] = $row[0];
			
	    }


	    echo json_encode($rows);
	} else {

		$rows['status'] = "failed";
		$rows['data']['boxnumber'][] = null;

		echo json_encode($rows);
	}

	mysqli_close($conn);
 ?>