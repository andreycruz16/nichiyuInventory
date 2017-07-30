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

        $oldUnitCost = $_POST['oldUnitCost'];
        $oldUnitCost = mysqli_real_escape_string($conn, $oldUnitCost);
        $oldUnitCost = trim($oldUnitCost);

        $quantity = $_POST['quantity'];
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $quantity = trim($quantity);

        $oldQuantity = $_POST['oldQuantity'];
        $oldQuantity = mysqli_real_escape_string($conn, $oldQuantity);
        $oldQuantity = trim($oldQuantity);

        // if($quantity > $oldQuantity) {
        //     echo "<script>alert('ENTER A VALID QUANTITY. UPDATE NOT SAVED. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
        //     exit();
        // }
        $quantity = -abs($quantity); //converts positive number to negative

        $transferType = $_POST['transferType'];
        $transferType = mysqli_real_escape_string($conn, $transferType);
        $transferType = trim($transferType);

        $customerName = $_POST['customerName'];
        $customerName = mysqli_real_escape_string($conn, $customerName);
        $customerName = trim($customerName);
        $customerName = strip_tags($customerName);
        $customerName = strtoupper($customerName);

        $details = $_POST['details'];
        if($details == "") { $details = 'N/A'; };
        $details = mysqli_real_escape_string($conn, $details);
        $details = trim($details);
        $details = strip_tags($details);
        $details = strtoupper($details);

        $sql = "INSERT INTO tbl_item_history VALUES(NULL,
                                                     ".$item_id.",
                                                     ".$_SESSION['userType_id'].",
                                                     now(),
                                                     '".$date."',
                                                     '".$reference_id."',
                                                     '".$referenceNumber."',
                                                     'N/A',
                                                     '".$transferType."',
                                                     ".$oldUnitCost.",
                                                     ".$quantity.",
                                                     '".$customerName."',
                                                     '".$details."',
                                                     ".$_SESSION['user_id'].",
                                                     'N/A');";        
        $retval = mysqli_query($conn, $sql);
        if ($retval) {
            echo "<script>alert('ITEM UPDATED SUCCESSFULLY.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            exit();
        } else {
            echo "<script>alert('AN ERROR OCCURED. UPDATE NOT SAVED. CHECK YOUR INPUTS. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            exit();
        }
        mysqli_close($conn);
    }
 ?>