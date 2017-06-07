<?php
//Include database connection
require '../../../database.php';
?>
<div class="modal-header modal-danger">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 class="modal-title">ADD NEW ITEM</h3>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">               
            <form role="form" class="form-horizontal" action="phpScripts/addNewItem.php" method="post">  
<!--                 <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Date:</span>
                    <div class="input-group date form_date col-md-12">
                        <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="YYYY-MM-DD" required>
                    </div>
                </div> -->
                <!-- <br> -->
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Part Number/Model:</span>
                    <input type="text" name="partNumber" class="form-control" id="partNumber" placeholder="Part Number" aria-describedby="basic-addon1" autocomplete="off" required>
                </div>
                    <div id="status"></div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Description/Serial:</span>
                    <input type="text" name="description" class="form-control" id="" placeholder="Description" aria-describedby="basic-addon1" autocomplete="on" required>
                </div>
                <br>
<!--                 <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Reference:</span>
                    <select class="form-control" name="reference_id" id="reference_id_add" required>
                        <option value="" selected disabled>Reference Type</option>
                        <?php 
                            $sql = "SELECT * FROM tbl_reference WHERE reference_id != 0;";

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
                    <input type="text" name="referenceNumber" class="form-control" id="referenceNumber_add" placeholder="Reference Number" aria-describedby="basic-addon1" required autocomplete="on">
                    <input type="text" name="receivingReport" class="form-control" id="receivingReport_add" placeholder="Receiving Report" aria-describedby="basic-addon1" autocomplete="on">
                </div>
                <br> -->
<!--                 <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Unit Cost:</span>
                    <span class="input-group-addon" id="basic-addon1">₱</span>
                    <input type="number" min="0" name="unitCost" class="form-control" id="unitCost" placeholder="0.00" step="0.01" aria-describedby="basic-addon1" required autocomplete="off">
                </div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Quantity (IN):</span>
                    <input type="number" min="0" name="quantity" class="form-control" id="quantity" placeholder="0" aria-describedby="basic-addon1" required autocomplete="off">
                </div>
                <br> -->
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Order Point:</span>
                    <input type="number" class="form-control" name="orderPoint" id="orderPoint" placeholder="Minimum Stock Count" autocomplete="off" required>
                </div>
                <input type="hidden" name="transferType" id="transferType" value="IN">
                <br>
                <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                <br>
            </form>   
        </div>  
        <div class="col-md-1"></div>        
    </div>
</div>

<script>
    $('#reference_id_add').change(function(event) {
        if($(this).val() == '1' || $(this).val() == '2') {
            $('#referenceNumber_add').fadeIn().val("");
            $('#receivingReport_add').fadeIn().val("");

        } else if($(this).val() == '7') {
            $('#referenceNumber_add').fadeIn().val("Physical Count");
            $('#receivingReport_add').fadeOut().val("N/A");

        } else {
            $('#referenceNumber_add').fadeIn().val("");
            $('#receivingReport_add').fadeOut().val("N/A");
        }
    }); 

    $('#partNumber').keyup(function(event) {
        var partNumber = $('#partNumber').val();
        if(partNumber.length > 2) {
            $('#status').html('Checking availability...');
            $.post("phpScripts/partNumberCheck.php", {partNumber: partNumber}, function(data, status) {
                $("#status").html(data);
            })
        } else if(partNumber.length < 2) {
            $("#status").html('');
        }
    });   
</script>