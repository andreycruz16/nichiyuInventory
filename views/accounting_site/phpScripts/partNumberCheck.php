<?php 
	if(!empty($_POST['partNumber'])) {
        	require '../../../database.php';

                $partNumber = mysqli_real_escape_string($conn, $_POST['partNumber']);
                $partNumber = trim($partNumber);

                $sql = "SELECT tbl_item.partNumber FROM tbl_item WHERE tbl_item.partNumber = '".$partNumber."' AND dept_id = 4 AND status = 0;";
                if(!$result = mysqli_query($conn, $sql)) {
                	exit(mysqli_error($conn));
                }

                if(mysqli_num_rows($result) > 0) {
                	echo '<div style="color: red;"><strong>'.$partNumber.' already exists!</strong></div>';
                } else {
                	echo '<div style="color: green;"><strong>'.$partNumber.' is available!</strong></div>';
                }
	}
 ?>