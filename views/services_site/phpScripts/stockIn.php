<?php 
    session_start();
	require '../../../database.php';
	if (!empty($_POST)) {
        $item_id = $_POST['item_id'];
        $item_id = mysqli_real_escape_string($conn, $item_id);
        $item_id = trim($item_id);

        $description = $_POST['description'];
        $description = mysqli_real_escape_string($conn, $description);
        $description = trim($description);
        $description = strip_tags($description);
        $description = strtoupper($description);

        $partNumber = $_POST['partNumber'];
        $partNumber = mysqli_real_escape_string($conn, $partNumber);
        $partNumber = trim($partNumber);     
        $partNumber = strip_tags($partNumber);     
        $partNumber = strtoupper($partNumber);   

        $date = $_POST['date'];
        $date = mysqli_real_escape_string($conn, $date);
        $date = trim($date);

        $reference_id = $_POST['reference_id'];
        $reference_id = mysqli_real_escape_string($conn, $reference_id);
        $reference_id = trim($reference_id);

        $referenceNumber = $_POST['referenceNumber'];
        $referenceNumber = mysqli_real_escape_string($conn, $referenceNumber);
        $referenceNumber = trim($referenceNumber);
        $referenceNumber = strip_tags($referenceNumber);
        $referenceNumber = strtoupper($referenceNumber);


        $unitCost = $_POST['unitCost'];
        $unitCost = mysqli_real_escape_string($conn, $unitCost);
        $unitCost = trim($unitCost);

        $quantity = $_POST['quantity'];
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $quantity = trim($quantity);
        $quantity = max($quantity, 0);
        if ($quantity == 0) {
            echo "<script>alert('INVALID QUANTITY. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            exit();
        }

        $transferType = $_POST['transferType'];
        $transferType = mysqli_real_escape_string($conn, $transferType);
        $transferType = trim($transferType);

        $receivingReport = $_POST['receivingReport'];
        $receivingReport = mysqli_real_escape_string($conn, $receivingReport);
        $receivingReport = trim($receivingReport);
        $receivingReport = strip_tags($receivingReport);
        $receivingReport = strtoupper($receivingReport);

        $sql = "INSERT INTO tbl_item_history VALUES(NULL,
                                                     ".$item_id.",
                                                     3,
                                                     now(),
                                                     '".$date."',
                                                     '".$reference_id."',
                                                     '".$referenceNumber."',
                                                     '".$receivingReport."',
                                                     '".$transferType."',
                                                     ".$unitCost.",
                                                     ".$quantity.",
                                                     'N/A',
                                                     'N/A',
                                                     'N/A',
                                                     ".$_SESSION['user_id'].",
                                                     'N/A');";                    
        $retval = mysqli_query($conn, $sql);

        if ($retval) {                                                            
            echo "<script>alert('ITEM UPDATED SUCCESSFULLY.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            exit();
        } else {
            echo "<script>alert('AN ERROR OCCURED. UPDATED NOT SAVED. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            exit();
        }
        mysqli_close($conn);
    }
 ?>