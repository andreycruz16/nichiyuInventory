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

        $quantity = $_POST['quantity'];
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $quantity = trim($quantity);

        $oldQuantity = $_POST['oldQuantity'];
        $oldQuantity = mysqli_real_escape_string($conn, $oldQuantity);
        $oldQuantity = trim($oldQuantity);

        if($quantity > $oldQuantity) {
            echo "<script>alert('ENTER A VALID QUANTITY. UPDATE NOT SAVED. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            exit();
        }
        $quantity = -abs($quantity); //converts positive number to negative

        $transferType = $_POST['transferType'];
        $transferType = mysqli_real_escape_string($conn, $transferType);
        $transferType = trim($transferType);

        $customerName = $_POST['customerName'];
        $customerName = mysqli_real_escape_string($conn, $customerName);
        $customerName = trim($customerName);
        $customerName = strip_tags($customerName);
        $customerName = strtoupper($customerName);

        $model = $_POST['model'];
        if($model == "") { $model = 'N/A'; };
        $model = mysqli_real_escape_string($conn, $model);
        $model = trim($model);
        $model = strip_tags($model);
        $model = strtoupper($model);

        $serialNumber = $_POST['serialNumber'];
        if($serialNumber == "") { $serialNumber = 'N/A'; };
        $serialNumber = mysqli_real_escape_string($conn, $serialNumber);
        $serialNumber = trim($serialNumber);
        $serialNumber = strip_tags($serialNumber);
        $serialNumber = strtoupper($serialNumber);


        $sql = "INSERT INTO tbl_item_history VALUES(NULL,
                                                     ".$item_id.",
                                                     ".$_SESSION['userType_id'].",
                                                     now(),
                                                     '".$date."',
                                                     '".$reference_id."',
                                                     '".$referenceNumber."',
                                                     'N/A',
                                                     '".$transferType."',
                                                     0,
                                                     ".$quantity.",
                                                     '".$customerName."',
                                                     '".$model."',
                                                     '".$serialNumber."',
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