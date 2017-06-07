<?php 

	require '../../database.php';

    $lowStocks = 0;
    $outOfStocks = 0;

     $sql = "SELECT 
            tbl_item_history.item_id,
		    tbl_item.description,
		    tbl_item.partNumber,
		    tbl_item.boxNumber,
		    tbl_item.minStockCount,
		    SUM(tbl_item_history.quantity)
            FROM tbl_item_history
            INNER JOIN tbl_item
            ON tbl_item.item_id = tbl_item_history.item_id
            WHERE tbl_item_history.dept_id = 2
            AND tbl_item.status = 0
            GROUP By tbl_item_history.item_id
            ORDER BY SUM(tbl_item_history.quantity);";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
		$rows['status'] = "success";
        while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
            $minStockCount = $row[4];
            $quantity = $row[5];
			$rows['data']['items'][] = array(
			  'itemId' => $row[0],
			  'description' => $row[1],
			  'partNumber' => $row[2],
			  'boxNumber' => $row[3],
			  'orderPoint' => $row[4],
			  'quantity' => $row[5]
			);    

    //         if($quantity <= $minStockCount && $quantity > 0) {
					
				// $rows['data']['items']['lowStocks'][] = array(
				//   'itemId' => $row[0],
				//   'description' => $row[1],
				//   'partNumber' => $row[2],
				//   'boxNumber' => $row[3],
				//   'minStockCount' => $row[4],
				//   'quantity' => $row[5]
				// );     
			
    //             $lowStocks++;

    //         } else if($quantity == 0) {

				// $rows['data']['items']['emptyStocks'][] = array(
				//   'itemId' => $row[0],
				//   'description' => $row[1],
				//   'partNumber' => $row[2],
				//   'boxNumber' => $row[3],
				//   'minStockCount' => $row[4],
				//   'quantity' => $row[5]
				// );     
				
    //             $outOfStocks++;
    //         }

        }
            echo json_encode($rows);            
    } else {
    	$rows['status'] = "failed";
		$rows['data']['items'][] = null;

		echo json_encode($rows);
    }

    // echo "lowStocks:" . $lowStocks;
    // echo "<br>outOfStocks:" . $outOfStocks;

    mysqli_close($conn);

 ?>