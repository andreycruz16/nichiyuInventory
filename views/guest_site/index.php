<?php
    include('session.php');
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

 #stockDelete .modal-header {
      background-color: #d9534f;
      color: #fff;
      font-weight: bold;
      text-align: center;
 }

 #editItemDetails .modal-header {
      background-color: #5bc0de;
      color: #fff;
      font-weight: bold;
      text-align: center;
 } 
</style>
<body onload="startTime();">
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
                    <span class="text-success">SERVICE PERSONNEL</span>
                </h2>
                <ol class="breadcrumb">
                    <li class="active">All Records</li>
                </ol>                
            </div>            
            <div id="page-inner">              
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT COUNT(*) FROM tbl_item WHERE tbl_item.status = 0 AND dept_id = 3;";
                                    $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQL_NUM); 
                                ?>
                                <h3><?php echo $row[0]; mysqli_close($conn); ?></h3>
                               <div align="left" style="font-size:15px"><strong> <a href="index.php" id="noFilter" style="color:white">Total # of Service Items</a></strong></div><br>
                            </div>
                        </div>
                    </div>   
                    <!-- SERVER DATE & TIME BOX -->
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="panel panel-primary text-center no-boder blue">
                                <div class="panel-right">
                                    <br>
                                    <!-- <div align="left" style="font-size:25px" id="time"></div> -->
                                    <div align="left" style="font-size:18px"><?php  echo date("h:i A"); ?></div>
                                    <div align="left" style="font-size:18px"><?php  echo date("F d, Y | l"); ?></div>
                                    <div align="left" style="font-size:15px"><strong> SERVER DATE &AMP; TIME</strong></div><br>
                                </div>
                        </div>
                    </div>                    
                </div>      
                <div class="row">
                    <!-- SERVICES RECORDS (A-Z) -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                &nbsp;Service Items
                            </div> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" width="100%" id="serviceTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="">ID</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Part&nbsp;#</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Description</th>
                                                <!-- <th class="text-center" bgcolor="f2ba7f" width="">Box&nbsp;#</th> -->
                                                <th class="text-center" bgcolor="f2ba7f" width="">Order Point</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Stock&nbsp;On&nbsp;Hand</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Status</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Transtactions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <!-- <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th> -->
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
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
                                            <tr class="<?php if($quantity < $minStockCount AND $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>">
                                                <td class="text-center"><?php  echo $item_id; ?></td>
                                                <td><?php  echo $partNumber; ?></td>
                                                <td><?php  echo $description; ?></td>
                                                <!-- <td class="text-center"><?php  echo $boxNumber; ?></td> -->
                                                <td class="text-center"><?php  echo $minStockCount; ?></td>
                                                <td class="text-center">                                                    
                                                    <strong><?php echo $quantity; ?></strong>
                                                </td>
                                                <td class="text-center" >
                                                    <span class="label label-<?php if($quantity <= $minStockCount && $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>"><?php if($quantity <= $minStockCount && $quantity > 0) echo "Low Stock"; else if($quantity == 0) echo "Out Of Stock"; else echo "Available";?></span>
                                                </td>
                                                <td class="text-center" >
                                                    <a href="moreDetailsService.php?item_id=<?php echo $item_id; ?>" class="btn btn-primary btn-xs">View Record <span class="glyphicon glyphicon-list-alt"></span></a>
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
   
    <?php include("includes/scripts.php") ?>
    <script>

        $(document).ready(function() {
            $('#warehouseTable').dataTable({
                'iDisplayLength': 25, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 1, 'asc' ],
                'bSort': true,
                "paging":   true,
                "ordering": true,
             });           

            var itemTable = $('#warehouseTable').DataTable();
         
            $("#warehouseTable tfoot th").each( function ( i ) {
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        itemTable.column( i )
                            .search( $(this).val() )
                            .draw();
                    } );
         
                itemTable.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );     

            $('#accountingTable').dataTable({
                'iDisplayLength': 25, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 1, 'asc' ],
                'bSort': true,
                "paging":   true,
                "ordering": true,
             });           

            var itemTable = $('#accountingTable').DataTable();
         
            $("#accountingTable tfoot th").each( function ( i ) {
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        itemTable.column( i )
                            .search( $(this).val() )
                            .draw();
                    } );
         
                itemTable.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );  

            $('#serviceTable').dataTable({
                'iDisplayLength': 25, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 1, 'asc' ],
                'bSort': true,
                "paging":   true,
                "ordering": true,
             });           

            var itemTable = $('#serviceTable').DataTable();
         
            $("#serviceTable tfoot th").each( function ( i ) {
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        itemTable.column( i )
                            .search( $(this).val() )
                            .draw();
                    } );
         
                itemTable.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );     
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

         $(window).on('load', function() {
            document.body.style.zoom = "100%" ;
        })
    </script>
</body>
</html>