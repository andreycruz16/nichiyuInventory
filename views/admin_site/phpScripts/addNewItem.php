<?php 
    session_start();
    require '../../../database.php';
	if (!empty($_POST)) {
        $partNumber = $_POST['partNumber'];
        $partNumber = mysqli_real_escape_string($conn, $partNumber);
        $partNumber = trim($partNumber);

        $description = $_POST['description'];
        $description = mysqli_real_escape_string($conn, $description);
        $description = trim($description);

        $boxNumber = $_POST['boxNumber'];
        $boxNumber = mysqli_real_escape_string($conn, $boxNumber);
        $boxNumber = trim($boxNumber);

        $orderPoint = $_POST['orderPoint'];
        $orderPoint = mysqli_real_escape_string($conn, $orderPoint);
        $orderPoint = trim($orderPoint);


        $sql = "INSERT INTO tbl_item VALUES(NULL,
                                            NOW(),
                                            '".$partNumber."',
                                            '".$description."',
                                            '".$boxNumber."',
                                             ".$orderPoint.",
                                             '0'
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
                                                        ".$_SESSION['userType_id'].",
                                                        NOW(),
                                                        NOW(),
                                                        '0',
                                                        'N/A',
                                                        'N/A',
                                                        'IN',
                                                        '0.00',
                                                        '0',
                                                        'N/A',
                                                        'N/A',
                                                        'N/A',
                                                        ".$_SESSION['user_id'].",
                                                        'N/A'
                                                        );";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_item_history VALUES(NULL,
                                                        ".$item_id.",
                                                        ".$_SESSION['userType_id'].",
                                                        NOW(),
                                                        NOW(),
                                                        '0',
                                                        'N/A',
                                                        'N/A',
                                                        'IN',
                                                        '0.00',
                                                        '0',
                                                        'N/A',
                                                        'N/A',
                                                        'N/A',
                                                        ".$_SESSION['user_id'].",
                                                        'N/A'
                                                        );";
            mysqli_query($conn, $sql);

            echo "<script>alert('NEW ITEM ADDED SUCCESSFULLY.'); window.location.href = '../index.php'</script>";
        } 
        mysqli_close($conn);
    } else {
        echo "<script>alert('AN ERROR OCCURED. TRY AGAIN.'); window.location.href = '../index.php'</script>";
    }
 ?>