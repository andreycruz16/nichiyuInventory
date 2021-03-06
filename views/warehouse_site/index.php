<?php
    include('session.php');
    $GLOBALS['lowStocks'] = 0;
    $GLOBALS['outOfStocks'] = 0;
     $sql = "SELECT 
            tbl_item.minStockCount,
            SUM(tbl_item_history.quantity)
            FROM tbl_item_history
            INNER JOIN tbl_item
            ON tbl_item.item_id = tbl_item_history.item_id
            WHERE tbl_item_history.userType_id = ".$_SESSION['userType_id']."
            AND tbl_item.status = 0
            GROUP By tbl_item_history.item_id;";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result, MYSQL_NUM)) {
            $minStockCount = $row[0];
            $quantity = $row[1];

            if($quantity <= $minStockCount && $quantity > 0) {
                $GLOBALS['lowStocks']++;
            }
            else if($quantity == 0) {
                $GLOBALS['outOfStocks']++;
            }
        }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php") ?>
<style>
 #addNewItem .modal-header {
      background-color: #1b89ae;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }

 #stockIn .modal-header {
      background-color: #5cb85c;
      color: #fff;
      font-weight: bold;
      text-align: center;
 } 

 #stockOut .modal-header {
      background-color: #d9534f;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }     

#stockDelete .modal-header {
      background-color: #d9534f;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }
