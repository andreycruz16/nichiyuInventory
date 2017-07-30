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
                    <span class="text-success">REPORTS</span>
                </h2>
                <ol class="breadcrumb">
                    <li class="active">Reports</li>
                </ol>
            </div>
            <div id="page-inner">
                <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Tally Report
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="panel-body">
                                    <div class="text-center">
                                        <form role="form" class="form-horizontal" target="_blank" action="tallyReport.php" method="get">
                                            <div class="input-group col-md-12">
                                                <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                <div class="input-group date form_date col-md-12">
                                                    <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-block btn-md btn-success"></span><strong>Generate Report</strong>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-print"></span></button>
                                        </form>
                                    </div>            
                                    </div>            
                                </div>                  
                            </div>
                        </div>
                    </div>                 
                </div>
                <div class="row">                  
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Physical Count
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Warehouse Department
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="physicalCountReportWarehouse.php" method="get">
                                                        <div class="input-group col-md-12">
                                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Service Department
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="physicalCountReportService.php" method="get">
                                                        <div class="input-group col-md-12">
                                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Accounting Department
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="physicalCountReportAccounting.php" method="get">
                                                        <div class="input-group col-md-12">
                                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Low Stocks
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Warehouse Department
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="lowStocksReportWarehouse.php" method="get">
                                                        <div class="input-group col-md-12">
                                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Service Department
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="lowStocksReportService.php" method="get">
                                                        <div class="input-group col-md-12">
                                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Accounting Department
                                            </div>
                                            <div class="panel-body">
                                                <div class="text-center">
                                                    <form role="form" class="form-horizontal" target="_blank" action="lowStocksReportAccounting.php" method="get">
                                                        <div class="input-group col-md-12">
                                                            <span class="input-group-addon" id="basic-addon1"><label class="text-danger"></label> <b>Date:</b></span>
                                                            <div class="input-group date form_date col-md-12">
                                                                <input id="date" name="date" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-block btn-md btn-primary"></span> <b>Generate Report</b>&nbsp;&nbsp;<span class="glyphicon glyphicon glyphicon-list-alt"></span></button>
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
                                (Warehouse) Specific Item Reports
                            </div>
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover" id="specificItemReportWarehouse">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="10">ID</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <!-- <th class="text-center" bgcolor="#f2ba7f" width="">Minimum Stock Count</th> -->
                                                    <th class="text-center" bgcolor="#f2ba7f" width="10">Action</th> 
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
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
                                                    tbl_item_history.dept_id
                                                    FROM tbl_item_history
                                                    INNER JOIN tbl_item
                                                    ON tbl_item.item_id = tbl_item_history.item_id
                                                    WHERE tbl_item_history.dept_id = 2 AND tbl_item.status = 0
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
                                                        <a href="generateReportWarehouse.php?item_id=<?php echo $item_id; ?>&amp;partNumber=<?php echo $partNumber; ?>&amp;description=<?php echo $description; ?>&amp;quantity=<?php echo $quantity; ?>" class="btn btn-primary btn-xs">Generate Report <span class="glyphicon glyphicon-list-alt"></span></a>
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
                <div class="row">
                    <!-- SPECIFIC ITEM REPORTS -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                (Service) Specific Item Reports
                            </div>
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover" id="specificItemReportService">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="10">ID</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <!-- <th class="text-center" bgcolor="#f2ba7f" width="">Minimum Stock Count</th> -->
                                                    <th class="text-center" bgcolor="#f2ba7f" width="10">Action</th> 
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
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
                                                    tbl_item_history.dept_id
                                                    FROM tbl_item_history
                                                    INNER JOIN tbl_item
                                                    ON tbl_item.item_id = tbl_item_history.item_id
                                                    WHERE tbl_item_history.dept_id = 3 AND tbl_item.status = 0
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
                                                        <a href="generateReportService.php?item_id=<?php echo $item_id; ?>&amp;partNumber=<?php echo $partNumber; ?>&amp;description=<?php echo $description; ?>&amp;quantity=<?php echo $quantity; ?>" class="btn btn-primary btn-xs">Generate Report <span class="glyphicon glyphicon-list-alt"></span></a>
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
                <div class="row">
                    <!-- SPECIFIC ITEM REPORTS -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                (Accounting) Specific Item Reports
                            </div>
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-condensed table-hover" id="specificItemReportAccounting">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="10">ID</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Description</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Quantity</th>
                                                    <!-- <th class="text-center" bgcolor="#f2ba7f" width="">Minimum Stock Count</th> -->
                                                    <th class="text-center" bgcolor="#f2ba7f" width="10">Action</th> 
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-center" bgcolor="#e5e5e5" width="">ID</th>
                                                    <th class="text-center" bgcolor="#f2ba7f" width="">Part&nbsp;#/Model</th>
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
                                                    tbl_item_history.dept_id
                                                    FROM tbl_item_history
                                                    INNER JOIN tbl_item
                                                    ON tbl_item.item_id = tbl_item_history.item_id
                                                    WHERE tbl_item_history.dept_id = 4 AND tbl_item.status = 0
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
                                                        <a href="generateReportAccounting.php?item_id=<?php echo $item_id; ?>&amp;partNumber=<?php echo $partNumber; ?>&amp;description=<?php echo $description; ?>&amp;quantity=<?php echo $quantity; ?>" class="btn btn-primary btn-xs">Generate Report <span class="glyphicon glyphicon-list-alt"></span></a>
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

    <?php include("includes/scripts.php") ?>
    <script>
            
        $(document).ready(function () {
            $('#specificItemReportWarehouse').dataTable({
            'iDisplayLength': 15, 
            'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
            'order': [ 1, 'asc' ],
            'bSort': true
             });

            var table = $('#specificItemReportWarehouse').DataTable();
         
            $("#specificItemReportWarehouse tfoot th").each( function ( i ) {
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

            $('#specificItemReportService').dataTable({
            'iDisplayLength': 15, 
            'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
            'order': [ 1, 'asc' ],
            'bSort': true
             });

            var table = $('#specificItemReportService').DataTable();
         
            $("#specificItemReportService tfoot th").each( function ( i ) {
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

            $('#specificItemReportAccounting').dataTable({
            'iDisplayLength': 15, 
            'lengthMenu': [ [15, 25, 50, 100, -1], [15, 25, 50, 100, 'All'] ],
            'order': [ 1, 'asc' ],
            'bSort': true
             });

            var table = $('#specificItemReportAccounting').DataTable();
         
            $("#specificItemReportAccounting tfoot th").each( function ( i ) {
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


        });                      
    </script>
</body>
</html>

