<?php 
    session_start();
	require '../../../database.php';
	if (!empty($_POST)) {
        $history_id = $_POST['history_id'];
        $history_id = mysqli_real_escape_string($conn, $history_id);
        $history_id = trim($history_id);

        $item_id = $_POST['item_id'];
        $item_id = mysqli_real_escape_string($conn, $item_id);
        $item_id = trim($item_id);        

        $date = $_POST['date'];
        $date = mysqli_real_escape_string($conn, $date);
        $date = trim($date);
        
        $reference_id = $_POST['reference_id'];
        $reference_id = mysqli_real_escape_string($conn, $reference_id);
        $reference_id = trim($reference_id);
        
        $referenceNumber = $_POST['referenceNumber'];
        $referenceNumber = mysqli_real_escape_string($conn, $referenceNumber);
        $referenceNumber = trim($referenceNumber);       
         
        $receivingReport = $_POST['receivingReport'];
        $receivingReport = mysqli_real_escape_string($conn, $receivingReport);
        $receivingReport = trim($receivingReport);

        // $stockOnHand = $_POST['stockOnHand'];
        // $stockOnHand = mysqli_real_escape_string($conn, $stockOnHand);
        // $stockOnHand = trim($stockOnHand);

        $transferType = $_POST['transferType'];
        $transferType = mysqli_real_escape_string($conn, $transferType);
        $transferType = trim($transferType);

        $quantity = $_POST['quantity'];
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $quantity = trim($quantity);

        $quantity = abs($quantity);

        if($transferType == 'OUT') {
            // echo '<script>';
            // echo 'console.log("'.$transferType.'");';
            // echo '</script>';
            // if($quantity > $stockOnHand) {
            //     echo "<script>alert('ENTER A VALID QUANTITY. UPDATE NOT SAVED. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
            //     exit();
            // }

            $quantity = -abs($quantity);
        }

        $customerName = $_POST['customerName'];
        $customerName = mysqli_real_escape_string($conn, $customerName);
        $customerName = trim($customerName);

        $details = $_POST['details'];
        $details = mysqli_real_escape_string($conn, $details);
        $details = trim($details);

        $comment = $_POST['comment'];
        $comment = mysqli_real_escape_string($conn, $comment);
        $comment = trim($comment);        

        $sql = "UPDATE
                  tbl_item_history
                SET
                  timestamp = now(),
                  date = '".$date."',
                  reference_id = ".$reference_id.",
                  referenceNumber = '".$referenceNumber."',
                  receivingReport = '".$receivingReport."',
                  transferType = '".$transferType."',
                  unitCost = 0,
                  quantity = ".$quantity.",
                  customerName = '".$customerName."',
                  details = '".$details."',
                  user_id = ".$_SESSION['user_id'].",
                  comment = '".$comment."'
                WHERE
                  history_id = ".$history_id.";";

        $retval = mysqli_query($conn, $sql);
        if ($retval) {
            echo "<script>alert('EDIT SUCCESSFUL.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
        } else {
            echo "<script>alert('AN ERROR OCCURED. UPDATE NOT SAVED. CHECK YOUR INPUTS. TRY AGAIN.'); window.location.href = '../moreDetails.php?item_id=".$item_id."'</script>";
        }     
        mysqli_close($conn);
    }
 ?>