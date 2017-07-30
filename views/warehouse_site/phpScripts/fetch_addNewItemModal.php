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
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Item Type:</span>
                    <select class="form-control" name="itemType_id" id="itemType_in" required>
                        <option value="" selected disabled>Item Type</option>
                        <?php 
                            $sql = "SELECT * FROM tbl_itemType;";

                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                    $itemType_id = $row[0];
                                    $itemTypeName = $row[1];
                                    $partOrUnit = $row[2];
                        ?>
                            <option value="<?php echo $itemType_id; ?>"><?php echo $itemTypeName; ?></option>
                        <?php 
                                }
                            }
                            mysqli_close($conn);
                        ?>   
                    </select>
                </div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Part Number/Model:</span>
                    <input type="text" name="partNumber" class="form-control" id="partNumber" placeholder="Part Number/Model" aria-describedby="basic-addon1" autocomplete="off">
                </div>
                    <div id="status"></div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Description/Serial:</span>
                    <input type="text" name="description" class="form-control" id="" placeholder="Description/Serial" aria-describedby="basic-addon1" autocomplete="on">
                </div>
                <br>
                <div class="input-group col-md-12">
                    <span class="input-group-addon" id="basic-addon1"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> Box Number:</span>
                    <input type="text" name="boxNumber" class="form-control" id="" placeholder="Box Number" aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <br>                
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