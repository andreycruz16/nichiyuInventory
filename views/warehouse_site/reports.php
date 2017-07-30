<?php
    include('session.php');
    require '../../database.php';  
 ?>

<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php") ?>
<style>
 #recentStockDetails .modal-header {
      background-color: #3c8dbc;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }    
</style>
<body>
    <div id="wrapper">
        <!-- TOP NAVIGATION -->
        <?php include("includes/topNavigation.php") ?>
        <!-- SIDE NAVIGATION -->
        <?php include("includes/sideNavigation.php") ?>

        <!-- WRAPPER START  -->
        <!-- WRAPPER START  -->
        <!-- WRAPPER START  -->

		<div id="page-wrapper">
            <div class="header"> 
                <h2 class="page-header">
                    <code class="text-success">REPORTS</code>
                </h2>
                <ol class="breadcrumb">
                    <li class="active">Reports</li>
                </ol>
            </div>
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Inventory List
                            </div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <form role="form" class="form-horizontal" target="_blank" action="physicalCountReport.php" method="get">
                                        <div class="input-group date form_date col-md-12">
                                            <input id="date" name="date" class="form-control" type="hidden" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>From:</b></span>
                                            <div class="input-group date form_date col-md-12">
                                                <input id="dateFrom" name="dateFrom" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
                                            <div class="input-group date form_date col-md-12">
                                                <input id="dateTo" name="dateTo" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Low Stocks
                            </div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <form role="form" class="form-horizontal" target="_blank" action="lowStocksReport.php" method="get">
                                        <div class="input-group date form_date col-md-12">
                                            <input id="date" name="date" class="form-control" type="hidden" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>From:</b></span>
                                            <div class="input-group date form_date col-md-12">
                                                <input id="dateFrom" name="dateFrom" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
                                            <div class="input-group date form_date col-md-12">
                                                <input id="dateTo" name="dateTo" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Out of Stocks
                            </div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <form role="form" class="form-horizontal" target="_blank" action="outOfStocksReport.php" method="get">
                                        <div class="input-group date form_date col-md-12">
                                            <input id="date" name="date" class="form-control" type="hidden" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>From:</b></span>
                                            <div class="input-group date form_date col-md-12">
                                                <input id="dateFrom" name="dateFrom" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
                                            <div class="input-group date form_date col-md-12">
                                                <input id="dateTo" name="dateTo" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- SPECIFIC ITEM TYPE REPORTS -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Specific Reports
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Item Type
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="reportScript.php" method="post">
                                                        <div class="input-group col-md-12">
                                                            <select class="form-control" name="itemType_id" id="itemType_id_in" required>
                                                                <option value="" selected disabled>Item Type</option>
                                                                <?php 
                                                                    require '../../database.php'; 

                                                                    $sql = "SELECT * FROM tbl_itemtype;";

                                                                    $result = mysqli_query($conn, $sql);
                                                                    if (mysqli_num_rows($result) > 0) {
                                                                        while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                                            $itemType_id = $row[0];
                                                                            $itemTypeName = $row[1];
                                                                ?>
                                                                    <option value="<?php echo $itemType_id; ?>"><?php echo $itemTypeName; ?></option>


                                                                <?php 
                                                                        }
                                                                    }
                                                                    mysqli_close($conn);
                                                                ?>                         
                                                            </select>
    
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="hidden" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                            <div class="input-group col-md-12">
                                                                <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>From:</b></span>
                                                                <div class="input-group date form_date col-md-12">
                                                                    <input id="dateFrom" name="dateFrom" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <div class="input-group col-md-12">
                                                                <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
                                                                <div class="input-group date form_date col-md-12">
                                                                    <input id="dateTo" name="dateTo" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                                </div>
                                                            </div><br>

                                                            <input type="hidden">
                                                            <input type="submit" class="btn btn-block btn-md btn-primary" title="buttonGenuine" value="Generate Report">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Document Type
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="reportScript.php" method="post">
                                                        <div class="input-group col-md-12">
                                                            <select class="form-control" name="reference_id" id="reference_id_in" required>
                                                                <option value="" selected disabled>Document Type</option>
                                                                <?php 
                                                                    require '../../database.php'; 

                                                                    $sql = "SELECT * FROM tbl_reference WHERE reference_id != 0;";

                                                                    $result = mysqli_query($conn, $sql);
                                                                    if (mysqli_num_rows($result) > 0) {
                                                                        while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                                            $reference_id = $row[0];
                                                                            $referenceType = $row[1];
                                                                ?>
                                                                    <option value="<?php echo $reference_id; ?>"><?php echo $referenceType; ?></option>


                                                                <?php 
                                                                        }
                                                                    }
                                                                    mysqli_close($conn);
                                                                ?>                         
                                                            </select>
    
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="hidden" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                            <div class="input-group col-md-12">
                                                                <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>From:</b></span>
                                                                <div class="input-group date form_date col-md-12">
                                                                    <input id="dateFrom" name="dateFrom" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                            <div class="input-group col-md-12">
                                                                <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
                                                                <div class="input-group date form_date col-md-12">
                                                                    <input id="dateTo" name="dateTo" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                                </div>
                                                            </div><br>

                                                            <input type="hidden">
                                                            <input type="submit" class="btn btn-block btn-md btn-primary" title="buttonGenuine" value="Generate Report">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                            </div>
                        </div>
                    </div>                   
                </div>
                <div class="row">
                    <!-- SPECIFIC ITEM REPORTS -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Specific Item Reports
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="specificItemReport">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="#e5e5e5" width="10">ID</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                <!-- <th class="text-center" bgcolor="#f2ba7f" width="">Minimum Stock Count</th> -->
                                                <th class="text-center" bgcolor="#f2ba7f" width="10">Action</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                <!-- <th class="text-center" bgcolor="#f2ba7f" width="">Minimum Stock Count</th> -->
                                                <td class="text-center" bgcolor="#f2ba7f" width=""></td> 
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
                                            require '../../database.php';
                                            $sql = "SELECT 
                                                tbl_item_history.item_id,
                                                tbl_item.description,
                                                tbl_item.partNumber,
                                                tbl_item.boxNumber,
                                                tbl_item.minStockCount,
                                                SUM(tbl_item_history.quantity),
                                                tbl_item_history.userType_id
                                                FROM tbl_item_history
                                                INNER JOIN tbl_item
                                                ON tbl_item.item_id = tbl_item_history.item_id
                                                WHERE tbl_item.userType_id = ".$_SESSION['userType_id']." AND tbl_item.status = 0
                                                GROUP By tbl_item_history.item_id;";
                                                                                                            
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                    $item_id = $row[0];
                                                    $description = $row[1];
                                                    $partNumber = $row[2];
                                                    $boxNumber = $row[3];
                                                    $minStockCount = $row[4];
                                                    $quantity = $row[5];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $item_id; ?></td>
                                                <td class="text-center"><?php echo $partNumber; ?></td>
                                                <td class="text-center"><?php echo $description; ?></td>
                                                <td class="text-center"><?php echo $quantity; ?></td>
                                                <!-- <td class="text-center"><?php echo $minStockCount; ?></td> -->
                                                <td class="text-center">
                                                    <a href="generateReport.php?item_id=<?php echo $item_id; ?>&amp;partNumber=<?php echo $partNumber; ?>&amp;description=<?php echo $description; ?>&amp;quantity=<?php echo $quantity; ?>" class="btn btn-primary btn-xs">Generate Report <span class="glyphicon glyphicon-list-alt"></span></a>
                                                </td>
                                            </tr>
                                        <?php 
                                                }
                                            }
                                                mysqli_close($conn);
                                        ?>                                          
                                        </tbody>                                            
                                    </table>
                                </div>                                                
                            </div>
                        </div>
                    </div>                   
                </div>                    
				<?php include("includes/footer.php") ?>
            </div>
        </div>

        <!-- WRAPPER END  -->
        <!-- WRAPPER END  -->
        <!-- WRAPPER END  -->
    </div>

    <!-- STOCK IN MODAL -->                                                     
    <div id="stockIn" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-center">
                <div class="fetched-data-stockInModal"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>  

    <?php include("includes/scripts.php") ?>
    <script>
        $(document).ready(function(){
            $('#stockIn').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_stockInModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-stockInModal').html(data);//Show fetched data from database
                    }
                });
             });
        });
            
            $(document).ready(function () {
                $('#specificItemReport').dataTable({
                'iDisplayLength': 15, 
                'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
                'order': [ 1, 'asc' ],
                'bSort': true
                 });
            });

            $(document).ready(function() {
                var table = $('#specificItemReport').DataTable();
             
                $("#specificItemReport tfoot th").each( function ( i ) {
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            table.column( i )
                                .search( $(this).val() )
                                .draw();
                        } );
             
                    table.column( i ).data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );           
            } );             

            function printTable() { 
                popupWindow = window.open('table-print/reportSummary.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=950, height=600,top=200,left=200");
            } 

        // $('#buttonGenuine').fadeOut().val("N/A");
        // $('#buttonLocal').fadeOut().val("N/A");
        // $('#buttonForklift').fadeOut().val("N/A");
        // $('#buttonBattery').fadeOut().val("N/A");
        // $('#buttonCharger').fadeOut().val("N/A");
        // $('#buttonHandPallet').fadeOut().val("N/A");
        // $('#buttonAttachments').fadeOut().val("N/A");

        // $('#itemType_id_in').change(function(event) {
        //     if($(this).val() == '1') {//Genuine Parts
        //         $('#buttonGenuine').fadeIn().val("");
        //         $('#buttonGenuine').attr('placeholder', 'Generate Report');
        //         $('#buttonLocal').fadeOut().val("N/A");
        //         $('#buttonForklift').fadeOut().val("N/A");
        //         $('#buttonBattery').fadeOut().val("N/A");
        //         $('#buttonCharger').fadeOut().val("N/A");
        //         $('#buttonHandPallet').fadeOut().val("N/A");
        //         $('#buttonAttachments').fadeOut().val("N/A");
        //     } else if($(this).val() == '2') {//Local Parts
        //         $('#buttonLocal').fadeIn().val("");
        //         $('#buttonLocal').attr('placeholder', 'Generate Report');
        //         $('#buttonGenuine').fadeOut().val("N/A");
        //         $('#buttonForklift').fadeOut().val("N/A");
        //         $('#buttonBattery').fadeOut().val("N/A");
        //         $('#buttonCharger').fadeOut().val("N/A");
        //         $('#buttonHandPallet').fadeOut().val("N/A");
        //         $('#buttonAttachments').fadeOut().val("N/A");
        //     } else if($(this).val() == '3') { //Battery Units
        //         $('#buttonForklift').fadeIn().val("");
        //         $('#buttonForklift').attr('placeholder', 'Generate Report');
        //         $('#buttonLocal').fadeOut().val("N/A");
        //         $('#buttonGenuine').fadeOut().val("N/A");
        //         $('#buttonBattery').fadeOut().val("N/A");
        //         $('#buttonCharger').fadeOut().val("N/A");
        //         $('#buttonHandPallet').fadeOut().val("N/A");
        //         $('#buttonAttachments').fadeOut().val("N/A");
        //     } else if($(this).val() == '4') { //Delivery Receipt
        //         $('#buttonBattery').fadeIn().val("");
        //         $('#buttonBattery').attr('placeholder', 'Generate Report');
        //         $('#buttonLocal').fadeOut().val("N/A");
        //         $('#buttonGenuine').fadeOut().val("N/A");
        //         $('#buttonForklift').fadeOut().val("N/A");
        //         $('#buttonCharger').fadeOut().val("N/A");
        //         $('#buttonHandPallet').fadeOut().val("N/A");
        //         $('#buttonAttachments').fadeOut().val("N/A");
        //     } else if($(this).val() == '5') {//Physical Count
        //         $('#buttonCharger').fadeIn().val("Physical Count");
        //         $('#buttonCharger').attr('placeholder', 'Generate Report');
        //         $('#buttonLocal').fadeOut().val("N/A");
        //         $('#buttonGenuine').fadeOut().val("N/A");
        //         $('#buttonForklift').fadeOut().val("N/A");
        //         $('#buttonBattery').fadeOut().val("N/A");
        //         $('#buttonHandPallet').fadeOut().val("N/A");
        //         $('#buttonAttachments').fadeOut().val("N/A");;
        //     } else if($(this).val() == '6') {
        //         $('#buttonHandPallet').fadeIn().val("");
        //         $('#buttonHandPallet').attr('placeholder', 'Generate  Report');
        //         $('#buttonLocal').fadeOut().val("N/A");
        //         $('#buttonGenuine').fadeOut().val("N/A");
        //         $('#buttonForklift').fadeOut().val("N/A");
        //         $('#buttonBattery').fadeOut().val("N/A");
        //         $('#buttonCharger').fadeOut().val("N/A");
        //         $('#buttonAttachments').fadeOut().val("N/A");
        //     } else if($(this).val() == '7') {
        //         $('#buttonAttachments').fadeIn().val("");
        //         $('#buttonAttachments').attr('placeholder', 'Generate Report');
        //         $('#buttonLocal').fadeOut().val("N/A");
        //         $('#buttonGenuine').fadeOut().val("N/A");
        //         $('#buttonForklift').fadeOut().val("N/A");
        //         $('#buttonBattery').fadeOut().val("N/A");
        //         $('#buttonCharger').fadeOut().val("N/A");
        //         $('#buttonHandPallet').fadeOut().val("N/A");
        //     }
        // });                  
    </script>
</body>
</html> 