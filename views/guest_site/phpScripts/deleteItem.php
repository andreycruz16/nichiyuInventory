<?php 
    session_start();
	require '../../../database.php';

    if (!empty($_POST)) {
        $item_id = $_POST['item_id'];

        $description = $_POST['description'];
        $description = mysqli_real_escape_string($conn, $description);
        $description = trim($description);

        $partNumber = $_POST['partNumber'];
        $partNumber = mysqli_real_escape_string($conn, $partNumber);
        $partNumber = trim($partNumber);

        // DELETE RECORD QUERY
        $sql = "UPDATE
                tbl_item
                SET
                tbl_item.status = 1
                WHERE
                tbl_item.item_id = ".$item_id.";";        
        mysqli_query($conn, $sql);

        echo "<script>alert('ITEM DELETED SUCCESSFULLY.'); window.location.href = '../index.php'</script>";
    } else {
           echo "<script>alert('AN ERROR OCCURED. ITEM NOT DELETED.'); window.location.href = '../index.php'</script>";
    }

    mysqli_close($conn);
 ?>