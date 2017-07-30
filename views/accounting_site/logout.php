<?php
	session_start();
	require '../../database.php';
	
	//BACKUP DATABASE
	define("BACKUP_PATH", "C:/NichiyuAsialiftDatabaseBackups/");

	$date_string = date('m-d-Y_hisA', time());

	if (!is_dir(BACKUP_PATH)) {
    		mkdir(BACKUP_PATH, 0777, true);
	}

	$cmd = "C:/xampp/mysql/bin/mysqldump --routines -h {$server_name} -u {$username} {$database_name} > " . BACKUP_PATH . "{$date_string}_{$database_name}.sql";

	exec($cmd);
	
	echo "<script>alert('DATABASE BACKUP FINISHED'); window.location.href = '../maintenance.php'</script>";
	/*ACTIVITY LOG*/
	$sql = "INSERT INTO tbl_activity_logs VALUES(NULL,
	                                           ".$_SESSION['user_id'].",
	                                           now(),
	                                           1,
	                                           'User has logged out'
	                                           );";        
	mysqli_query($conn, $sql);
	mysqli_close($conn);

	if(session_destroy()) { // Destroying All Sessions
		header("Location: .../../index.php"); // Redirecting to Login Page
	}

?>