</style>
<body>

    <!-- WRAPPER START-->
    <!-- WRAPPER START-->
    <!-- WRAPPER START-->
    <div id="wrapper">
        <!-- TOP NAVIGATION -->
        <?php include("includes/topNavigation.php") ?>
        <!-- SIDE NAVIGATION -->
        <?php include("includes/sideNavigation.php") ?>
        
        <!-- PAGE CONTENT -->
		<div id="page-wrapper">
            <div class="header"> 
                <h2 class="page-header">
                    <code class="text-success">WAREHOUSE&nbsp;DEPARTMENT</code><br>
                    <code class="text-success">HOST ADDRESS: <?php echo $_SERVER['HTTP_HOST']; ?></code>
                </h2>
                <ol class="breadcrumb">
                    <li class="active">All Records</li>
                </ol>                
            </div>            
            <div id="page-inner">
                <div class="row">
                        <!-- RECORDS COUNT BOX     -->
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="panel panel-primary text-center no-boder blue">
                                <div class="panel-right">
                                    <?php 
                                        require '../../database.php';
                                        $sql = "SELECT COUNT(*) FROM tbl_item WHERE tbl_item.status = 0 AND userType_id = ".$_SESSION['userType_id'].";";
                                        $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQL_NUM); 
                                    ?>
                                    <h3><?php echo $row[0]; mysqli_close($conn); ?></h3>
                                   <div align="left" style="font-size:15px"><strong>Total # of Items</strong></div><br>
                                </div>
                            </div>
                        </div>
                        <!-- LOW STOCKS     -->
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="panel panel-primary text-center no-boder <?php if($GLOBALS['lowStocks'] > 0) echo "brown"; else echo "blue"; ?>">
                                <div class="panel-right">
                                    <h3><?php echo $GLOBALS['lowStocks']; ?></h3>
                                   <div align="left" style="font-size:15px"><strong>Total # of Low Stocks</strong></div><br>
                                </div>
                            </div>
                        </div>
                        <!-- OUT OF STOCKS     -->
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="panel panel-primary text-center no-boder <?php if($GLOBALS['outOfStocks'] > 0) echo "red"; else echo "blue"; ?>">
                                <div class="panel-right">
                                    <h3><?php echo $GLOBALS['outOfStocks']; ?></h3>
                                   <div align="left" style="font-size:15px"><strong>Total # of Out of Stocks</strong></div><br>
                                </div>
                            </div>
                        </div>                        
                        <!-- SERVER DATE & TIME BOX -->
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="panel panel-primary text-center no-boder blue">
                                    <div class="panel-right">
                                        <br>
                                        <!-- <div align="left" style="font-size:25px" id="time"></div> -->
                                        <div align="left" style="font-size:18px"><?php  echo date("h:i A"); ?></div>
                                        <div align="left" style="font-size:18px"><?php  echo date("F d, Y | l"); ?></div>
                                        <div align="left" style="font-size:15px"><strong> Server Date & Time</strong></div><br>
                                    </div>
                            </div>
                        </div>                    
                </div>  
                <div class="row">
                    <!-- CURRENT STOCK RECORDS (A-Z) -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <button class="btn btn-success btn" data-toggle-tooltip="tooltip" data-placement="top" title="" data-toggle="modal" data-target="#addNewItem">
                                  <span class="glyphicon glyphicon-plus"></span> Add New Item
                                </button>
                                &nbsp;All Items (Newest - Oldest)
                            </div> 
                            <div class="panel-body">
                            <p>
                                <b>NICHIYU PARTS</b> (
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT * FROM tbl_itemType WHERE partOrUnit = 0;";

                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                            $itemType_id = $row[0];
                                            $itemTypeName = $row[1];
                                            $partOrUnit = $row[2];
                                            echo $itemTypeName;
                                            echo ", ";
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>   
                                )
                            </p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="recordsTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="10">ID</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Part&nbsp;#/Model</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Description/Serial</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Item&nbsp;Type</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Box&nbsp;#</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Order&nbsp;Point</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Stock&nbsp;On&nbsp;Hand</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Status</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Transtactions</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
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
                                                    tbl_item_history.userType_id,
                                                    tbl_itemType.itemTypeName
                                                    FROM tbl_item_history
                                                    INNER JOIN tbl_item
                                                    ON tbl_item.item_id = tbl_item_history.item_id
                                                    INNER JOIN tbl_itemType
                                                    ON tbl_item.itemType_id = tbl_itemType.itemType_id
                                                    WHERE tbl_item_history.userType_id = ".$_SESSION['userType_id']." AND tbl_item.status = 0
                                                    AND tbl_itemType.partOrUnit = 0
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
                                                    $itemType = $row[7];

                                                    $sqlCost = "SELECT unitCost FROM tbl_item_history WHERE history_id=(SELECT max(history_id) FROM tbl_item_history WHERE item_id = ".$item_id." AND userType_id = ".$_SESSION['userType_id'].")";

                                                    $resultCost = mysqli_query($conn, $sqlCost);
                                                    $rowCost = mysqli_fetch_array($resultCost, MYSQL_NUM);
                                                    $unitCost = $rowCost[0];

                                        ?>
                                            <tr class="<?php if($quantity <= $minStockCount AND $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>">
                                                <td class="text-center"><?php  echo $item_id; ?></td>
                                                <td><?php  echo $partNumber; ?></td>
                                                <td><?php  echo $description; ?></td>
                                                <td class="text-center"><?php  echo $itemType; ?></td>
                                                <td class="text-center"><?php  echo $boxNumber; ?></td>
                                                <td class="text-center"><?php  echo $minStockCount; ?></td>
                                                <td class="text-center">                                                    
                                                    <strong><?php echo $quantity; ?></strong>
                                                </td>
                                                <td class="text-center" >
                                                    <span class="label label-<?php if($quantity <= $minStockCount && $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>"><?php if($quantity <= $minStockCount && $quantity > 0) echo "Low Stock"; else if($quantity == 0) echo "Out Of Stock"; else echo "Available";?></span>
                                                </td>
                                                <td class="text-center" >
                                                    <a href="moreDetails.php?item_id=<?php echo $item_id; ?>" class="btn btn-primary btn-xs">View Record <span class="glyphicon glyphicon-list-alt"></span></a>
                                                </td>
                                                <td class="text-center" style="white-space:nowrap;">
                                                    <button data-toggle="modal" data-target="#stockIn" data-toggle-tooltip="tooltip" title="IN" class="btn btn-success btn-xs" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-plus"></span></button>
                                                    <button data-toggle="modal" data-target="#stockOut" data-toggle-tooltip="tooltip" title="OUT" class="btn btn-danger btn-xs" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-minus"></span></button> 
                                                    <!-- <button type="button" class="btn btn-danger btn-xs" title="Delete" data-toggle="modal" data-target="#stockDelete" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-trash"></span></button>     -->
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
                             <div class="panel-body">
                             <p>
                                <b>NICHIYU UNITS</b> (
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT * FROM tbl_itemType WHERE partOrUnit = 1;";

                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                            $itemType_id = $row[0];
                                            $itemTypeName = $row[1];
                                            $partOrUnit = $row[2];
                                            echo $itemTypeName;
                                            echo ", ";
                                        }
                                    }
                                    mysqli_close($conn);
                                ?>   
                                )
                            </p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="recordsTableUnits">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="10">ID</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Brand/Specification</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Serial&nbsp;Number</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Item&nbsp;Type</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Box&nbsp;#</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Order&nbsp;Point</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Stock&nbsp;On&nbsp;Hand</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Status</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Transtactions</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
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
                                                    tbl_item_history.userType_id,
                                                    tbl_itemType.itemTypeName
                                                    FROM tbl_item_history
                                                    INNER JOIN tbl_item
                                                    ON tbl_item.item_id = tbl_item_history.item_id
                                                    INNER JOIN tbl_itemType
                                                    ON tbl_item.itemType_id = tbl_itemType.itemType_id
                                                    WHERE tbl_item_history.userType_id = ".$_SESSION['userType_id']." AND tbl_item.status = 0
                                                    AND tbl_itemType.partOrUnit = 1
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
                                                    $itemType = $row[7];

                                                    $sqlCost = "SELECT unitCost FROM tbl_item_history WHERE history_id=(SELECT max(history_id) FROM tbl_item_history WHERE item_id = ".$item_id." AND userType_id = ".$_SESSION['userType_id'].")";

                                                    $resultCost = mysqli_query($conn, $sqlCost);
                                                    $rowCost = mysqli_fetch_array($resultCost, MYSQL_NUM);
                                                    $unitCost = $rowCost[0];

                                        ?>
                                            <tr class="<?php if($quantity < $minStockCount AND $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>">
                                                <td class="text-center"><?php  echo $item_id; ?></td>
                                                <td><?php  echo $partNumber; ?></td>
                                                <td><?php  echo $description; ?></td>
                                                <td class="text-center"><?php  echo $itemType; ?></td>
                                                <td class="text-center"><?php  echo $boxNumber; ?></td>
                                                <td class="text-center"><?php  echo $minStockCount; ?></td>
                                                <td class="text-center">                                                    
                                                    <strong><?php echo $quantity; ?></strong>
                                                </td>
                                                <td class="text-center" >
                                                    <span class="label label-<?php if($quantity <= $minStockCount && $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>"><?php if($quantity <= $minStockCount && $quantity > 0) echo "Low Stock"; else if($quantity == 0) echo "Out Of Stock"; else echo "Available";?></span>
                                                </td>
                                                <td class="text-center" >
                                                    <a href="moreDetails.php?item_id=<?php echo $item_id; ?>" class="btn btn-primary btn-xs">View Record <span class="glyphicon glyphicon-list-alt"></span></a>
                                                </td>
                                                <td class="text-center" style="white-space:nowrap;">
                                                    <button data-toggle="modal" data-target="#stockIn" data-toggle-tooltip="tooltip" title="IN" class="btn btn-success btn-xs" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-plus"></span></button>
                                                    <button data-toggle="modal" data-target="#stockOut" data-toggle-tooltip="tooltip" title="OUT" class="btn btn-danger btn-xs" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-minus"></span></button> 
                                                    <!-- <button type="button" class="btn btn-danger btn-xs" title="Delete" data-toggle="modal" data-target="#stockDelete" data-id="<?php echo $item_id; ?>"><span class="glyphicon glyphicon-trash"></span></button>     -->
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
        <!-- PAGE CONTENT END -->
    </div>
    <!-- WRAPPER END  -->
    <!-- WRAPPER END  -->
    <!-- WRAPPER END  -->

     <!--  ADD NEW ITEM MODAL -->
    <div id="addNewItem" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center">
                <div class="fetched-data-addNewItemModal"></div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div> -->
            </div>
        </div>
    </div>     

    <!-- STOCK OUT MODAL -->
    <div id="stockOut" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center">
                <div class="fetched-data-stockOutModal"></div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- STOCK IN MODAL -->                                                     
    <div id="stockIn" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center">
                <div class="fetched-data-stockInModal"></div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div> -->
            </div>
        </div>
    </div>          

    <!-- DELETE ITEM MODAL-->
    <div id="stockDelete" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Delete Item?</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-1"></div>                     
                        <div class="col-sm-10">       
                            <div class="fetched-data-deleteStockModal"></div>        
                        </div>
                        <div class="col-sm-1"></div>                     
                    </div>
                </div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</button>
                </div> -->
            </div>
        </div>
    </div>
    <?php include("includes/scripts.php") ?>
    <script>
        $(document).ready(function () {
                $('#recordsTable').dataTable({
                'iDisplayLength': 25, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 0, 'desc' ],
                'bSort': true
                 });
            });

        $(document).ready(function() {
            var table = $('#recordsTable').DataTable();
         
            $("#recordsTable tfoot th").each( function ( i ) {
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

        $(document).ready(function () {
            $('#recordsTableUnits').dataTable({
                'iDisplayLength': 25, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 0, 'desc' ],
                'bSort': true
            });
        });

        $(document).ready(function() {
            var table = $('#recordsTableUnits').DataTable();
            
            $("#recordsTableUnits tfoot th").each( function ( i ) {
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

        $(document).ready(function() {
            $('.form_date').datetimepicker({
                // language:  'fr',
                format:'yyyy-mm-dd',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            }); 
        });

        $(document).ready(function(){
            $('#addNewItem').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_addNewItemModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-addNewItemModal').html(data);//Show fetched data from database
                    }
                });
             });
        });        


        $(document).ready(function(){
            $('#stockDelete').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_deleteStockModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-deleteStockModal').html(data);//Show fetched data from database
                    }
                });
             });
        });

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

        $(document).ready(function(){
            $('#stockOut').on('show.bs.modal', function (e) {
                var item_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_stockOutModal.php', //Here you will fetch records 
                    data :  'item_id=' + item_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-stockOutModal').html(data);//Show fetched data from database
                    }
                });
             });
        });

        // if (<?php echo $_SESSION['isFirstLogin']; ?>) {
        //     $(document).ready(function() {
        //         BootstrapDialog.show({
        //             type: BootstrapDialog.TYPE_WARNING,
        //             title: 'Warning',
        //             message: '<strong>Important:</strong> Make sure that the server\'s date and time is correct to avoid errors.',
        //             onshow: function(dialogRef){
        //                     dialogRef.enableButtons(false);
        //                     dialogRef.setClosable(false);
        //                     setTimeout(function(){
        //                         dialogRef.close();
        //                     }, 3000);
        //             }

        //         });              
        //     });      
        //     <?php $_SESSION['isFirstLogin'] = "false"; ?>      
        // };         

        $(document).ready(function() {
            $('#reference_id').change(function(event) {
                if($(this).val() == '1' || $(this).val() == '2') {
                    $('#receivingReport').fadeIn();
                    $('#receivingReport #receivingReport').val("");
                } else {
                    $('#receivingReport').fadeOut();
                    $('#receivingReport #receivingReport').val("N/A");
                }
            });
        });                     
    </script>
</body>
</html>