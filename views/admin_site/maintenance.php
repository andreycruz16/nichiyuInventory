<?php
    include('session.php');
    require '../../database.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/header.php") ?>
</head>
<body>
    <div id="wrapper">
        <!-- TOP NAVIGATION -->        
        <?php include("includes/topNavigation.php") ?>
        <!-- SIDE NAVIGATION --> 
        <?php include("includes/sideNavigation.php") ?>
        <div id="page-wrapper">
            <div class="header"> 
                <h2 class="page-header">
                    <span class="text-success">MAINTENANCE</span>
                </h2>
                <ol class="breadcrumb">
                    <li class="active">Maintenance</li>
                </ol>
            </div>
            <div id="page-inner">
                <!-- <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                &nbsp;Deleted Items (Newest - Oldest)
                            </div> 
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="deletedItemsTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="10">ID</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Part&nbsp;#/Model</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Description</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="">Department</th>
                                                <th class="text-center" bgcolor="f2ba7f" width="10">Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" bgcolor="e5e5e5" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <th bgcolor="f2ba7f" width="">&nbsp;</th>
                                                <td bgcolor="f2ba7f" width="">&nbsp;</td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
                                            require '../../database.php';

                                            $sql = "SELECT 
                                                    tbl_item.item_id,
                                                    tbl_item.description,
                                                    tbl_item.partNumber,
                                                    tbl_user_type.userType
                                                    FROM tbl_item
                                                    INNER JOIN tbl_user_type
                                                    ON tbl_item.dept_id = tbl_user_type.userType_id
                                                    WHERE tbl_item.status = 1;";

                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                    $item_id = $row[0];
                                                    $description = $row[1];
                                                    $partNumber = $row[2];
                                                    $userType = $row[3];
                                        ?>
                                            <tr class="<?php if($quantity < $minStockCount AND $quantity > 0) echo "warning"; else if($quantity == 0) echo "danger"; else echo "success";?>">
                                                <td class="text-center"><?php  echo $item_id; ?></td>
                                                <td><?php  echo $partNumber; ?></td>
                                                <td><?php  echo $description; ?></td>
                                                <td><?php  echo $userType; ?></td>
                                                <td class="text-center" style="white-space:nowrap;">
                                                    <button data-toggle="modal" data-target="#restoreItem" data-toggle-tooltip="tooltip" title="Restore Item" class="btn btn-success btn-xs" data-id="<?php echo $item_id; ?>"> Restore Item <span class="glyphicon glyphicon-plus"></span></button>
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
                </div> -->
                <div class="row">                    
                    <div class="col-md-5 col-sm-5 col-xs-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Database Options
                            </div>
                            <div class="panel-body">
                                <button class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#backupModal">Backup Database</button>
                                <div class="modal fade" id="backupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Backup Database</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h5><button href="#" class="btn btn-xs btn-primary" disabled>Backup to server <span class="glyphicon glyphicon-hdd"></span></button> will backup database to <code><font color="green">C:\NichiyuAsialiftBackups\</font></code> of local server.</h5>
                                                <h5><button href="#" class="btn btn-xs btn-success" disabled>Download Backup <span class="glyphicon glyphicon-download-alt"></span></button> will download the database.</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                                <a href="phpScripts/dbBackup.php" class="btn btn-primary">Backup to server <span class="glyphicon glyphicon-hdd"></span></a>
                                                <a href="phpScripts/dbBackupDownload.php" class="btn btn-success">Download Backup <span class="glyphicon glyphicon-download-alt"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#restoreModal">Restore Database</button>
                                <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Restore Database</h4>
                                            </div>
                                            <form action="phpScripts/dbRestore.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                            <div>Make sure to <span class="text-danger"><b>CLEAR</b></span> the database before you <span class="text-success"><b>RESTORE</b></span>....</div>
                                                            <label>File to Restore from: </label><input type="file" name="file">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button name="restore" type="submit" class="btn btn-primary">Restore</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-danger btn-md btn-block" data-toggle="modal" data-target="#clearModal">Clear Database</button>
                                <div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Clear Database</h4>
                                            </div>
                                            <form action="phpScripts/dbClear.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body text-center">
                                                    <h4 class="text-danger">Are you sure you want to permanently clear <br><strong>ALL DATABASE RECORDS?</strong></h4>
                                                    <strong>Warning</strong>: This action is <strong>irreversable</strong><br><br>    
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span for="password" class="input-group-addon" id="basic-addon1">Password:</span>
                                                            <input type="password" name="password" id="password" class="form-control" value="" aria-describedby="basic-addon1" autofocus required autocomplete="off">
                                                        </div>                                                                                                                                               
                                                     </div>
                                                     <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button name="truncate" type="submit" class="btn btn-danger">Clear All Records</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php include("includes/footer.php") ?>
            </div>
        </div>
    </div>
    <?php include("includes/scripts.php") ?>
    <script>
        $(document).ready(function () {
                $('#deletedItemsTable').dataTable({
                'iDisplayLength': 10, 
                'lengthMenu': [ [25, 50, 100, -1], [25, 50, 100, 'All'] ],
                'order': [ 0, 'desc' ],
                'bSort': true
                 });

            var table = $('#deletedItemsTable').DataTable();
         
            $("#deletedItemsTable tfoot th").each( function ( i ) {
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
    </script>
</body>
</html>