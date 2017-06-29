<?php
//Include database connection
session_start();
require '../../../database.php';
if($_POST['item_id']) {
    $item_id = $_POST['item_id']; //escape string
    // Run the Query
    $sql = "SELECT 
            tbl_item_history.item_id,
            tbl_item.description,
            tbl_item.partNumber,
            tbl_item.boxNumber,
            tbl_item.minStockCount,
            SUM(tbl_item_history.quantity),
            tbl_item_history.dept_id
            FROM tbl_item_history
            INNER JOIN tbl_item
            ON tbl_item.item_id = tbl_item_history.item_id
            WHERE tbl_item_history.dept_id = 3
            AND tbl_item.status = 0
            AND tbl_item_history.item_id = ".$item_id."
            GROUP By tbl_item_history.item_id;";
    $result = mysqli_query($conn, $sql);
    // Fetch Records
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
            $item_id = $row[0];
            $description = $row[1];
			$partNumber = $row[2];
            $boxNumber = $row[3];
            $minStockCount = $row[4];
            $quantity = $row[5];
            $dept_id = $row[6];
		}
	}
    // Echo the data you want to show in modal
 } else {
    header("Location: ../index.php"); // Redirecting to All Records Page
 }
?>
<div class="modal-header modal-danger">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 class="modal-title">TRANSACTION TYPE: OUT</h3>
    <h4 class="modal-title">Update Item: "<?php echo $description; ?>" (<?php echo $partNumber; ?>)</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">               
<!--             <div class="form-group">
                <label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label><strong>Required</strong>
                <label class="text-primary"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label><strong>Optional</strong>
            </div> -->
            <form role="form" class="form-horizontal" action="phpScripts/stockOut.php" method="post">  
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Date:</span>
                    <div class="input-group date form_date col-md-12">
                        <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="YYYY-MM-DD" required>
                    </div>
                </div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Reference:</span>
                    <select class="form-control" name="reference_id" id="reference_id_out" required>
                        <option value="" selected disabled>Document Type</option>
                        <?php 
                            $sql = "SELECT * FROM tbl_reference WHERE reference_id != 0 AND inOrOut = 0 OR inOrOut = -1;";

                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                    $reference_id = $row[0];
                                    $referenceName = $row[1];
                        ?>
                            <option value="<?php echo $reference_id; ?>"><?php echo $referenceName; ?></option>


                        <?php 
                                }
                            }
                            mysqli_close($conn);
                        ?>                        
                    </select>
                    <input type="text" name="referenceNumber" class="form-control" id="referenceNumber_out" placeholder="Reference Number" aria-describedby="basic-addon1" required autocomplete="on">
                    <input type="text" name="receivingReport" class="form-control" id="receivingReport_out" placeholder="Receiving Report" aria-describedby="basic-addon1" autocomplete="on">
                </div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Details:</span>
                    <input type="text" name="customerName" class="form-control" id="customerName" placeholder="Customer Name" aria-describedby="basic-addon1" required autocomplete="on">
                    <input type="text" name="details" class="form-control" id="details" placeholder="Details (Optional)" aria-describedby="basic-addon1" autocomplete="on">
                </div>
                <br>
                <h5><strong><?php echo $description; ?> Current Quantity: <span class="text-success"><?php echo $quantity; ?></span></strong></h5>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Quantity (OUT):</span>
                    <input type="number" min="1" name="quantity" class="form-control" id="quantity" placeholder="0" aria-describedby="basic-addon1" required autocomplete="off">
                </div>
                <input type="hidden" name="transferType" id="transferType" value="OUT">
                <input type="hidden" name="description" id="description" value="<?php echo $description; ?>"> 
                <input type="hidden" name="partNumber" id="partNumber" value="<?php echo $partNumber; ?>"> 
                <input type="hidden" name="item_id" id="item_id" value="<?php echo $item_id; ?>"> 
                <input type="hidden" name="oldQuantity" id="oldQuantity" value="<?php echo $quantity; ?>"> 
                <br>
                <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> Update</button>
                <br>
            </form>   
        </div>   
        <div class="col-md-1"></div>       
    </div>
</div>
<script>
    $('#referenceNumber_out').fadeOut().val("N/A");
    $('#receivingReport_out').fadeOut().val("N/A");

    $('#reference_id_out').change(function(event) {
        if($(this).val() == '1') {//Purchase Order
            $('#referenceNumber_out').fadeIn().val("");
            $('#referenceNumber_out').attr('placeholder', 'Reference Number');
            $('#receivingReport_out').fadeIn().val("");
        } else if($(this).val() == '2') {//Transfer Ticket
            $('#referenceNumber_out').fadeIn().val("");
            $('#referenceNumber_out').attr('placeholder', 'Reference Number');
            $('#receivingReport_out').fadeOut().val("N/A");
        } else if($(this).val() == '4') { //INVOICE
            $('#referenceNumber_out').fadeIn().val("");
            $('#referenceNumber_out').attr('placeholder', 'Reference Number / DR: Delivery Receipt');
            $('#receivingReport_out').fadeOut().val("N/A");
        } else if($(this).val() == '5') { //Delivery Receipt
            $('#referenceNumber_out').fadeIn().val("");
            $('#referenceNumber_out').attr('placeholder', 'Reference Number');
            $('#receivingReport_out').fadeOut().val("N/A");
        } else if($(this).val() == '7') {//Physical Count
            $('#referenceNumber_out').fadeIn().val("Physical Count");
            $('#referenceNumber_out').attr('placeholder', 'Reference Number');
            $('#receivingReport_out').fadeOut().val("N/A");
        } else {
            $('#referenceNumber_out').fadeIn().val("");
            $('#referenceNumber_out').attr('placeholder', 'Reference Number');
            $('#receivingReport_out').fadeOut().val("N/A");
        }
    });    
</script>