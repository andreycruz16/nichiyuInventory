<?php
    include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php") ?>
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
                    <!-- <code class="text-success">ADMINISTRATOR</code> -->
                    <span class="text-success">RECORD TALLY</span>
                    <!-- <code class="text-success"><?php echo $_SERVER['REMOTE_ADDR']; ?></code> -->
                </h2>
                <ol class="breadcrumb">
                    <li class="active">Record Tally</li>
                </ol>                
            </div>            
            <div id="page-inner">  
                <div class="row">
                    <!-- ITEM COUNT -->
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "
                                            SELECT 
                                                SUM(CASE WHEN tbl_item.dept_id = 2 THEN tbl_item_history.quantity ELSE 0 END),
                                                SUM(CASE WHEN tbl_item.dept_id = 3 THEN tbl_item_history.quantity ELSE 0 END),
                                                SUM(CASE WHEN tbl_item.dept_id = 4 THEN tbl_item_history.quantity ELSE 0 END)
                                            FROM tbl_item_history
                                            INNER JOIN tbl_item
                                            ON tbl_item.item_id = tbl_item_history.item_id
                                            WHERE tbl_item.status = 0
                                            GROUP By tbl_item.partNumber;
                                            ";

                                            $result = mysqli_query($conn, $sql);
                                            $GLOBALS['discrepancyCount'] = 0;
                                            $GLOBALS['macthedCount'] = 0;
                                            
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                    $quantity1 = $row[0];
                                                    $quantity2 = $row[1];
                                                    $quantity3 = $row[2];


                                                    if($quantity1 != $quantity2 || $quantity1 != $quantity3) 
                                                        $GLOBALS['discrepancyCount']++; 
                                                    else if($quantity1 == $quantity2 || $quantity1 == $quantity3) 
                                                        $GLOBALS['macthedCount']++;
                                                }
                                            }

                                ?>
                                <h3><?php echo $GLOBALS['discrepancyCount']+$GLOBALS['macthedCount']; mysqli_close($conn); ?></h3>
                               <div align="left" style="font-size:15px"><strong> <a href="#" id="noFilter" style="color:white">Total # of Items</a></strong></div><br>
                            </div>
                        </div>
                    </div>
                    <!-- DISCREPANCY COUNT -->
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "
                                            SELECT 
                                                SUM(CASE WHEN tbl_item.dept_id = 2 THEN tbl_item_history.quantity ELSE 0 END),
                                                SUM(CASE WHEN tbl_item.dept_id = 3 THEN tbl_item_history.quantity ELSE 0 END),
                                                SUM(CASE WHEN tbl_item.dept_id = 4 THEN tbl_item_history.quantity ELSE 0 END)
                                            FROM tbl_item_history
                                            INNER JOIN tbl_item
                                            ON tbl_item.item_id = tbl_item_history.item_id
                                            WHERE tbl_item.status = 0
                                            GROUP By tbl_item.partNumber;
                                            ";

                                            $result = mysqli_query($conn, $sql);
                                            $GLOBALS['discrepancyCount'] = 0;
                                            $GLOBALS['macthedCount'] = 0;
                                            
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                    $quantity1 = $row[0];
                                                    $quantity2 = $row[1];
                                                    $quantity3 = $row[2];


                                                    if($quantity1 != $quantity2 || $quantity1 != $quantity3) 
                                                        $GLOBALS['discrepancyCount']++; 
                                                    else if($quantity1 == $quantity2 || $quantity1 == $quantity3) 
                                                        $GLOBALS['macthedCount']++;
                                                }
                                            }

                                ?>
                                <h3><?php echo $GLOBALS['discrepancyCount']; mysqli_close($conn); ?></h3>
                               <div align="left" style="font-size:15px"><strong> <a href="#" id="noFilter" style="color:white">Total # of Discrepancy</a></strong></div><br>
                            </div>
                        </div>
                    </div>                        
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                &nbsp;Record Tally
                            </div> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="tallyTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="f2ba7f" width="">#</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Part&nbsp;Number</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Description</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Warehouse&nbsp;QTY</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Service&nbsp;QTY</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Accounting&nbsp;QTY</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">&nbsp;</th>
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
                                                    SUM(CASE WHEN tbl_item.dept_id = 2 THEN tbl_item_history.quantity ELSE 0 END),
                                                    SUM(CASE WHEN tbl_item.dept_id = 3 THEN tbl_item_history.quantity ELSE 0 END),
                                                    SUM(CASE WHEN tbl_item.dept_id = 4 THEN tbl_item_history.quantity ELSE 0 END),
                                                    tbl_item_history.dept_id
                                                    FROM tbl_item_history
                                                    INNER JOIN tbl_item
                                                    ON tbl_item.item_id = tbl_item_history.item_id
                                                    WHERE tbl_item.status = 0
                                                    GROUP By tbl_item.partNumber;";

                                            $result = mysqli_query($conn, $sql);
                                            $cnt = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                    $item_id = $row[0];
                                                    $description = $row[1];
                                                    $partNumber = $row[2];
                                                    $boxNumber = $row[3];
                                                    $minStockCount = $row[4];
                                                    $quantity1 = $row[5];
                                                    $quantity2 = $row[6];
                                                    $quantity3 = $row[7];
                                        ?>
                                            <tr class="<?php if($quantity1 != $quantity2 || $quantity1 != $quantity3) echo "danger"; else if($quantity1 == $quantity2 || $quantity1 == $quantity3) echo "success";?>">
                                                <td class="text-center"><?php  echo $cnt; ?></td>
                                                <td><?php  echo $partNumber; ?></td>
                                                <td><?php  echo $description; ?></td>
<!--                                                 <?php 
                                                     $sql = "SELECT 
                                                            tbl_item_history.item_id,
                                                            SUM(tbl_item_history.quantity) AS warehouseQTY
                                                            FROM tbl_item_history
                                                            INNER JOIN tbl_item
                                                            ON tbl_item.item_id = tbl_item_history.item_id
                                                            WHERE tbl_item_history.dept_id = 2 AND tbl_item.status = 0 AND warehouseQTY = ".$quantity1."
                                                            GROUP By tbl_item_history.item_id;";
                                                 ?> -->
                                                <td class="text-center"><strong><?php  echo $quantity1; ?></strong></a></td>
                                                <!-- <td class="text-center"><a href="" style="color: black" title="View Item"><strong><?php  echo $quantity1; ?></strong></a></td> -->
                                                <td class="text-center"><strong><?php  echo $quantity2; ?></strong></td>
                                                <td class="text-center"><strong><?php  echo $quantity3; ?></strong></td>
                                                <td class="text-center">
                                                    <span class="label label-<?php if($quantity1 != $quantity2 || $quantity1 != $quantity3) echo "danger"; else if($quantity1 == $quantity2 || $quantity1 == $quantity3) echo "success";?>"><?php if($quantity1 != $quantity2 || $quantity1 != $quantity3) echo "Not Matched"; else if($quantity1 == $quantity2 || $quantity1 == $quantity3) echo "Matched"; ?></span>
                                                </td>
                                            </tr>
                                        <?php 
                                                $cnt++;
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
            $('#tallyTable').dataTable({
                'iDisplayLength': 25, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 1, 'asc' ],
                'bSort': true,
                "paging":   true,
                "ordering": true,
             });           

            var itemTable = $('#tallyTable').DataTable();
         
            $("#tallyTable tfoot th").each( function ( i ) {
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

         $(window).on('load', function() {
            document.body.style.zoom = "100%" ;
        })
    </script>
</body>
</html>