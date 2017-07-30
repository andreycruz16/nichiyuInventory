<?php
    include('session.php');
    require '../../database.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/header.php") ?>
    <style>
     #addNewUser .modal-header {
          background-color: #5cb85c;
          color: #fff;
          font-weight: bold;
          text-align: center;
     }

     #userDelete .modal-header {
          background-color: #d9534f;
          color: #fff;
          font-weight: bold;
          text-align: center;
     }     
    </style>     
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
                    <span class="text-success">USER MANAGEMENT</span>
                </h2>
                <ol class="breadcrumb">
                    <li class="active">User Management</li>
                </ol>
            </div>
            <div id="page-inner">
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT COUNT(*) FROM tbl_users WHERE userType_id = 2;";
                                    $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQL_NUM); 
                                ?>
                                <h3><strong><?php echo $row[0]; mysqli_close($conn); ?></strong></h3>
                               <strong> Total # of Warehouse Users</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT COUNT(*) FROM tbl_users WHERE userType_id = 3;";
                                    $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQL_NUM); 
                                ?>
                                <h3><strong><?php echo $row[0]; mysqli_close($conn); ?></strong></h3>
                               <strong> Total # of Service Users</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT COUNT(*) FROM tbl_users WHERE userType_id = 4;";
                                    $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQL_NUM); 
                                ?>
                                <h3><strong><?php echo $row[0]; mysqli_close($conn); ?></strong></h3>
                               <strong> Total # of Accounting Users</strong>
                            </div>
                        </div>
                    </div>                    
<!--                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-right">
                                <?php 
                                    require '../../database.php';
                                    $sql = "SELECT COUNT(*) FROM tbl_users WHERE userType_id = 5;";
                                    $row = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQL_NUM); 
                                ?>
                                <h3><strong><?php echo $row[0]; mysqli_close($conn); ?></strong></h3>
                               <strong> Total # of Guest</strong>
                            </div>
                        </div>
                    </div> --> 
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <button class="btn btn-success btn-md" data-toggle-tooltip="tooltip" data-placement="top" title="" data-toggle="modal" data-target="#addNewUser">
                                  <span class="glyphicon glyphicon-user"></span>&nbsp; New user
                                </button> 
                                &nbsp;All Users (A-Z)
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="usersTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Username</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">First Name</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Last Name</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">User Type</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="10">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Username</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">First Name</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">Last Name</th>
                                                <th class="text-center" bgcolor="#f2ba7f" width="">User Type</th>
                                                <td class="text-center" bgcolor="#f2ba7f" width="10"></td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
                                            require '../../database.php';
                                            $sql = "SELECT
                                                      tbl_users.user_id,
                                                      tbl_users.firstName,
                                                      tbl_users.lastName,
                                                      tbl_users.username,
                                                      tbl_user_type.userType
                                                    FROM
                                                      tbl_users
                                                    INNER JOIN
                                                      tbl_user_type ON tbl_users.userType_id = tbl_user_type.userType_id
                                                    WHERE
                                                      tbl_user_type.userType != 'ADMINISTRATOR' AND tbl_user_type.userType != 'GUEST'
                                                    ORDER BY
                                                      tbl_users.username;";
                                            // echo $sql;
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                    $user_id = $row[0];
                                                    $firstName = $row[1];
                                                    $lastName = $row[2];
                                                    $username = $row[3];
                                                    $userType = $row[4];
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $username; ?></td>
                                                <td class="text-center"><?php echo $firstName; ?></td>
                                                <td class="text-center"><?php echo $lastName; ?></td>
                                                <td class="text-center"><?php echo $userType; ?></td>
                                                <td class="text-center" style="white-space:nowrap;">
                                                    <a href="userDetails.php?user_id=<?php echo "$user_id"; ?>" title="Manage" class="btn btn-info btn-xs">Manage <span class="glyphicon glyphicon-cog"></span></a>
                                                    <button type="button" class="btn btn-danger btn-xs" title="Delete" data-toggle="modal" data-target="#userDelete" data-id="<?php echo $user_id; ?>"><span class="glyphicon glyphicon-trash"></span></button>
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
    </div>

    <!--  ADD NEW USER -->
    <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Create a new user</h4>
          </div>
          <form role="form" class="form-horizontal" action="phpScripts/addNewUser.php" method="post">
              <div class="modal-body">
                <div class="row">
                   <div class="col-sm-2">                    
                   </div>            
                   <div class="col-sm-8">
                        <div class="form-group">
                          <label for="recipient-name" class="control-label">Username: (ex: MarkDelaCruz)</label>
                          <input type="text" class="form-control" name="username" id="username" autocomplete="off" required autofocus>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="control-label">Password: (Username is default password)</label>
                          <input type="text" class="form-control" name="password" id="password" placeholder="●●●●●●●●●●" autocomplete="off" required readonly>
                        </div>
                         <div class="form-group">
                          <label for="recipient-name" class="control-label">First Name:</label>
                          <input type="text" class="form-control" name="firstName" id="firstName" autocomplete="off" required autofocus>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="control-label">Last Name:</label>
                          <input type="text" class="form-control" name="lastName" id="lastName" autocomplete="off" required autofocus>
                        </div>
                         <div class="form-group">
                              <label for="userType"><label class="text-danger"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></label> User Type</label>
                              <select class="form-control" name="userType_id" id="userType_id" required>
                                  <option value="" selected disabled>User Type</option>
                                    <?php 
                                        require '../../database.php';
                                        $sql = "SELECT * FROM tbl_user_type WHERE userType_id != 1 AND userType_id != 5;";

                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_array($result, MYSQL_NUM)) { 
                                                $userType_id = $row[0];
                                                $userType = $row[1];
                                    ?>
                                        <option value="<?php echo $userType_id; ?>"><?php echo $userType; ?></option>


                                    <?php 
                                            }
                                        }
                                        mysqli_close($conn);
                                    ?>
                              </select>
                         </div>
                   </div>
                   <div class="col-sm-2">                    
                   </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </form>
        </div>
      </div>
    </div>    

        <!-- DELETE USER MODAL-->
    <div id="userDelete" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-center">
                <div class="modal-header modal-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Delete User?</strong></h4>
                </div>
                <div class="fetched-data-deleteUserModal"></div>        
            </div>
        </div>
    </div> 
    <?php include("includes/scripts.php") ?>
    <script>
        $(document).ready(function () {
            $('#usersTable').dataTable({
            'iDisplayLength': 25, 
            'lengthMenu': [ [25, 50, 100, 500, -1], [25, 50, 100, 500, 'All'] ],
            'bSort': false
             });
        });

        $(document).ready(function() {
            var usersTable = $('#usersTable').DataTable();
         
            $("#usersTable tfoot th").each( function ( i ) {
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        usersTable.column( i )
                            .search( $(this).val() )
                            .draw();
                    } );
         
                usersTable.column( i ).data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        } );

        $(document).ready(function(){
            $('#userDelete').on('show.bs.modal', function (e) {
                var user_id = $(e.relatedTarget).data('id');
                $.ajax({
                    type : 'post',
                    url : 'phpScripts/fetch_deleteUserModal.php', //Here you will fetch records 
                    data :  'user_id=' + user_id, //Pass $id
                    success : function(data){
                    $('.fetched-data-deleteUserModal').html(data);//Show fetched data from database
                    }
                });
             });
        });            


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

        $('#username').keyup(function(event) {
            $('#password').val($(this).val());
        });
    </script>
</body>
</html>