<?php
//Include database connection
require '../../../database.php';
if($_POST['history_id']) {
    $history_id = $_POST['history_id']; //escape string
    // Run the Query
    $sql = "SELECT tbl_item_history.history_id, 
                    tbl_item_history.item_id, 
                    tbl_reference.referenceType, 
                    tbl_item_history.referenceNumber 
            FROM tbl_item_history 
            INNER JOIN tbl_reference
            ON tbl_item_history.reference_id = tbl_reference.reference_id
            WHERE history_id = ".$history_id.";";
    $result = mysqli_query($conn, $sql);
    // Fetch Records
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
            $history_id = $row[0];
            $item_id = $row[1];
            $referenceType = $row[2];
            $referenceNumber = $row[3];
		}
	}
    // Echo the data you want to show in modal
 } else {
    header("Location: ../index.php"); // Redirecting to All Records Page
 }
?>

 <form role="form" class="form-horizontal" action="phpScripts/deleteHistory.php" method="post">
    <input type="hidden" name="history_id" value="<?php echo $history_id;?>"/>
    <input type="hidden" name="item_id" value="<?php echo $item_id;?>"/>
    <h4 class="text-danger">Are you sure you want to permanently delete this row?<br></h4>
    <div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th class="text-center" bgcolor="#e5e5e5">ID</th>
                    <th class="text-center" bgcolor="#f2ba7f">Reference&nbsp;Type</th>
                    <th class="text-center" bgcolor="#f2ba7f">Reference&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $history_id; ?></td>
                    <td class="text-center"><?php echo $referenceType ?></td>
                    <td class="text-center"><?php echo $referenceNumber ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <strong>Warning</strong>: This action is <strong>irreversable</strong><br><br>  
    <button type="submit" class="btn btn-danger col-sm-8 col-sm-offset-2" ><span class="glyphicon glyphicon-exclamation-sign"></span> Delete</button>
</form>