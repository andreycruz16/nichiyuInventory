<?php 
    session_start();
    require '../../../database.php';
	if (!empty($_POST)) {
        $partNumber = $_POST['partNumber'];
        $partNumber = mysqli_real_escape_string($conn, $partNumber);
        $partNumber = trim($partNumber);
        $partNumber = strip_tags($partNumber);
        $partNumber = strtoupper($partNumber);

        $sql = "SELECT tbl_item.partNumber FROM tbl_item WHERE tbl_item.partNumber = '".$partNumber."' AND dept_id = 4 AND status = 0;";
        if(!$result = mysqli_query($conn, $sql)) {
            exit(mysqli_error($conn));
        }

        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('THIS PART NUMBER ALREADY EXISTS. '); window.location.href = '../index.php'</script>";
            exit();
        }         

        $description = $_POST['description'];
        $description = mysqli_real_escape_string($conn, $description);
        $description = trim($description);
        $description = strip_tags($description);
        $description = strtoupper($description);

        $orderPoint = $_POST['orderPoint'];
        $orderPoint = mysqli_real_escape_string($conn, $orderPoint);
        $orderPoint = trim($orderPoint);
        $orderPoint = strip_tags($orderPoint);

        $transferType = $_POST['transferType'];
        $transferType = mysqli_real_escape_string($conn, $transferType);
        $transferType = trim($transferType);
        $transferType = strip_tags($transferType);

        $sql = "INSERT INTO tbl_item VALUES(NULL,
                                            NOW(),
                                            '".$partNumber."',
                                            '".$description."',
                                            'N/A',
                                             ".$orderPoint.",
                                             '0',
                                             4
                                             );";                  
        $retval = mysqli_query($conn, $sql);

        if($retval) {
            $sql = "SELECT
                    tbl_item.item_id,
                    tbl_item.timestamp,
                    tbl_item.partNumber,
                    tbl_item.description,
                    tbl_item.boxNumber,
                    tbl_item.minStockCount,
                    tbl_item.status
                    FROM
                    tbl_item
                    WHERE
                    tbl_item.item_id = (SELECT MAX(tbl_item.item_id) FROM tbl_item);";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQL_NUM);
            $item_id = $row[0];

            $sql = "INSERT INTO tbl_item_history VALUES(NULL,
                                                     ".$item_id.",
                                                     4,
                                                     now(),
                                                     0,
                                                     0,
                                                     'N/A',
                                                     'N/A',
                                                     '".$transferType."',
                                                     0,
                                                     0,
                                                     'N/A',
                                                     'N/A',
                                                     'N/A',
                                                     ".$_SESSION['user_id'].",
                                                     'N/A');"; 
            mysqli_query($conn, $sql);

            echo "<script>alert('NEW ITEM ADDED SUCCESSFULLY.'); window.location.href = '../index.php'</script>";
        } else {
            echo "<script>alert('THIS PART NUMBER ALREADY EXISTS. '); window.location.href = '../index.php'</script>";
        }
        mysqli_close($conn);
    }
 ?>