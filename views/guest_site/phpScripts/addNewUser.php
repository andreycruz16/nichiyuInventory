<?php 
    session_start();
    require '../../../database.php';
	if (!empty($_POST)) {
        $username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $username);
        $username = trim($username);

        $password = $_POST['password'];
        $password = mysqli_real_escape_string($conn, $password);
        $password = trim($password);

        $userType_id = $_POST['userType_id'];
        $userType_id = mysqli_real_escape_string($conn, $userType_id);
        $userType_id = trim($userType_id);


        $sql = "INSERT INTO tbl_users VALUES(NULL,
                                             ".$userType_id.",
                                            '".$username."',
                                            '".md5($password)."',
                                             'N/A',
                                             'N/A',
                                             'N/A',
                                             'default.png');";
        $retval = mysqli_query($conn, $sql);

        if($retval) {
            echo "<script>alert('NEW USER ADDED SUCCESSFULLY.'); window.location.href = '../userManagement.php'</script>";
        } 
        mysqli_close($conn);
    } else {
        echo "<script>alert('AN ERROR OCCURED. USER ADD FAILED.'); window.location.href = '../userManagement.php'</script>";
    }
 ?>