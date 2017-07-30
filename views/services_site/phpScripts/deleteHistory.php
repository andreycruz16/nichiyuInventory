<script>
<?php 
    session_start();
	require '../../../database.php';

    if (!empty($_POST)) {
        $history_id = $_POST['history_id'];
        $item_id = $_POST['item_id'];

        // DELETE RECORD QUERY
        $sql = "DELETE FROM tbl_item_history WHERE history_id = ".$history_id.";";        
        mysqli_query($conn, $sql);

        echo "alert('HISTORY DELETED SUCCESSFULLY.'); window.location.href = '../moreDetails.php?item_id=" .  $item_id . "';";
    } else {
           echo "alert('AN ERROR OCCURED. HISTORY NOT DELETED.'); window.location.href = '.../moreDetails.php?item_id=" .  $item_id . "';";
    }

    mysqli_close($conn);
 ?>
</script>